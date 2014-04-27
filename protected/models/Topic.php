<?php

/**
 * This is the model class for table "topic".
 *
 * The followings are the available columns in table 'topic':
 * @property string $id
 * @property string $title
 * @property string $create_on
 * @property string $create_by
 * @property string $visits
 *
 * The followings are the available model relations:
 * @property Thread[] $threads
 * @property User $createBy
 */
class Topic extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topic the static model class
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
		return 'topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
			array('title', 'required'),
			array('title', 'length', 'max'=>50),
			array('visits', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, create_on, create_by, visits', 'safe', 'on'=>'search'),
		);
		return array_merge($rules, parent::rules());
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'threads' => array(self::HAS_MANY, 'Thread', 'topic_id'),
			'thread_connts' => array(self::STAT, 'Thread', 'topic_id'),
			'creater' => array(self::BELONGS_TO, 'User', 'create_by'),
		    'last_thread' => array(self::HAS_ONE, 'Thread', 'topic_id', 'order'=>'last_thread.create_on DESC, t.create_on DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '标题',
			'create_on' => 'Create On',
			'create_by' => 'Create By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('create_on',$this->create_on);
		$criteria->compare('create_by',$this->create_by);
		//$criteria->select = array('id', 'title', 'create_on', 'create_by', 'visits');
		$criteria->with = array('last_thread', 'last_thread.discussant', 'creater');
		$criteria->together = true;
		//$criteria->order = 'threads.create_on DESC, t.create_on DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>50,
		    ),
		));
	}
}