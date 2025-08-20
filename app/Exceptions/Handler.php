<?php

namespace App\Exceptions;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $request = request();
            if ($request->isXmlHttpRequest() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => [
                        "title"         => $e->getMessage(),
                        "file"          => $e->getFile(),
                        "line"          => $e->getLine(),
                    ]
                ], 500);
            }

            return $this->handleException($e, $request);
        });
    }


    /**
     * @throws \JsonException
     */
    private function handleException(Throwable $e, $request)
    {
        if ($request->isXmlHttpRequest() || $request->wantsJson()) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => [
                    "title"         => $e->getMessage(),
                    "file"          => $e->getFile(),
                    "line"          => $e->getLine(),
                ]
            ], 500);
        }

        // Handle ModelNotFoundException with a custom JSON response
        if ($e instanceof ModelNotFoundException) {
            return $this->sendResponse(appStatic()::NOT_FOUND, "Model Not Found Exception");
        }

        // Handle Validation Exception
        if ($e instanceof ValidationException) {
            return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY,$e->getMessage(), $e->errors());
        }

        // Handle Authentication Exception
        if ($e instanceof AuthenticationException) {
            return $this->sendResponse(appStatic()::UNAUTHORIZED_ACTION, appStatic()::MESSAGE_UNAUTHORISED);
        }

        // Generic Internal Error Response
        return $this->sendResponse(appStatic()::INTERNAL_ERROR, $e->getMessage(),[], errorArray($e));
    }
}
