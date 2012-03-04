<?php
class Acl_Form_Role extends EasyBib_Form
{

    public function init()
    {
        $this->setName("role");
        $this->setMethod('post');
        $this->setAttrib('class', 'form-horizontal');
        
		$cancel      = new Zend_Form_Element_Button('cancel');
        
        $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required'   => true,
            'label'      => 'Role name:',
        ));

		$this->addElement('hidden', 'id', array(
			'filters'	=>	array('Int')
			));

		
		$submit      = new Zend_Form_Element_Button('submit');
        
        $submit->setLabel('Save');
		$this->addElement($submit);
		$this->addElement($cancel);
		
		// add display group
        $this->addDisplayGroup(
            array('name', 'submit', 'cancel'),
            'Role'
        );
        $this->getDisplayGroup('Role')->setLegend('Add new role');

	    // set decorators
	    EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');

    }

}