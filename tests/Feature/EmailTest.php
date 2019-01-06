<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_email_already_exists()
    {
        $user = factory('App\User')->create(['user_role' => 0]);

        $this->be($user);

        $user2 = factory('App\User')->create(['user_role' => 1, 'email' => 'test@demo.com']);

        $response = $this->json('GET',  '/admin/user_register/checkEmail',['email'=>$user2->email])->assertSee(1);
    }
}
