<?php

class User_IndexController extends Br_Controller_Action
{

    public function indexAction()
    {
		$this->_helper->addPrefix('Br_Controller_Action_Helper');
		
		$request = $this->getRequest();
		$form = new User_Form_Login();
				
		$this->_logger->debug('przed if post');
		if($request->isPost()) {
			$this->_logger->debug('is Post');
			if ($form->isValid($request->getPost())) {
				$this->_logger->debug('form is valid');
				$values = $form->getValues();
                if($auth = $this->_helper->Authorize($values['username'], $values['password'])) {
					// access granted
					$this->_logger->debug('access granted');					
					$this->_helper->FlashMessenger('Zostałeś zalogowany');
				} else {
					$this->_logger->debug('access denied');
					$this->_helper->FlashMessenger('Podałeś zły login lub hasło');
				}
            } else {
					$this->_helper->FlashMessenger('Wypełnij poprawnie formularz');
			}
		}
		$this->view->messages = $this->_helper->FlashMessenger->getCurrentMessages();
		$this->view->form = $form;
    }
}

