<?php
class User_Form_Registration extends EasyBib_Form
{
	private $_rowModel;
	
	public function __construct($rowModel) 
	{
		$this->_rowModel = $rowModel; // this is for using model validation rules, DRY!
		return parent::__construct();
	}

    public function init()
    {
		
        $this->setName("register");
        $this->setMethod('post');
        $this->setAttrib('class', 'form-horizontal');
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => $this->_rowModel->getValidator('username'),
            'required'   => true,
            'label'      => 'Username:',
        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required'   => true,
            'label'      => 'Password:',
        ));

	    $this->addElement('password', 'password_confirmation', array(
	        'filters'    => array('StringTrim'),
	        'validators' => array(
	            array('StringLength', false, array(0, 50)),
	        ),
	        'required'   => true,
	        'label'      => 'Repeat password:',
	    ));
		
		$submit      = new Zend_Form_Element_Button('submit');
        
        $submit->setLabel('Save');
		$this->addElement($submit);
		
		// add display group
        $this->addDisplayGroup(
            array('username', 'password', 'password_confirmation', 'submit'),
            'users'
        );
        $this->getDisplayGroup('users')->setLegend('Register');

	    // set decorators
	    EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');

    }

}