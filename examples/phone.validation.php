<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->phone->setValidationType("extended");
$api->phone->validate("607123456", "+420"); // alternatively enter full number as first parameter (+420607123456)

$validationResult = $api->getResult();
$creditsUsage     = $api->getCreditsUsage();	

print_r($validationResult);
print_r($creditsUsage);

if ($validationResult->valid) {
	echo "Phone number is valid.";
}
else {
	echo "Phone number is invalid.";
}

?>