<?php
namespace Foxentry;
class Curl
{ // BEGIN class Curl

	private $timeout = 5;
    private $apiUrl = "https://api.foxentry.cz/v1/";
    
    function __construct()
    { // BEGIN function __construct
    	$this->base   = new Base();
    } // END function __construct
    
    function setApiUrlByVersion($apiVersion)
    { // BEGIN function setApiUrlByVersion
        $this->apiUrl = "https://api.foxentry.cz/v$apiVersion/";	
    } // END function setApiUrlByVersion
    
    function needsLongerTimeout($postData)
    { // BEGIN function needsLongerTimeout
        return (is_object($postData) AND isset($postData->options) AND isset($postData->options->validationType) AND $postData->options->validationType == "extended");	
    } // END function needsLongerTimeout
    
    function run($apiVersion, $endpoint, $postData)
    { // BEGIN function run
        $timeout = $this->needsLongerTimeout($postData) ? 15 : $this->timeout;

        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->apiUrl.$endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                                                    
            //print_r($postData);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData, JSON_UNESCAPED_UNICODE));
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
    
            $response = curl_exec($ch);
            //var_dump($response);
            
            if (curl_errno($ch) !== CURLE_OK) {
            	throw new \Exception("API CURL connection failed with error: ".curl_error($ch));
            }
            
            curl_close($ch);
    
            $resp = $this->base->parseJson($response);
            //var_dump($resp);
            
            if (is_null($resp)) {
                throw new \Exception("API response not JSON.");	
            }
            else {
                return $resp;	
            }
        } 
        catch (\Exception $e) {
            return (object)array(
                "error" => $e->getMessage()
            );
        }
    } // END function run
    
} // END class Curl

?>