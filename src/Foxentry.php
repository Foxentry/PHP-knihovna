<?php

namespace Foxentry;
require_once dirname(__FILE__) . '/Request.php';
require_once dirname(__FILE__) . '/Base.php';
require_once dirname(__FILE__) . '/Curl.php';

class Foxentry extends Request
{ // BEGIN class Foxentry
    public Address $address;
    public Email $email;
    public Phone $phone;
    public Name $name;
    public Company $company;

    function __construct()
    { // BEGIN function __construct
        $this->base    = new Base;
        $this->curl    = new Curl;

        require_once dirname(__FILE__) . '/Address.php';
        require_once dirname(__FILE__) . '/Email.php';
        require_once dirname(__FILE__) . '/Phone.php';
        require_once dirname(__FILE__) . '/Name.php';
        require_once dirname(__FILE__) . '/Company.php';
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
