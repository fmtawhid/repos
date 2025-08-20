<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;


class CustomException extends Exception
{
    protected $statusCode;
    protected $responseCode;
    protected $responseMessage;
    protected $data;
    protected $errors;
    protected $optional;

    public function __construct(
        $message = "",
        $responseCode = 0,
        $statusCode = 400,
        $data = [],
        $errors = [],
        $optional = null,
        Exception $previous = null
    )
    {
        parent::__construct($message, $responseCode, $previous);
        $this->responseMessage = $message;
        $this->responseCode = $responseCode;
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->errors = $errors;
        $this->optional = $optional;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'status'        => $this->statusCode,
            'response_code' => $this->responseCode,
            'message'       => $this->responseMessage,
            'data'          => $this->data,
            'errors'        => $this->errors,
            'optional'      => $this->optional
        ], $this->responseCode);
    }
}
