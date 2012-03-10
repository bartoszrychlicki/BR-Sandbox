<?php

class Acl_Form_RoleDelete extends EasyBib_Form {
	
	
	public function init()
	{
		$this->setName('roleDelete');
		$this->setMethod('post');
		$this->setAttrib('class', 'form-horizontal');
		$this->setAction('delete-role');
		$cancel      = new Zend_Form_Element_Button('cancel');
		$this->addElement('hidden', 'id', array(
				'filters'	=>	array('Int')
		));
		

		$submit      = new Zend_Form_Element_Button('submit');
		
		$submit->setLabel('Delete');
		$this->addElement($submit);
		$this->addElement($cancel);
		
		// add display group
		$this->addDisplayGroup(
				array('submit', 'cancel'),
				'Role'
		);
		//$this->getDisplayGroup('Role')->setLegend('Delete a role');
		
		// set decorators
		EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');	
	}
	
}

?>