<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
            //
        });
    }

    public function render($request, \Throwable $exception)
    {
        // Handle specific exceptions

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Model not found'], 404);
        } elseif ($exception instanceof QueryException ) {
            \Log::error('Database query failed', ['exception' => $exception]);
            dd($exception);
            return response()->json(['error' => 'Database query failed'], 500);
        } elseif ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Endpoint not found'], 404);
        }

        // Handle other exceptions using the parent render method
        return parent::render($request, $exception);
    }
}
