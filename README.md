# Rapid SMS Nigeria PHP SDK

Rapid SMS PHP SDK is built for Rapid SMS - Bulk SMS Application


### Prerequisites

To use Rapid SMS SDK you must have created an account with Rapid SMS. 
For more details please visit: [Rapid SMS](https://rapidsmsng.com/)
```
php >=7.2
Rapid SMS - Bulk SMS Application
```

### Installing
Via Composer
```
composer require rapidsmsng/sms-php-sdk 
```

And Via Bash

```
git clone https://github.com/rapidsmsng/sms-php-sdk.git
```

## Usage


 ### Step 1:
If installing Rapid SMS SDK using Git Clone then load your Rapid SMS SDK Class files with the use of namespaces. 
```php
require_once 'src/RapidSMS.php';
use RapidSMS\RapidSMS;
```

If installing Rapid SMS API using Composer then require/include autoload.php file in the index.php of your project or whatever file you need to use **Rapid SMS SDK** classes:. 
```php
require 'vendor/autoload.php';
use RapidSMS\RapidSMS;
```

### Step 2:
Get your API_KEY from `https://rapidsmsng.com/sms-api/info` (from within your account)
```php
$apiKey = 'YWRtaW46YWRtaW4ucGFzc3dvcmQ=';
```

### Step 3:
Change to your Sender ID. Submit Sender ID for approval from here https://rapidsmsng.com/user/sms/sender-id-management
```php
$from = 'RapidSMSNG';
```

### Step 4:
the number we are sending to - Any phone number
```php
$destination = '08028333008';
```

For multiple number please use Comma (,) after every single number.
```php
$destination = '08028333008,09054036811,09087040398';
```
You can insert maximum 100 numbers using comma separated string in single api request.

### Step 5:
Replace your URL with `https://rapidsmsng.com/sms/api`.
`sms/api` is mandatory.

```php
$url = 'https://rapidsmsng.com/sms/api';
```

// SMS Body
```php
$sms = 'Test message from RAPID SMS';
```

// Unicode SMS
```php
$unicode = '1'; //For Unicode message
```

// Schedule SMS
```php
$scheduleDate = '05/17/2020 10:20 AM'; //Date like this format: m/d/Y h:i A
```

// Create Plain/text SMS Body for request
```php
$smsBody = array(
    'api_key' => $apiKey,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms
);
```

// Create Unicode SMS Body for request
```php
$smsBody = array(
    'api_key' => $apiKey,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms,
    'unicode' => $unicode,
);
```

// Create SMS Body for Schedule request
```php
$smsBody = array(
    'api_key' => $apiKey,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms,
    'schedule' => $scheduleDate,
);
```

### Step 6: 
Instantiate a new Rapid SMS API request
```php
$client = new RapidSMS\RapidSMS();
```

## Send SMS
Finally send your sms through Rapid SMS API
```php
$response = $client->sendSms($url, $smsBody);
```

## Get Inbox
Get all your messages
```php
$getInbox = $client->getInbox($apiKey, $url);
```

## Get Balance
Get your account balance
```php
$getBalance = $client->checkBalance($apiKey, $url);
```
## Response
Rapid SMS API return response in `json` format, like:

```json
{"code": "ok","message": "Successfully Send"}
```

## Delivery Reports
Pushing delivery reports to an endpoint you specify is coming soon

## Status Code

| Status | Message |
| --- | --- |
| `ok` | Successfully queued |
| `100` | Bad gateway requested |
| `101` | Wrong action |
| `102` | Authentication failed |
| `103` | Invalid phone number |
| `104` | Phone coverage not active |
| `105` | Insufficient balance |
| `106` | Invalid sender id |
| `107` | Invalid SMS type |
| `108` | SMS gateway not active |
| `109` | Invalid schedule time |
| `110` | SMS contain spam word. Pending approval |

## Authors

* **Kenneth Onah** - *Initial work* - [rapidsmsng](https://github.com/rapidsmsng)
