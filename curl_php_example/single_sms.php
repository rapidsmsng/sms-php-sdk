<?php

// Step 1: Get your API_KEY from https://rapidsmsng.com/sms-api/info

$apiKey = 'a3l0am5pd3JodWxwQnhCbE9nYkM=';

// Step 2: Change the from number below. It can be a valid phone number or a String
$from = '8801721000000';

// Step 3: the number we are sending to - Any phone number.
// You must have to insert country code at beginning of the number
$destination = '8801810000000';

// Step 4: Replace your URL with https://rapidsmsng.com/sms/api
// <sms/api> is mandatory.

$url = 'https://rapidsmsng.com/sms/api';

// The sms body
$sms = 'Test message from Rapid SMS API';

// Create SMS Body for request
$smsBody = [
    'action' => 'send-sms',
    'api_key' => $apiKey,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms
];

$sendData = http_build_query($smsBody);

$gatewayUrl = $url . "?" . $sendData;

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    $output = curl_exec($ch);

    if (curl_errno($ch)) {
        $output = curl_error($ch);
    }

    curl_close($ch);

    var_dump($output);

} catch (Exception $exception){
    echo $exception->getMessage();
}
