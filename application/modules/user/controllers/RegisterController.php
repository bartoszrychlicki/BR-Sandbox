<?php

class User_RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

	/**
	 * This action is resonsible for regestring new user in the system. 
	 *
	 * Action use any model that implemenets << Br_Model_Interface_Registerable >> interface.
	 */
    public function indexAction()
    {
        //1. We need to display form for user registration. Remeber that model also should
		// have validation
		$request 	= $this->getRequest();
		$userTable	= new User_Model_User();
		
		$form 		= $this->getRegistrationForm($userTable->createRow());
		
		if($request->isPost()) {
			$post = $request->getPost();
			if($form->isValid($post)) { // data in the form are valid so we can register new user
				$user = $userTable->createRow($data); // we are creating new user object based on row class
				if($user->isValid()) { // form protects... but it does no harm to a double check
					$user->save();
				} else {
					Zend_Debug::dump($user->getMessages());
				}
			}
		}
		
		$this->view->form = $form;
    }

	public function getRegistrationForm($rowModel)
	{
		return new User_Form_Registration($rowModel);
	}

}

