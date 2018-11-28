<?php

namespace Foxentry;

class Foxentry extends Request
{ // BEGIN class Foxentry
	
    function __construct()
    { // BEGIN function __construct
        $this->base    = new Base;  
        $this->curl    = new Curl;
    	//$this->request = new Request;
        $this->loadHelpers();
    } // END function __construct
    /*
    function setApiKey($apiKey)
    { // BEGIN function setApiKey
        $this->request->setApiKey($apiKey);
    } // END function setApiKey
    
    function setRequestCountry($country)
    { // BEGIN function setRequestCountry
        $this->request->setRequestCountry($country);
    } // END function setRequestCountry

    function setPagination($limit = 20, $offset = 0)
    { // BEGIN function setPagination
        $this->request->setPagination("limits", array(
            "results" => $limit,
            "offset" => $offset
        ));
    } // END function setPagination    
     */
    function loadHelpers()
    { // BEGIN function loadHelpers
    	$this->address = new Address($this);
    	$this->email   = new Email($this);
    	$this->phone   = new Phone($this);
    	$this->name    = new Name($this);
    } // END function loadHelpers
    
    function handleResponseError()
    { // BEGIN function handleResponseError
        $response = $this->getResponse();
        throw new \Exception($response->error);
    } // END function handleResponseError

    function getResults()
    { // BEGIN function getResults
        if (isset($this->response->data->results)) {
        	return $this->response->data->results;
        }	
        else {
        	return array();
        }
    } // END function getResults
    
    function getResult()
    { // BEGIN function getResult
        if (isset($this->response->data)) {
        	return $this->response->data;
        }	
        else {
        	return null;
        }	
    } // END function getResult
    
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