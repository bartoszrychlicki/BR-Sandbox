<?php
/**
* 
*/
class User_Model_User_Row extends Br_Db_Table_Row implements User_Model_User_Interface
{
	protected $_validators = array(
		'username' => array(
			'Alpha', array('StringLength', false, array(3, 20)),
			),
	);
	
	public function setUsername($username) 
	{
		$this->username = $username;
		return $this;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setPassword($password)
	{
		if($salt) {
			$password = md5($password.$salt);
		} else {
			$password = md5($password);
		}
		$this->password = $password;
		return $this;
	}
}
