<?php

namespace App\Traits\Api;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponseTrait
{
    /**
     * @throws \JsonException
     */
    public function sendResponse($status, $message ='', $data = [], $errors = [], $optional = []) {
        $statusCode      = appStatic()::RESPONSE_STATUS[$status]['status']          ?: false;
        $responseCode    = appStatic()::RESPONSE_STATUS[$status]['response_code']   ?: 400;
        $responseMessage = !empty($message) ? $message : '';

        $payloads = [
            'status'        => $statusCode,
            'response_code' => $responseCode,
            'message'       => $responseMessage,
            'data'          => $data,
            'errors'        => $errors,
            "optional"      => $optional
        ];

        if(!$statusCode) {
            wLog($responseMessage, $payloads, logService()::LOG_FAILED_RESPONSE);
        }

        return response()->json($payloads, $responseCode);
    }

    /**
     * @throws \JsonException
     */
    public function validationException($validator, $message = null): void
    {
        $appStatic = \appStatic();

        $message = empty($message) ? localize("Validation Errors") : $message;

        throw new HttpResponseException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                $message,
                [],
                $validator->errors()
            )
        );
    }


    public function streamErrorResponse(
        $errorMessage
    ): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return response()->stream(function () use ($errorMessage) {
            $ttError = appStatic()::TT_ERROR;
            $errorMsg = $errorMessage;
            $data = "data: {$ttError} {$errorMsg} Habibi...";
            echo $data;
            echo "\n\n";
            echo PHP_EOL;

            if (ob_get_level() < 1) {
                ob_start();
            }

            ob_flush();
            flush();
            return strlen($data);
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
        ]);
    }
}
