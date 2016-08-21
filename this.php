<?php

define("USERNAME", "george.mihailov@lambdasolutions.net");
define("PASSWORD", "lambdasecret1");
define("SECURITY_TOKEN", "zGzLgLtwcoViBkDe5r7gAYQMn");

require_once ('soapclient/SforceEnterpriseClient.php');

$mySforceConnection = new SforceEnterpriseClient();
$mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

$query = "SELECT OwnerId, Website, BillingCity, BillingCountry, BillingPostalCode, BillingState, BillingStreet, Name, Phone from Account
where BillingState = 'Singapore' ";
$response = $mySforceConnection->query($query);



;

foreach ($response->records as $record) {
    $accountname = $record->Name; // United Oil & Gas, Singapore
    $ownerId = $record->OwnerId;
    $website = $record->Website;
    $city = $record->BillingCity;
    $street = $record->BillingStreet;
    $postal = $record->BillingPostalCode; // for Singapore outs nothing
    $state = $record->BillingState;
    $country = $record->BillingCountry; // for Singapore outs nothing
    $phone = $record->Phone;


}

//$final = "SELECT AccountId FROM AccountContactRole ";
//$queryCon = "SELECT Name, Email FROM Contact where AccountId = :($final)";

$queryCon = "SELECT Name, Email FROM Contact WHERE Account.BillingState = '$state' ";
$responseCon = $mySforceConnection->query($queryCon);


foreach ($responseCon->records as $record) {
    $email = $record->Email. "\n" ;
    $name = $record->Name.  "\n" ;

}


//echo $email;
//echo $name;

?>