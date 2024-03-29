<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->name->validateName("Petr");

$validationResult = $api->getResults();
$creditsUsage     = $api->getCreditsUsage();	

// RESULTS PRINT
if ($validationResult->name->valid) {
	echo "Name is valid.<br>\n";
}
else {
	echo "Name is invalid.<br>\n";
}

?>