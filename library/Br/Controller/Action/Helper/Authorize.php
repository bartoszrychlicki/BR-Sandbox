<?php
/**
* 
*/
class Zend_Controller_Action_Helper_Authorize extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($username, $password)
	{
		$config = Zend_Registry::get('config');
		if(!$config->production->auth->adapterName) {
			throw new Exception("There is no adapter for auth module defined in application.ini, define the name of the Auth adapter by adding auth.adapterName = to application.ini", 1);
			
		}
		switch($config->production->auth->adapterName) {
			case "Test":
				$auth = new Br_Auth_Adapter_Test($username, $password);
				break;
		}
		$res = $auth->authenticate();
		if($res->isValid()) {
			return $res->getIdentity();
		}
		return false;
	}
}
?>