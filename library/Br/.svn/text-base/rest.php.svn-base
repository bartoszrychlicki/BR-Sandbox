<?php
class Br_Rest { 
	
    public function __construct($user, $password)
    {
        $this->_user = $user;
        $this->_password = $password;
    	
    }

    public function get($url, $authenticate = true, $curlopt = null)
    {
        return $this->curlGet('http://' . $this->_user . ':' . $this->_password . '@' . $url, $curlopt);
    }
    
    public function getHttpHeaders() {
        return $this->_httpHeaders;
    }
    public function addHttpHeader($val) {
        $this->_httpHeaders[] = $val;
    }

    public function curlGet($url, $curlopt = array())
    {
        $ch = curl_init();
        $default_curlopt = array(
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HEADER => 0,
            CURLOPT_TIMEOUT => 8,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            //CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 AlexaToolbar/alxf-1.54 Firefox/3.6.13 GTB7.1"
        );
        $this->addHttpHeader('Accept: application/xml');
        
        $headers = $this->getHttpHeaders();
        if($headers) {
            $default_curlopt[CURLOPT_HTTPHEADER] = $this->getHttpHeaders();
        }
        
        $curlopt = array(CURLOPT_URL => $url) + $default_curlopt;
        curl_setopt_array($ch, $curlopt);
        $response = curl_exec($ch);
        if ($response === false)
            trigger_error(curl_error($ch));
        curl_close($ch);
        return $response;
    }
}
?>