<?php
 
namespace Foxentry;

class Request {     
    private $requestOptions;
    private $requestQuery;
    private $endpoint;
    private $apiKey;

    function __construct()
    { // BEGIN function __construct     
        $this->requestOptions = (object)array(
            "requestCountry" => "cz"
        );
        $this->requestQuery   = null;
        $this->apiKey = null;
    } // END function __construct

    function setEndpoint($endpoint)
    { // BEGIN function setEndpoint
        $this->endpoint = $endpoint;
    } // END function setEndpoint

    function setApiKey($apiKey)
    { // BEGIN function setApiKey
        $this->apiKey = $apiKey;
    } // END function setApiKey

    function setRequestOption($name, $value)
    { // BEGIN function setRequestOption    
        if (is_null($this->requestOptions)) { $this->requestOptions = new \stdClass(); }
        $this->requestOptions->$name = $value;
    } // END function setRequestOption

    function setRequestCountry($country)
    { // BEGIN function setRequestCountry
        $this->setRequestOption("country", $country);
    } // END function setRequestCountry

    function setPagination($limit = 20, $offset = 0)
    { // BEGIN function setLimits
        $this->setRequestOption("limits", array(
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

    function setRequestQuery($query)
    { // BEGIN function setQuery
        $this->requestQuery = $query;	
    } // END function setQuery

    function getRequest()
    { // BEGIN function getRequest     
        if (is_null($this->requestOptions)) {
        	$this->requestOptions = array();
        }
        $data = (object)array(
            "apiKey"  => $this->apiKey,
            "options" => $this->requestOptions,
            "query"   => $this->requestQuery,
        );
        return $data;
    } // END function getRequest

    function validateRequest($request)
    { // BEGIN function validateRequest
        if ($request->apiKey === "" OR is_null($request->apiKey)) {
            throw new \Exception('You have not inputed API key. Use "setApiKey" method for setting your project API key.');
        }

        if (!is_object($request->query) AND !is_array($request->query)) {
            throw new \Exception('You have not set request query. Use "setRequestQuery" method for setting your request parameters.');
        }
    } // END function validateRequest

    function run()
    { // BEGIN function run
        $request = $this->getRequest();
        $this->validateRequest($request);
        
        $this->response = $this->curl->run($this->apiVersion, $this->endpoint, $request);
        
        if ($this->errorResponse()) {
            $this->handleResponseError();
        }
    } // END function run

    function getResponse()
    { // BEGIN function getResponse
    	return $this->response;
    } // END function getResponse
    
    function handleResponseError()
    { // BEGIN function handleResponseError
        $response = $this->getResponse();
        throw new \Exception($response->error);
    } // END function handleResponseError
    
    function errorResponse()
    { // BEGIN function errorResponse
        return isset($this->response->error);	
    } // END function errorResponse

}
