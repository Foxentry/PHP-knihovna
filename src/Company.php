<?php

namespace Foxentry;

class Company extends Foxentry
{ // BEGIN class Company
	
    function __construct($requester)
    { // BEGIN function __construct
        $this->request = $requester;
    } // END function __construct

    function get($query)
    { // BEGIN function get
        $this->request->setEndpoint("company/get");
        $this->request->setRequestQuery($query);	
        $this->request->run();
    } // END function get
    
    function search($query)         
    { // BEGIN function search      
        $this->request->setEndpoint("company/search");
        $this->request->setRequestQuery($query); 	
        
        $this->request->run();
    } // END function search
     
} // END class Company

?>