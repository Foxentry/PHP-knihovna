<?php

namespace Foxentry;

class Address extends Foxentry
{ // BEGIN class Address
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    
    function setRequestQuery($query)
    { // BEGIN function setQuery
        $this->request->setRequestQuery($query);	
    } // END function setQuery
    
    function validate()
    { // BEGIN function validate
        $this->request->setEndpoint("locations/validate");
        $this->request->run();
        
        if ($this->request->errorResponse()) {
            $this->handleResponseError();
        }
    } // END function validate
     
} // END class Address

?>