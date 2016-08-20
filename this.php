<?php

define("USERNAME", "george.mihailov@lambdasolutions.net");
define("PASSWORD", "lambdasecret1");
define("SECURITY_TOKEN", "zGzLgLtwcoViBkDe5r7gAYQMn");

require_once ('soapclient/SforceEnterpriseClient.php');

$mySforceConnection = new SforceEnterpriseClient();
$mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

$query = "SELECT OwnerId, Website, BillingCity, BillingCountry, BillingPostalCode, BillingState, BillingStreet, Phone from Account
where BillingState = 'Singapore' ";
$response = $mySforceConnection->query($query);



foreach ($response->records as $record) {
    $ownerId = $record->OwnerId;
    $website = $record->Website;
    $city = $record->BillingCity;
    $street = $record->BillingStreet;
    $postal = $record->BillingPostalCode; // for Singapore outs nothing
    $state = $record->BillingState;
    $country = $record->BillingCountry; // for Singapore outs nothing
    $phone = $record->Phone;

}



?>