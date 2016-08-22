<?php

define("USERNAME", "george.mihailov@lambdasolutions.net");
define("PASSWORD", "lambdasecret1");
define("SECURITY_TOKEN", "zGzLgLtwcoViBkDe5r7gAYQMn");

require_once ('soapclient/SforceEnterpriseClient.php');

$mySforceConnection = new SforceEnterpriseClient();
$mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);


// *** LEVEL 1: Account to Organization ***

$query = "SELECT Id, OwnerId, Website, BillingCity, BillingCountry, BillingPostalCode, BillingState, BillingStreet, Name, Phone from Account
where BillingState = 'Singapore' ";
$response = $mySforceConnection->query($query);

foreach ($response->records as $record) {
    $owner = $record->Owner->Name; // George Mihailov
    $accountname = $record->Name; // United Oil & Gas, Singapore
    $accountId = $record->Id; // 001o0000006Wa6y
    $website = $record->Website;
    $city = $record->BillingCity;
    $street = $record->BillingStreet;
    $postal = $record->BillingPostalCode; // for Singapore outs nothing
    $state = $record->BillingState;
    $country = $record->BillingCountry; // for Singapore outs nothing
    $phone = $record->Phone;



}

// *** LEVEL 2: Account > Contacts to User ***

$queryCon = "SELECT Name, Email FROM Contact WHERE Account.BillingState = '$state' ";
$responseCon = $mySforceConnection->query($queryCon);


foreach ($responseCon->records as $record) {
    $email = $record->Email;
    $name = $record->Name;

}


// *** LEVEL 3: Account > Opportunity > Product to Organization ***

$queryprod = " SELECT PricebookEntry.Product2.Name from OpportunityLineItem WHERE Opportunity.AccountId = '$accountId' ";
$responsetype = $mySforceConnection->query($queryprod);

foreach ($responsetype->records as $record) {
    $product = $record->PricebookEntry->Product2->Name; // GenWatt Diesel 10k

}


?>