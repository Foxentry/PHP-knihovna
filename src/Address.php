<?php

namespace Foxentry;

class Address extends Foxentry
{ // BEGIN class Address
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct

    function validate($query)
    { // BEGIN function validate
        $this->request->setEndpoint("locations/validate");
        $this->request->setRequestQuery($query);	
        $this->request->run();
    } // END function validate
    
    function hint($query)         
    { // BEGIN function hint      
        $this->request->setEndpoint("locations/search");
        $this->request->setRequestQuery($query); 	
        
        $this->request->run();
    } // END function hint
     
} // END class Address

?>