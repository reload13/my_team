<?php

// app/Exceptions/CustomExceptionHandler.php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, \Throwable $exception)
    {
        // Handle specific exceptions
        dd("asd");
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Model not found'], 404);
        } elseif ($exception instanceof QueryException) {
            return response()->json(['error' => 'Database query failed'], 500);
        } elseif ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Endpoint not found'], 404);
        }

        // Handle other exceptions using the parent render method
        return parent::render($request, $exception);
    }
}
