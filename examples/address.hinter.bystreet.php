<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");
$api->setEndpoint("locations/search");
$api->setRequestQuery(
    array(
        "searchType" => "streetWithNumber",
        "streetWithNumber" => "Jesen",
        //"city" => "Praha", // you can limit street results by city (value "Praha" will limit results to only streets located in "Praha")
    )
); 

$api->run();

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>