<?php
/**
* 
*/
class Br_Db_Table_Row extends Zend_Db_Table_Row
{
	protected static $_validators = array();

	public function getValidator($name)
	{
		return array_key_exists($name, self::$_validators) ? self::$_validators : array();
	}
}
