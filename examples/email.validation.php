<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->email->setValidationType("basic");
$api->email->validate("info@foxentry.cz");

$validationResult = $api->getResult();
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