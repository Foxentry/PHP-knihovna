<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");
$api->setEndpoint("locations/streets/search");

// limit results to streets with name "Václ" (match) or with name starting with "Václ" (prefix)
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "street.name",
        "value" => "Václ"
    )
);

// limit results to streets in city with name "Praha" (match)
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "city.name",
        "value" => "Praha"
    )
);      

$api->setPagination(10, 0);

$api->run();

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>