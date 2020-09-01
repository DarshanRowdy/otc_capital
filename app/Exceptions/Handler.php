<?php

namespace App\Exceptions;

use Exception;
use Psy\Util\Json;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof NotFoundHttpException){
            $this->_errorMessage(404,'Page Not Found');
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $this->_errorMessage(405,'Method is not allowed for the requested route');
        }

        return parent::render($request, $exception);
    }

    public function _errorMessage($responseCode = 400, $message = 'Bad Request'){
        $body = Json::encode(
            array(
                "success" => false,
                "responseCode" => $responseCode,
                'message' => $message
            )
        );
        echo $body;
        die;
    }
}
