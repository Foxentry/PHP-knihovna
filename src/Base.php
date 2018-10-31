<?php                             

namespace Foxentry;

class Base
{ // BEGIN class Base
	
    function parseJson($json)
    { // BEGIN function parseJson
        $data = json_decode($json);
        
        if (json_last_error() == JSON_ERROR_NONE) {
        	return $data;
        }
        return null;
    } // END function parseJson

} // END class Base

?>