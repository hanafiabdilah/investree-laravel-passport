<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $headers = [
            'Accept' => 'application/json'
        ];

        $user = [
            'name' => 'tes',
            'email' => 'tes@mail.com',
            'password' => Hash::make('123'),
        ];

        $loginUser = [
            'email' => 'mail@mail.com',
            'password' => '123456',
        ];

        $wrongLoginUser = [
            'email' => 'wrong@mail.com',
            'password' => '123',
        ];

        // Register dengan data kosong atau data tidak terpenuhi
        $this->post(route('register'), [], $headers)->assertStatus(422)->assertJson([
            "message" => "The given data was invalid.",
        ]);

        // Register dengan data yang benar
        $this->post(route('register'), $user, $headers)->assertStatus(201)->assertJson([
            'message' => 'user created',
            'status' => 'success',
        ]);

        // Register dengan email yang sudah ada
        $this->post(route('register'), $user, $headers)->assertStatus(409)->assertJson([
            'message' => 'email already exists',
            'status' => 'fail',
        ]);

        // Login dengan user yang benar
        $this->post(route('login'), $loginUser, $headers)->assertStatus(200)->assertJson([
            'message' => 'login successfully',
            'status' => 'success',
        ]);

        // Login dengan email atau passworda yang salah
        $this->post(route('login'), $wrongLoginUser, $headers)->assertStatus(403)->assertJson([
            'message' => 'wrong email or password',
            'status' => 'fail',
        ]);
    }
}
