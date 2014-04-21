<?php

/**
 * This is the model class for table "thread".
 *
 * The followings are the available columns in table 'thread':
 * @property string $id
 * @property string $topic_id
 * @property string $create_by
 * @property string $create_on
 * @property string $reply_to
 *
 * The followings are the available model relations:
 * @property Topic $topic
 * @property User $createBy
 * @property Thread $replyTo
 * @property Thread[] $threads
 * @property ThreadContent $threadContent
 */
class Thread extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Thread the static model class
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
		return 'thread';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
			array('topic_id', 'required'),
			array('reply_to', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic_id, create_by, create_on, reply_to', 'safe', 'on'=>'search'),
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
			'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
			'discussant' => array(self::BELONGS_TO, 'User', 'create_by'),
			'replyTo' => array(self::BELONGS_TO, 'Thread', 'reply_to'),
			'threads' => array(self::HAS_MANY, 'Thread', 'reply_to'),
			'content' => array(self::HAS_ONE, 'ThreadContent', 'thread_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'topic_id' => 'Topic',
			'create_by' => 'Create By',
			'create_on' => 'Create On',
			'reply_to' => 'Reply To',
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
		$criteria->compare('topic_id',$this->topic_id,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_on',$this->create_on,true);
		$criteria->compare('reply_to',$this->reply_to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}