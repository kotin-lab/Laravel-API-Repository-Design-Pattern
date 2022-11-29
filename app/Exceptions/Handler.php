<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     */
    public function render($request, Throwable $e)
    {
        // If request accept json
        if ($request->expectsJson()) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'statusCode' => 404,
                    'results' => null,
                    'message' => $e->getMessage(),
                ], 404);
            }
        }

        return parent::render($request, $e);
    }
 
    /**
     * 
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? jsonResponse(null, 401, $exception->getMessage())
            : redirect()->guest(route('login'));
    }
}
