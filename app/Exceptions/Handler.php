<?php

namespace App\Exceptions;

use App\Http\Traits\LogResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use LogResponse;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Exception $e, $request) {
            $message = app()->isProduction() ? 'Something went wrong. Please try again.' : $e->getMessage();

            if (str_contains($e->getMessage(), 'No query results for model')) {
                return $this->response(__('message.DATA_NOT_FOUND'), customCode: "1", code: Response::HTTP_NOT_FOUND);
            }
            if (method_exists($e, 'getStatusCode')) {
                if ($e->getStatusCode() == Response::HTTP_TOO_MANY_REQUESTS) {
                    $message = $e->getMessage();
                }
            }
            return $this->response($message, customCode: "1", code: Response::HTTP_INTERNAL_SERVER_ERROR, data: [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        });
    }
}
