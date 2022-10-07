<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->email->validate("info@foxentry.cz", "basic");

$validationResult = $api->getResults();
$creditsUsage     = $api->getCreditsUsage();	

print_r($validationResult);
print_r($creditsUsage);

if ($validationResult->valid) {
	echo "Email address is valid.";
}
else {
	echo "Email address is invalid.";
}

?>