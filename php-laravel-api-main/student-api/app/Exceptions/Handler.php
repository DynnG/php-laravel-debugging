<?php

namespace App\Exceptions;

use Exception;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Handle database connection or query errors
        if ($e instanceof QueryException) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage(),
            ], 500);
        }

        // Handle generic HTTP exceptions
        if ($e instanceof HttpException) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }

        // Fallback: for all other exceptions
        return response()->json([
            'error' => 'Server Error',
            'message' => $e->getMessage(),
        ], 500);
    }
}
