<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        //
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

        // fatalError : 致命的なエラー
        Response::macro('fatalError', function () {
            return response()->json([
                'success'  => false,
                'msg' => '予期せぬエラーが発生しました。'
            ], 500);
        });
    }
}
