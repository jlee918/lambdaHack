<?php
require 'this.php';

include("vendor/autoload.php");

use Zendesk\API\HttpClient as ZendeskAPI;


$subdomain = "lambdasolutionsdev.zendesk.com";
$username  = "mariya.pak@lambdasolutions.net"; // replace this with your registered email
$token     = "drv5UZaRc7A8WcXwWErssQ6GIEgxIwLO8xiPPYe6"; // replace this with your token

$client = new ZendeskAPI($subdomain);

$client->setAuth('basic', ['username' => $username, 'token' => $token]);

try {
	$url = 'https://lambdasolutionsdev.zendesk.com/api/v2/organizations.json' ;
	$ch = curl_init($url);
	// TODO: how to output a "multi line text" type variable...
	//$address = "$street\n$city\n$state\n$country\n$postal";
	//echo $address;

	$data = "{ \"organization\": {
				\"name\": \"$accountname\", \"organization_fields\": {\"account_owner\":\"$ownerId\",\"phone_number\":\"$phone\",\"website\":\"$website\"}}}";

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