<?php
/**
* 
*/
class Zend_Controller_Action_Helper_Authorize extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($username, $password)
	{
		$auth = new Br_Auth_Adapter_Test($username, $password);
		$res = $auth->authenticate();
		if($res->isValid()) {
			return $res->getIdentity();
		}
		return false;
	}
}
?>