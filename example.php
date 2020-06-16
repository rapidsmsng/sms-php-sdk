<?php

/* Send an SMS using Rapid SMS API. You can run this file 3 different ways:
 *
 * 1. Save it as example.php and at the command line, run
 *         php example.php
 *
 * 2. Upload it to a web host and load mywebhost.com/example.php
 *    in a web browser.
 *
 * 3. Download a local server like WAMP, MAMP or XAMPP. Point the web root
 *    directory to the folder containing this file, and load
 *    localhost:8888/example.php in a web browser.
 */


// Step 1: Get the RAPID SMS SDK library from https://github.com/rapidsmsng/sms-php-sdk,
// follow the instructions to install it with Composer.

require_once 'src/RapidSMS.php';
use RapidSMS\RapidSMS;


// Step 2: Set your API_KEY you got from https://rapidsmsng.com/sms-api/info
$apiKey = 'YWRtaW46YWRtaW4ucGFzc3dvcmQ=';


// Step 3: Change to your Sender ID (max 10 characters). Submit Sender ID for approval from here https://rapidsmsng.com/user/sms/sender-id-management
$from = 'RapidSMSNG';

// Step 4: The number we are sending to - Any phone number
$destination = '08132790865';

// Step 5: Replace your URL like https://rapidsmsng.com/sms/api
// <sms/api> portion is mandatory.

$url = 'https://rapidsmsng.com/sms/api';

// the sms body
$sms = 'Test message from Rapid SMS API';

// unicode sms
$unicode = 0; //For Plain Message
$unicode = 1; //For Unicode Message


// Create SMS Body for request
$smsBody = array(
    'api_key' => $apiKey,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms,
    'unicode' => $unicode,
);

// Step 6: instantiate a new Rapid SMS API request
$client = new RapidSMS();

// Step 7: Send SMS
$response = $client->sendSms($url, $smsBody);

print_r($response);


// Step 8: Get Response
$response = json_decode($response);

// Display a confirmation message on the screen
echo 'Message: ' . $response->message;


//Step 9: Get your inbox
$inbox = $client->getInbox($apiKey, $url);

//Step 10: Get your account balance
$balance = $client->checkBalance($apiKey, $url);

