<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

        $this->renderable(function (HttpException $e, $request) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Resource not found'
                ], 404);
            }
        });

        $this->renderable(function (AuthorizationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'This action is unauthorized'
                ], 403);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation errors',
                    'errors' => $e->errors()
                ], 422);
            }
        });

        // Add this block to handle database exceptions
    $this->renderable(function (QueryException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Database query error',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    // Optional: Handle other specific database-related exceptions if needed
    $this->renderable(function (PDOException $e, $request) {
        if ($request->expectsJson()) {

            return response()->json([
                'status' => false,
                'message' => 'Database error',
                'error' => $e->errorInfo[2],
            ], 500);
        }
    });
    }
}
