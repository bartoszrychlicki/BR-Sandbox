<?php
/**
* 
*/
class User_Model_User_Row extends Br_Db_Table_Row implements User_Model_User_Interface
{
	protected static $_validators = array(
		'username' => array(
			'Alpha', array('StringLength', false, array(3, 20)),
			),
	);
}
