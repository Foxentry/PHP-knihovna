<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->phone->validate("+420", "607123456", "extended"); // international prefix, phone number, validationType

// alternatively, (if you do not have prefix and number separately), leave first parameter empty (empty string or null) and enter full number as second parameter
// $api->phone->validate(null, "+420607123456", "extended");


$validationResult = $api->getResults();
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