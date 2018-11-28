<?php

namespace Foxentry;

class Name extends Foxentry
{ // BEGIN class Name
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct
    
    function setQuery($query)
    { // BEGIN function setQuery
        $this->request->setRequestQuery($query);	
    } // END function setQuery
    
    function validate()
    { // BEGIN function validate
        $this->request->setEndpoint("names/validate");
        $this->request->run();
        
        if ($this->request->errorResponse()) {
            $this->handleResponseError();
        }
    } // END function validate
     
} // END class Name

?>