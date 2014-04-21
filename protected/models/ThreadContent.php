<?php

/**
 * This is the model class for table "thread_content".
 *
 * The followings are the available columns in table 'thread_content':
 * @property string $thread_id
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Thread $thread
 */
class ThreadContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ThreadContent the static model class
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
		return 'thread_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('thread_id, content', 'safe', 'on'=>'search'),
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
			'thread' => array(self::BELONGS_TO, 'Thread', 'thread_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'thread_id' => 'Thread',
			'content' => 'Content',
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

		$criteria->compare('thread_id',$this->thread_id,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave(){
	    preg_match_all('/@(\S)+/', $this->content, $arr);
	    $usernames = array();
	    foreach ($arr[0] as $username){
	        $usernames[] = substr($username, 1);
	    }
	    $at_users = getApp()->db->createCommand()->select('id, name')->from('user')->where(array('in', 'name', $usernames))->queryAll();
	    foreach ($at_users as $user){       
	    	$at = new At();
	    	$at->thread_id = $this->thread_id;
	    	$at->user_id = $user['id'];
	    	$at->save();
	    	$this->content = preg_replace("/@{$user['name']} /", "<a href='".url('user/view', array('id'=>$user['id']))."'>\${0}</a>", $this->content);
	    }
	    return parent::beforeSave();
	}
}