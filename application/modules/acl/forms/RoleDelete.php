<?php

class Acl_Form_RoleDelete extends EasyBib_Form {
	
	
	public function init()
	{
		$this->setName('roleDelete');
		$this->setMethod('post');
		$this->setAttrib('class', 'form-horizontal');
		$this->setAction('delete-role');
		$this->addElement('hidden', 'id', array(
				'filters'	=>	array('Int')
		));
		

		$submit      = new Zend_Form_Element_Button('submit');
		
		$submit->setLabel('Delete');
		$this->addElement($submit);
		
		
		// set decorators
		EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');	
	}
	
}

?>