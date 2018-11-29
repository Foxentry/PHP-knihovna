<?php

namespace Foxentry;

class Phone extends Foxentry
{ // BEGIN class Phone
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    
    function validate($phonePrefix = null, $phoneNumber, $validationType = "basic")
    { // BEGIN function validate                                     	
        $this->request->setEndpoint("phone/validate");
        $this->request->setRequestOption("validationType", $validationType);
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
    } // END function validate
     
} // END class Phone

?>