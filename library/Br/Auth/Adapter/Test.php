<?php
class Br_Auth_Adapter_Test implements Zend_Auth_Adapter_Interface
{
	protected $_username = null;
	protected $_password = null;
    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->setUsername($username)->setPassword($password);
    }
 	
	public function setUsername($username) {
		$this->_username = $username;
		return $this;
	}
	
	public function setPassword($password) {
		$this->_password = $password;
		return $this;
	}
	
	public function getUsername() {
		return $this->_username;
	}
	
	public function getPassword()
	{
		return $this->_password;
	}
    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot
     *                                     be performed
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
		$result = array();
		if($this->getUsername() == $this->getPassword()) {
			$result['code'] 		= Zend_Auth_Result::SUCCESS;
			$result['identity']		= array(
				'username'	=>	$this->getUsername(),
				'role'		=>	'user'
				);
		} else {
			$result['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
			$result['identity'] = false;
		}
		return new Zend_Auth_Result($result['code'], $result['identity']);
    }
}
?>