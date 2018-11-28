<?php

namespace Foxentry;

class Phone extends Foxentry
{ // BEGIN class Phone
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    
    function setValidationType($validationType = "basic")
    { // BEGIN function setValidationType
        $this->request->setOption("validationType", $validationType);	
    } // END function setValidationType
    
    function validate($phoneNumber, $phonePrefix = "")
    { // BEGIN function validate
        $this->request->setEndpoint("phone/validate");
        $this->request->setRequestQuery(
            array(
                "phoneNumber" => $phoneNumber,
                "phonePrefix" => $phonePrefix,
            )
        );

        $this->request->run();
        
        if ($this->request->errorResponse()) {
            $this->handleResponseError();
        }
        else {
        	return $this->getResult()->valid;
        }
    } // END function validate
     
} // END class Phone

?>