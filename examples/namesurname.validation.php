<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("yourApiKey");

$api->name->validateNameSurname("Petr Novák");

$validationResult = $api->getResults();
$creditsUsage     = $api->getCreditsUsage();	

// RESULTS PRINT
if ($validationResult->nameSurname->valid) {
	echo "Name and surname combination is valid.<br>\n";
}
else {
	echo "Name and surname combination is invalid.<br>\n";
}

?>