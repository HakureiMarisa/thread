<?php
class ActiveRecord extends CActiveRecord{
	public function rules()
	{
		$rules = array();
		if ($this->hasAttribute('create_by')) {
			$rules[] = array('create_by', 'default', 'value'=>getApp()->user->id);		
			$rules[] = array('create_by', 'required', 'message'=>'请登陆');
		}
		if ($this->hasAttribute('create_on')) {
			$rules[] = array('create_on', 'default', 'value'=>new CDbExpression('NOW()'));
		}
		return $rules;
	}
}