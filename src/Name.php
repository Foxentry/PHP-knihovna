<?php

namespace Foxentry;

class Name extends Foxentry
{ // BEGIN class Name
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    

    function validateName($name)
    { // BEGIN function validateName
        $this->validate("name", $name);    
    } // END function validateName
    
    function validateSurname($name)
    { // BEGIN function validateSurname
        $this->validate("surname", $name);    
    } // END function validateSurname
    
    function validateNameSurname($name)
    { // BEGIN function validateNameSurname
        $this->validate("nameSurname", $name);    
    } // END function validateNameSurname
     
    function validate($type, $value)
    { // BEGIN function validate
        $this->request->setEndpoint("names/validate");	
        $this->request->setRequestQuery(
            array(
                $type => array(
                    "value" => $value
                ),
            )
        );
        
        $this->request->run();
        
        if ($this->request->errorResponse()) {
            $this->handleResponseError();
        }	
    } // END function validate 
     
} // END class Name

?>