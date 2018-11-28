<?php

ini_set("display_errors", true);
ini_set("error_reporting", -1);

require '../vendor/autoload.php';

$api = new Foxentry\Foxentry;
$api->setApiKey("fox-IcNXuaeXfcpaXncTmLFS");

$api->name->setQuery(array(
    "name" => array(
        "value" => "Honza"
    ),
    "surname" => array(
        "value" => "Novák"
    ),
    "nameSurname" => array(
        "value" => "Martin Nováková"
    )
));

$api->name->validate();

$validationResult = $api->getResult();
$creditsUsage     = $api->getCreditsUsage();	

print_r($validationResult);
print_r($creditsUsage);

// RESULTS PRINT
if ($validationResult->name->valid) {
	echo "Name is valid.<br>\n";
}
else {
	echo "Name is invalid.<br>\n";
}

if ($validationResult->surname->valid) {
	echo "Surname is valid.<br>\n";
}
else {
	echo "Surname is invalid.<br>\n";
}

if ($validationResult->nameSurname->valid) {
	echo "Name and surname combination is valid.<br>\n";
}
else {
	echo "Name and surname combination is invalid.<br>\n";
}

?>