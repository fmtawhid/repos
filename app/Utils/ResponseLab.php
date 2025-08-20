<?php

namespace App\Utils;

class ResponseLab
{

    /**
     * @incomingParams $response contains CURL Response Body
     *
     * Final response true means integrated with Basic Auth either Failed.
     *
     * @return boolean true or false
     * */
    public function isWpIntegrated(object | array | null $response)
    {
        if (is_null($response)){
            return false;
        }

        if(is_array($response)){

            return $response["name"] ? true : false;
        }
        return (bool)$response->username;
    }

    public function isSuccessfulPost(object $response)
    {
        return $response->id ? true : false;
    }

    public function wpErrorBag(object $errorResponseBag)
    {

        // Flatten the nested array
        $flattenedErrorData = $this->flattenArray($errorResponseBag);

// Create an error message bag array
        $errorMessageBag = [];
        foreach ($flattenedErrorData as $key => $value) {
            $errorMessageBag[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return $errorMessageBag;
    }

    public function flattenArray($array, $prefix = '') {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenArray($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}
