<?php
/**
* 
*/
class Acl_IndexController extends Br_Controller_Action
{
	/**
	 * Displays all rules we have in systens for each module/controller/action and  it's roles
	 */
	public function indexAction()
	{
		
	}
	
	/**
	 * Display roles and it's users. 
	 * 
	 * Allows to add, delete or manage roles.
	 */
	public function rolesAction()
	{
		$roleTable = new Zend_Db_Table('aclrole');
		
		$roles = $roleTable->fetchAll();
		$this->view->roles = $roles;
		
		// Fetching form for new role
		$request = $this->getRequest();
		
		$form = new Acl_Form_Role();
		if($roleId = $request->getParam('id')) {
			$role = $roleTable->find($roleId)->current();
			$form->populate($role->toArray());
	        $form->getDisplayGroup('Role')->setLegend('Modify role ' . $role->name);
		}
		
		if($request->isPost()) {
			if($form->isValid($post = $request->getPost())) {
				if(!$role) { // new role
					$role = $roleTable->createRow();
				}
				$role->name = $post['name'];
				$role->save();
				$this->_helper->FlashMessenger(array('success' => 'Changes to role saved'));
				$this->_helper->Redirector('roles', 'index', 'acl');
				
			}
		}
		$this->view->form = $form;
		
	}
	
	/**
	 * We can allow or deny access to any module/controller/action
	 */
	public function changePrivilegeAction()
	{
		
	}
}

?>