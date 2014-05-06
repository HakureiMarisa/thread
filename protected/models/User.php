<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $is_locked
 * @property string $last_login
 * @property string $reset_key
 * 
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	public $password1;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email', 'required'),
		    array('password', 'required', 'except'=>'update'),
			array('name', 'length', 'max'=>50),
		    array('name', 'unique'),
		    array('email', 'email'),
			array('password, email', 'length', 'max'=>64),
		    array('password1', 'compare', 'compareAttribute'=>'password', 'on'=>'insert, update'),
		    array('reset_key', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, password, email, is_locked, last_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '用户名',
			'password' => '密码',
		    'password1' => '确认密码',
			'email' => 'Email',
		    'last_login' => '上次登录时间',
		    'is_locked' => '禁闭',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		//$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave(){
	    $this->password = md5($this->password);
		/*if ($this->isNewRecord) {
			$this->password = md5($this->password);
		}*/
		return parent::beforeSave();
	}
	
	protected function afterSave(){
		parent::beforeSave();
		if ($this->isNewRecord) {
			$message = array(
                'html' => '<p>欢迎</p>',
                'subject' => '欢迎欢迎，热烈欢迎！',
                'from_email' => getParams('adminEmail'),
                'from_name' => '你亲爱的杰杰',
                'to' => array(
                    array(
                        'email' => $this->email,
                        'name' => $this->name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => getParams('adminEmail')),           
            );
            getApp()->mandrill->messages->send($message);
		}
	}
}