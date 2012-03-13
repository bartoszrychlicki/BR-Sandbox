<?php
class User_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'acluser';
	protected $_rowClass = 'User_Model_User_Row';
}

