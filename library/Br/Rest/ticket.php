<?php
class Br_Rest_Ticket extends Br_Rest {
    protected $_url = 'www.assembla.com/spaces/%s/tickets/';

    public function getTicketsBySpaceWikiName($name)
    {
        if (empty($name)) {
            throw new Exception("Pusta nazwa spacea");
        }
        $url = sprintf($this->_url, $name);
        $raw = $this->get($url);
        $xml = @simplexml_load_string($raw);
        if($xml) {
            return $xml;            
        } else {
            return null;
        }
    }
}