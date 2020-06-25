<?php

namespace RapidSMS;

/**
 * Class RapidSMS
 * @package RapidSMS
 */
class RapidSMS
{
    /**
     * @param array $smsBody
     * @return string
     *
     * Make your sms information for post sending via a POST request
     */
    private function makeSmsBody(array $smsBody): string
    {
        $postFields = '';

        foreach ($smsBody as $key => $value) {
            $postFields .= urlencode($key) . '=' . $value . '&';
        }

        $postFields = rtrim($postFields,'&');

        return $postFields;
    }

    /**
     * @param string $url
     * @param string $postBody
     * @return mixed
     *
     * Send request to server and get sms status
     */
    private function sendServerResponse($url, $postBody)
    {
        /**
         * Do not supply $postFields directly as an argument to CURLOPT_POSTFIELDS,
         * despite what the PHP documentation suggests: cUrl will turn it into a
         * multipart form post, which is not supported:
         */
        $ch = curl_init( );
        curl_setopt ( $ch, CURLOPT_URL, $url);
        curl_setopt ( $ch, CURLOPT_POST, 1);
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $postBody);

        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 2);

        // Allowing cUrl functions 20 second to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );

        // Waiting 20 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
        $responseString = curl_exec( $ch );
        curl_close( $ch );

        return $responseString;
    }

    /**
     * @param string $url
     * @param array $smsBody
     * @return mixed
     *
     * Send SMS Using API request
     */
    public function sendSms($url, $smsBody)
    {
        $postBody = 'action=send-sms&' . $this->makeSmsBody($smsBody);

        return $this->sendServerResponse($url, $postBody);
    }

    /**
     * @param string $apiKey
     * @param string $url
     * @return mixed
     *
     * Get All message for specific API Access
     */
    public function getInbox($apiKey, $url)
    {
        $postBody = 'action=get-inbox&api_key=' . $apiKey;

        return $this->sendServerResponse($url, $postBody);
    }

    /**
     * @param string $apiKey
     * @param string $url
     * @return mixed
     *
     * Get Balance for specific user
     */
    public function checkBalance($apiKey, $url)
    {
        $postBody = 'action=check-balance&api_key='.$apiKey;

        return $this->sendServerResponse($url, $postBody);
    }
}
