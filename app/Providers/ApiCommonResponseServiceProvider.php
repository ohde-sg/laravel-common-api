<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\ApiCustomHandler;
use Response;

class ApiCommonResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExceptionHandler::class, ApiCustomHandler::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // success
        Response::macro('success', function ($data = []) {
            return response()->json(array_merge([
                'success' => true,
            ], $data), 200);
        });

        // error : ValidationError など
        Response::macro('error', function ($msg = '', array $errors = []) {
            return response()->json([
                'success'  => false,
                'msg'      => $msg,
                'errors'   => $errors
            ], 400);
        });

        // not found
        Response::macro('notFound', function () {
            return response()->json([
                'success'  => false,
                'msg'      => '存在しないアクションです。',
            ], 404);
        });

        // fatalError : 致命的なエラー
        Response::macro('fatalError', function () {
            return response()->json([
                'success'  => false,
                'msg' => '予期せぬエラーが発生しました。'
            ], 500);
        });
    }
}
