<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->company->search(
    array(
      "name" => "Web"
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