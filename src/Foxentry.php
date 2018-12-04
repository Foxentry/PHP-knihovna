<?php

namespace Foxentry;

class Foxentry extends Request
{ // BEGIN class Foxentry
	
    function __construct()
    { // BEGIN function __construct
        $this->base    = new Base;  
        $this->curl    = new Curl;
        
        $this->apiVersion = 1;
        $this->loadHelpers();
    } // END function __construct

    function setApiVersion($version)
    { // BEGIN function setApiVersion
    	$this->apiVersion = $version;
        $this->curl->setApiUrlByVersion($version);
    } // END function setApiVersion

    function loadHelpers()
    { // BEGIN function loadHelpers
    	$this->address = new Address($this);
    	$this->email   = new Email($this);
    	$this->phone   = new Phone($this);
    	$this->name    = new Name($this);
    	$this->company = new Company($this);
    } // END function loadHelpers

    function getResults()
    { // BEGIN function getResults
        if (isset($this->response->data->results)) {
        	return $this->response->data->results;
        }
        else if (isset($this->response->data)) {
        	return $this->response->data;
        }	
        else {
        	return array();
        }
    } // END function getResults
    
    function getCreditsUsage()
    { // BEGIN function getCreditsUsage
        if (isset($this->response->usage)) {
        	return $this->response->usage;
        }	
        else {
        	return null;
        }		
    } // END function getCreditsUsage

} // END class Foxentry

?>