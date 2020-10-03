<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccess()
    {
        $response = $this->get('/api/test/success');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'data' => 'wow',
            ]);
    }

    public function testError()
    {
        $response = $this->get('/api/test/error');

        $response
            ->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'msg' => 'you have some errors',
                'errors' => [
                    'error1' => 'you have error1',
                    'error2' => 'you have error2',
                    'error3' => 'you have error3',
                ]
            ]);
    }

    public function testErrorValidation()
    {
        $response = $this->post('/api/test/error_validation', ['id' => 123, 'name' => 'abcdefg']);
        $response
            ->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'msg' => '入力値にエラーがあります',
                'errors' => [
                    'name' => ['The name must be at least 8 characters.'],
                ]
            ]);
    }

    public function testErrorValidation2()
    {
        $response = $this->post('/api/test/error_validation', ['id' => 123, 'name' => 'abcdefghijabcdefghijx']);
        $response
            ->assertStatus(400)
            ->assertExactJson([
                'success' => false,
                'msg' => '入力値にエラーがあります',
                'errors' => [
                    'name' => ['The name may not be greater than 20 characters.']
                ]
            ]);
    }

    public function testErrorFatal()
    {
        $response = $this->get('/api/test/error_fatal');
        $response
            ->assertStatus(500)
            ->assertExactJson([
                'success'  => false,
                'msg' => '予期せぬエラーが発生しました。'
            ]);
    }
}
