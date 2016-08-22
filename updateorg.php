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

	// UPDATE ORGANIZATION WITH PACKAGE_TYPE FROM PRODUCT
	// $product from this.php

	$url = 'https://lambdasolutionsdev.zendesk.com/api/v2/organizations/9949499828.json' ;
	$ch = curl_init($url);
	echo $product;
	$prod = "{ \"organization\": {
				\"id\": \"9949499828\", \"organization_fields\": {\"package_type\":\"$product\"}}}";

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $prod);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . "lambdasecret1");

    $response = curl_exec($ch);
    curl_close($ch);


} catch (\Zendesk\API\Exceptions\ApiResponseException $e) {
    echo 'Please check your credentials. Make sure to change the $subdomain, $username, and $token variables in this file.';
}

?>