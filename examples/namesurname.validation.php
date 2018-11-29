<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

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