<?php
require 'this.php';

include("vendor/autoload.php");

use Zendesk\API\HttpClient as ZendeskAPI;


$subdomain = "lambdasolutionsdev.zendesk.com";
$username  = "mariya.pak@lambdasolutions.net";
$token     = "drv5UZaRc7A8WcXwWErssQ6GIEgxIwLO8xiPPYe6";

$client = new ZendeskAPI($subdomain);

$client->setAuth('basic', ['username' => $username, 'token' => $token]);

try {

	// CREATE ORGANIZATION
	// $accountname, $owner, $address, $phone, $website from this.php

	$url = 'https://lambdasolutionsdev.zendesk.com/api/v2/organizations.json' ;
	$ch = curl_init($url);
	//$address = $street . "\n" . $city ."\n". $state;
	//echo $address;

	// TODO: how to output a "multi line text" type variable...
	//$data = "{ \"organization\": {
	//			\"name\": \"$accountname\", \"organization_fields\": {\"account_owner\":\"$owner\", \"address\": \"$address\", \"phone_number\":\"$phone\",\"website\":\"$website\"}}}";

	$data = "{ \"organization\": {
				\"name\": \"$accountname\", \"organization_fields\": {\"account_owner\":\"$owner\", \"phone_number\":\"$phone\",\"website\":\"$website\"}}}";

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . "lambdasecret1");

    $response = curl_exec($ch);
    curl_close($ch);




} catch (\Zendesk\API\Exceptions\ApiResponseException $e) {
    echo 'Please check your credentials. Make sure to change the $subdomain, $username, and $token variables in this file.';
}

?>