<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");
$api->setEndpoint("locations/streets/search");
$api->addQueryParam(
    array(
        "searchModes" => array("match", "prefix"),
        "key" => "street.name",
        "value" => "Václava"
    )
);

$api->run();

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>