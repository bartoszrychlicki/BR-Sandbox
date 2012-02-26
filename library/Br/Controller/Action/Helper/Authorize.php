<?php
/**
* 
*/
class Br_Controller_Action_Helper_Authorize extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($username, $password)
	{
		$config = Zend_Registry::get('config');
		if(!$config->production->auth->adapterName) {
			throw new Exception("There is no adapter for auth module defined in application.ini, define the name of the Auth adapter by adding auth.adapterName = to application.ini", 1);
			
		}

		$auth = Zend_Auth::getInstance();
		
		switch($config->production->auth->adapterName) {
			case "Test":
				$adapter = new Br_Auth_Adapter_Test($username, $password);
				break;
			case "Digest":
				$adapter = new Zend_Auth_Adapter_Digest($config->production->auth->digest->filename,
				                                        $config->production->auth->digest->realm,
				                                        $username,
				                                        $password);
				break;
			default:
				throw new Exception('Specified adapter name in application.ini (' . $$config->production->auth->adapterName .' ) is not supported by Br_Controller_Action_Authorize_Helper');
				break;
		}
		
		$res = $auth->authenticate($adapter);
		if($res->isValid()) {
			$id = $res->getIdentity();
			$auth->getStorage()->write($id);
			return $id;
		}
		return false;
	}
}
?>