<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->name->validateSurname("Novák");

$validationResult = $api->getResults();
$creditsUsage     = $api->getCreditsUsage();	

// RESULTS PRINT
if ($validationResult->surname->valid) {
	echo "Surname is valid.<br>\n";
}
else {
	echo "Surname is invalid.<br>\n";
}

?>