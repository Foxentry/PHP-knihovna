<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->address->hint(
    array(
        "searchType" => "city", // type of search, probably type of input which is end user filling
        "city" => "Dejv", // limit results to cities, city parts and city districts with some type of match with string "Dejv" (will find Prague city part "Dejvice")
    )
); 

$results      = $api->getResults();
$creditsUsage = $api->getCreditsUsage();	

print_r($creditsUsage);
print_r($results);

?>