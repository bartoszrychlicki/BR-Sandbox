<?php

class User_Form_Login extends EasyBib_Form
{

    public function init()
    {
        $this->setName("login");
        $this->setMethod('post');
        $this->setAttrib('class', 'form-horizontal');
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required'   => true,
            'label'      => 'Login:',
        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required'   => true,
            'label'      => 'Hasło:',
        ));
		
		$submit      = new Zend_Form_Element_Button('submit');
        
        $submit->setLabel('Save');
		$this->addElement($submit);
		
		// add display group
        $this->addDisplayGroup(
            array('username', 'password', 'submit'),
            'users'
        );
        $this->getDisplayGroup('users')->setLegend('Login');

	    // set decorators
	    EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');

    }

}