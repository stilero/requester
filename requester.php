<?php

/**
 * Requester handles server communication usin cURL
 *
 * @version  1.0
 * @author Daniel Eliasson - joomla at stilero.com
 * @copyright  (C) 2014-11-11 Stilero Webdesign http://www.stilero.com
 * @category Classes
 * @license	GPLv2
 */
class Requester {
    //put your code here
 
    /**
     * @var object Curl Handle 
     */
    protected $_ch;
    protected $_url;


    public function __construct() {
        $this->_ch = curl_init();
    }
    
    /**
     * Sends the request using curl
     * @return type
     */
    private function curlit(){
        curl_setopt($this->_ch,CURLOPT_URL, $this->_url);
        curl_setopt($this->_ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->_ch, CURLOPT_HEADER, false);
        $result = curl_exec($this->_ch);
        curl_close($this->_ch);
        return $result;
    }
    
    /**
     * Sends the request as POST
     * @param string $url
     * @param array $params
     * @return String
     */
    public function post($url, $params){
        $this->_url = $url;
        $query = http_build_query($params);
        $numParams = count($params);
        curl_setopt($this->_ch,CURLOPT_POST, $numParams);
        curl_setopt($this->_ch,CURLOPT_POSTFIELDS, $query);
        return $this->curlit();
    }
    
    /**
     * Send the request as GET
     * @param string $url
     * @return String
     */
    public function get($url){
        $this->_url = $url;
        return $this->curlit();
    }
    /**
     * Send a PUT request
     * @param string $url
     * @param array $params
     */
    public function put($url, $params){
        $this->_url = $url;
        $query = http_build_query($params);
        curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "PUT");
        
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $query);
        //curl_setopt($this->_ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $token"));
        return $this->curlit();
    }
    /**
     * Send a DELETE request
     * @param string $url
     * @param array $params
     */
    public function delete($url){
        $this->_url = $url;
        curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        //curl_setopt($this->_ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $token"));
        return $this->curlit();
    }
}
?>