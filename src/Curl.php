<?php
namespace Foxentry;
class Curl
{ // BEGIN class Curl

	private $timeout = 5;
    private $apiUrl = "https://dev.api.foxentry.cz/v1/";
    
    function __construct()
    { // BEGIN function __construct
    	$this->base   = new Base();
    } // END function __construct
    
    function setApiUrlByVersion($apiVersion)
    { // BEGIN function setApiUrlByVersion
        $this->apiUrl = "https://dev.api.foxentry.cz/v$apiVersion/";	
    } // END function setApiUrlByVersion
    
    function run($apiVersion, $endpoint, $postData)
    { // BEGIN function run
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->apiUrl.$endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData, JSON_UNESCAPED_UNICODE));
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
    
            $response = curl_exec($ch);
            //var_dump($response);
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