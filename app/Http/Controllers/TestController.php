<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function success()
    {
        return response()->success([
            'data' => 'wow'
        ]);
    }

    public function error()
    {
        return response()->error(
            'you have some errors',
            [
                'error1' => 'you have error1',
                'error2' => 'you have error2',
                'error3' => 'you have error3',
            ]
        );
    }

    public function error_validation(TestRequest $request)
    {
        //Nothing to do
    }

    public function error_fatal()
    {
        throw new \Exception();
    }
}
