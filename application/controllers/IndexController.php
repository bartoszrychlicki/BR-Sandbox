<?php

class IndexController extends Br_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		parent::init();
    }

    public function indexAction()
    {
        // action body
		$this->_logger->debug($this->getRequest());
		$this->_logger->debug('test');
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()) {
			$this->_logger->log('mam id',2);
		} else {
			$this->_logger->log('nie mam id',2);
		}
    }


}

