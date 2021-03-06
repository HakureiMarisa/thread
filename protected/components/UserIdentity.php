<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	const ERROR_IS_LOCKED = 3;
	
	public function authenticate()
	{
		$user=User::model()->findByAttributes(array('name'=>$this->name));
		
		if(!$user)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($user->is_locked=='Y')
		  $this->errorCode=self::ERROR_IS_LOCKED;
		else{
			$this->errorCode=self::ERROR_NONE;
			$this->_id = $user->id;
		}
		return $this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setId($id){
	    $this->_id = $id;
	}
}