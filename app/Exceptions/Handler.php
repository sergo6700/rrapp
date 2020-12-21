<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 *
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * @var string
     */
    public const SOMETHING_WENT_WRONG = 'Что-то пошло не так';

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }

        // хак для всех форм регистрации
        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            $redirect = null;
            switch ($statusCode)
            {
            case '404':
                return $redirect = response()->view('web.pages.404.index', array(), 404);
            break;
            }
        }

        // for production we display page 404 with the message
        if (!config('app.debug')) {
            return response()->view('web.pages.404.index', array('message' => self::SOMETHING_WENT_WRONG), 404);
        }

        return parent::render($request, $exception);
    }
}
