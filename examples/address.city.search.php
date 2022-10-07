<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");
$api->setEndpoint("locations/cities/search");

// limit results to only cities (possible to find also city parts (type = cityPart) or city districts (type = cityDistrict), multiple values allowed)  
$api->addQueryParam(
    array(
        "key" => "type",
        "value" => array("city")
    )
); 

// limit results to streets in city with name "Praha" (match)
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "city.name",
        "value" => "Pra"
    )
);      

$api->setPagination(10, 0);

$api->run();

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>