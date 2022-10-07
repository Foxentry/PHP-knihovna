<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->address->hint(
    array(
        "searchType" => "streetWithNumber", // type of search, probably type of input which is end user filling
        "streetWithNumber" => "Václav", // find streets or streets with numbers that has some type of match with string "Václav" (match, prefix, fulltext, fuzzy)
        "city" => "Praha", // limit results to streets or streets with numbers located in city that has some type of match with string "Praha" (match, prefix, fulltext, fuzzy) 
    )
); 

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>