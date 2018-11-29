<?php

namespace Foxentry;

class Email extends Foxentry
{ // BEGIN class Foxentry
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    
    function validate($email, $validationType = "basic")
    { // BEGIN function validate       
        $this->request->setEndpoint("email/validate");
        $this->request->setRequestOption("validationType", $validationType);	
        $this->request->setRequestQuery(
            array(
                "email" => $email,
            )
        );
 
        $this->request->run();
        
        if ($this->request->errorResponse()) {
            $this->handleResponseError();
        }
    } // END function validate
     
} // END class Foxentry

?>