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
		$auth = Zend_Auth::getInstance();

		if($auth->hasIdentity()) {
			$this->_logger->debug('mam id');
		} else {
			$this->_logger->debug('nie mam id');
		}
    }


}

