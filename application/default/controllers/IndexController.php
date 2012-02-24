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
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()) {
			$this->_logger->info('mam id',2);
		} else {
			$this->_logger->info('nie mam id',2);
		}
    }


}

