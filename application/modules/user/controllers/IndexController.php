<?php

class User_IndexController extends Br_Controller_Action
{

    public function indexAction()
    {
		$this->_helper->addPrefix('Br_Controller_Action_Helper');
		if($auth = $this->_helper->Authorize('brdesign', 'brdesign')) {
			// access granted
			$this->_logger->debug($auth);
		} else {
			$this->_logger->debug('Nie udane logowanie');
		}
		
		if(Zend_Auth::getInstance()->hasIdentity()) {
			$this->_logger->debug('it has identity');
		} else {
			$this->_logger->debug('it does not has identy');
		}
		
    }
}

