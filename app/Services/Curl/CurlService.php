<?php

namespace App\Services\Curl;

use Illuminate\Support\Facades\Log;

class CurlService
{
    /**
     * @incomingParams $responseType contains integer value as response format type
     * $responseType == 1 means Return only Body Response
     * $responseType == 2 means Return only response code
     * $responseType == 3 means Return only response Header
     * $responseType == 4 means Return Response Code + Body
     * $responseType == 5 means Return Response Code + Body + Headers
     * */
    public function handle(
        $url,
        $data = [],
        $responseType = 1,
        $method = 'GET',
        $authorization = null,
        $options = [],
        $header = ['Content-Type: application/json'],
        $encodeData = true,
       
    )
    {
        $appStatic = appStatic();

        $method = !$method ? "GET" : $method;
        if(!empty($authorization) && is_array($authorization)) {
            $header= array_merge($header, $authorization);
        }
        $curl = curl_init();
        // Set the CURL options
        if (empty($options)) {
            $options = [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => $method,
                CURLOPT_HTTPHEADER     => $header,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_CONNECTTIMEOUT => 0,
            ];
        }

        if(!empty($authorization) && !is_array($authorization)){
            $options[CURLOPT_USERPWD] = $authorization;
        }

        // When it's POST Request
        if ($method == 'POST') {
            $options[CURLOPT_POSTFIELDS] = $encodeData ? json_encode($data) : $data;
        }

        info("Curl Options: ". json_encode($options, JSON_THROW_ON_ERROR));

        curl_setopt_array($curl, $options);

        // Execute the request
        $response = curl_exec($curl);

        // Get the response code
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Separate the headers and body
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers    = substr($response, 0, $headerSize);
        $body       = substr($response, $headerSize);

        // CURL Error Log Set
        if (curl_errno($curl) > 0) {
            throw new \RuntimeException(localize("Failed to make successful communication. ") . curl_error($curl), $appStatic::INTERNAL_ERROR);
        }

        // Close CURL resource
        curl_close($curl);

        switch ($responseType){
            case $appStatic::CURL_RESPONSE_BODY:
                return ['body'    => json_decode($response) ?? []];
            case $appStatic::CURL_RESPONSE_CODE:
                return ['code'    => $httpCode];
            case $appStatic::CURL_RESPONSE_HEADER:
                return ['headers' => $headers];
            case $appStatic::CURL_RESPONSE_CODE_WITH_BODY:
                return [
                    'code'    => $httpCode,
                    'body'    => json_decode($response) ?? []
                ];
            case $appStatic::CURL_RESPONSE_CODE_WITH_BODY_AND_HEADERS:
                return [
                    'code'    => $httpCode,
                    'body'    => json_decode($response) ?? [],
                    'headers' => $headers,
                ];
            default:
                return [
                    'code'    => $httpCode,
                    'body'    => $response
                ];
        } // Close Switch

    } // Close Curl Method

    public function wpCurlResponseDecode($responseJson)
    {
        $status = true;

        if (isset($responseJson->code) && $responseJson->data->status == 404){
            $status = false;
        }

        return $status;
    }

}
