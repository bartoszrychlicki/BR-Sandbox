<?php

class AdminUser_IndexController extends Br_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$this->_helper->addPrefix('Br_Controller_Action_Helper');
		$auth = $this->_helper->Authorize('brdesign', 'brdesign');
    }


}

