<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");
$api->setEndpoint("locations/points/search");


// limit results to only address points in city with exact name "Praha"
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "city.name",
        "value" => "Praha"
    )
);   

// limit results to only address points with exact street name "Vác" or street name starting with "Vác"
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "street.name",
        "value" => "Vác"
    )
);  

// limit results to only address points with exact ZIP "11000"
$api->addQueryParam(
    array(
        "searchModes" => array("match"),
        "key" => "zip",
        "value" => "11000"
    )
);      

$api->setPagination(10, 0);

$api->run();

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

echo "RESULTS FOUND: ".count($results)."\n";
print_r($creditsUsage);
print_r($results);

?>