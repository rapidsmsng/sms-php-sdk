<?php

// Step 1: Get your API_KEY from https://rapidsmsng.com/sms-api/info

$apiKey = 'a3l0am5pd3JodWxwQnhCbE9nYkM=';

// Step 2: Replace your URL with https://rapidsmsng.com/sms/api.
// <sms/api> is mandatory.

$url = 'https://rapidsmsng.com/sms/api';

// Create SMS Body for request
$smsBody = array(
    'action' => 'check-balance',
    'api_key' => $apiKey
);

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
