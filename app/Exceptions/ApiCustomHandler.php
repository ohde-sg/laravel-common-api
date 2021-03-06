<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Exception;

class ApiCustomHandler extends Handler
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        if( request()->is('api/*') ) {
            $this->renderable(function (ValidationException $e, $request) {
                return response()->error('入力値にエラーがあります', $e->errors());
            });

            $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
                return response()->notFound();
            });

            $this->renderable(function (NotFoundHttpException $e, $request) {
                return response()->notFound();
            });

            $this->renderable(function (Exception $e, $request) {
                return response()->fatalError();
            });
        }
    }

}
