<?php
class Br_Assembla_Tickets {
	private $_db;
	
	
	public function __construct($db, $config) 
	{
		$this->_db = $db;
		$this->_config = $config;
	}
	
    public function batchupdateticketsAction() 
    {
    	$space = new Application_Model_DbTable_Space();
    	$spaces = $space->fetchAll()->toArray();
    	if(!$spaces) {
    		throw new Exception('Nie ma spece w db, wiec nie ma jak pobrac tikcetow');
    	}
    	
    	$ticket = new Application_Model_DbTable_Ticket();
    	
    	foreach($spaces as $space) {
    		$wikiname = $space['wikiname'];
    		$rest = new Br_Rest_Ticket($this->_config->assembla->user, $this->_config->assembla->password);
    		$tickets = $rest->getTicketsBySpaceWikiName($wikiname);
    		if($tickets) {
    			$this->_db->delete('ticket', 'space_wikiname = "'.$wikiname.'"');
    		}
    		$ticket_tb = new Application_Model_DbTable_Ticket();
			$counter[$wikiname] = $ticket_tb->insertTickets($tickets, $wikiname);
    	}
    	Zend_Debug::Dump($counter);    	
    }	
}
?>