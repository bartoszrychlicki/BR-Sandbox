<?php
class Br_Rest_Space extends Br_Rest {
    protected $_url = 'www.assembla.com/spaces/my_spaces/';
    protected $_cache;
    
    public function __construct($user, $password) {
        parent::__construct($user, $password);
    }
    
    public function getSpaces() {
    	$cacheId = 'spaceslist';
        $raw = $this->get($this->_url);
        $response = simplexml_load_string($raw);
        return $response->space;
    }
    
    public function getSpacesIds() {
    	$spaces = $this->getSpaces();
    	if(count($spaces) > 0 ) {
    		foreach($spaces as $space) {
    			$ids[] = (string)$space->id;
    		}
    	}
    	return $ids;
    }
}