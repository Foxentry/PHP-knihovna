<?php
 
namespace Foxentry;

class request{
     
    private $requestOptions;
    private $requestQuery;
    private $endpoint;
    private $apiKey;

    function __construct()
    { // BEGIN function __construct     
        $this->base   = new Base();  
        $this->curl   = new Curl();
        
        $this->requestOptions = new \stdClass();
        $this->requestQuery   = array();
    } // END function __construct

    function setEndpoint($endpoint)
    { // BEGIN function setEndpoint
        $this->endpoint = $endpoint;
    } // END function setEndpoint

    function setApiKey($apiKey)
    { // BEGIN function setApiKey
        $this->apiKey = $apiKey;
    } // END function setApiKey

    function setOption($name, $value)
    { // BEGIN function setOption
        $this->requestOptions->$name = $value;
    } // END function setOption

    function setRequestCountry($country)
    { // BEGIN function setRequestCountry
        $this->setOption("country", $country);
    } // END function setRequestCountry

    function setPagination($limit = 20, $offset = 0)
    { // BEGIN function setLimits
        $this->setOption("limits", array(
            "results" => $limit,
            "offset" => $offset
        ));
    } // END function setLimits

    function addQueryParam($data)
    { // BEGIN function addQueryParam
        if (!isset($this->requestQuery["params"])) {
                $this->requestQuery["params"] = array();
        }

        $this->requestQuery["params"][] = $data;
    } // END function addQueryParam

    function run()
    { // BEGIN function run
        $data = array(
            "apiKey"  => $this->apiKey,
            "options" => $this->requestOptions,
            "query"   => $this->requestQuery,
        );
        print_r($data);
        $response = $this->curl->run($this->endpoint, $data);
        print_R($response);
    } // END function run

}