<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->company->get(
    array(
      "registrationNumber" => "06190570"
    )
);

$validationResult = $api->getResults();
$creditsUsage     = $api->getCreditsUsage();	

print_r($validationResult);
print_r($creditsUsage);

// RESULTS PRINT
if ($validationResult->valid) {
	echo "Company is valid.<br>\n";
}
else {
	echo "Company is invalid.<br>\n";
}

?>