<?php
namespace Foxentry;
class Curl
{ // BEGIN class Curl

	private $timeout = 5;
    private $apiUrl = "https://dev.api.foxentry.cz/v1/";
    
    function run($endpoint, $postData)
    { // BEGIN function run
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->apiUrl.$endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData, JSON_UNESCAPED_UNICODE));
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
    
            $response = curl_exec($ch);
            curl_close($ch);
    
            $resp = json_decode($response);
            print_r($resp);
        } 
        catch (\Exception $e) {
            var_dump($e);
        }
    } // END function run
    
} // END class Curl

?>