<?php

class UserController extends Controller
{

    /**
     *
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning using two-column layout. See 'protected/views/layouts/column2.php'.
     */
   // public $layout = '//layouts/column2';

    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array(
            //'accessControl' // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules. This method is used by the 'accessControl' filter.
     * 
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'register'
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update'
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete'
                ),
                'users' => array(
                    'admin'
                )
            ),
            array(
                'deny', // deny all users
                'users' => array(
                    '*'
                )
            )
        );
    }

    /**
     * Displays a particular model.
     * 
     * @param integer $id
     *            the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel('User', $id)
        ));
    }

    /**
     * Creates a new model. If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new User();
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }
        
        $this->render('create', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model. If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param integer $id
     *            the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel('User', $id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }
        
        $this->render('update', array(
            'model' => $model
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];
        
        $this->render('index', array(
            'model' => $model
        ));
    }

    /**
     * Performs the AJAX validation.
     * 
     * @param
     *            CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionRegister(){
        $this->layout = '//layouts/column1';
        
    	$user = new User();
    	if (isset($_POST['User'])) {
    		$user->attributes = $_POST['User'];
    		$user->last_login = new CDbExpression('NOW()');
    		if ($user->save()) {
    		    $identity=new UserIdentity($user->name, $_POST['User']['password']);
    		    $identity->id = $user->id;
		        Yii::app()->user->login($identity);
    			$this->redirect(getApp()->user->returnUrl);
    		}
    	}
    	$this->render('register', array('model'=>$user));
    }
    
    public function actionForget(){
        $this->layout = '//layouts/column1';
        $user = new User();       
        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            if ($forgeter = $user->findByAttributes($_POST['User'])) {
                $resetkey = uniqid();
                $resetUrl = getApp()->createAbsoluteUrl('user/reset', array('resetkey'=>$resetkey));
                $forgeter->saveAttributes(array('reset_key' => $resetkey));
                $message = array(
                    'html' => "<p>您的用户名为：{$forgeter->name}</p><p>点击 <a href='$resetUrl'>链接</a> 进入重置密码页面</p>",
                    'subject' => '忘记用户名或密码',
                    'from_email' => getParams('adminEmail'),
                    'from_name' => '你亲爱的杰杰',
                    'to' => array(
                        array(
                            'email' => $forgeter->email,
                            'name' => $forgeter->name,
                            'type' => 'to'
                        )
                    ),
                    'headers' => array('Reply-To' => getParams('adminEmail')),           
                );
                getApp()->mandrill->messages->send($message);
                getApp()->user->setFlash('forget', '邮件已发送，请注意查看您的邮箱。');
                $this->refresh();
            }else{
                $user->addError('email', '请核实您注册的邮箱。');
            }
        }
        $this->render('forget', array('model'=>$user));
    }
    
    public function actionReset($resetkey){
        $this->layout = '//layouts/column1';
    	if ($user = User::model()->findByAttributes(array('reset_key'=>$resetkey))) {
    	    $user->password = '';
    	    if (isset($_POST['User'])) {
    	        $user->attributes = $_POST['User'];
    	        if ($user->save()){
    	            $identity=new UserIdentity($user->name, $_POST['User']['password']);
    	            $identity->id = $user->id;
    	            Yii::app()->user->login($identity);
    	        	$this->redirect(getApp()->user->returnUrl);
    	        }
    	    } 	    
    		$this->render('reset', array('model'=>$user));
    	}
    }
    
    public function actionLock($id, $lock){
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $user = $this->loadModel('User', $id);
            if ($lock) {
            	$lock = 'Y';
            }else{
                $lock = null;
            }
            $user->saveAttributes(array('is_locked'=>$lock));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (! isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'index'
                ));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
}
