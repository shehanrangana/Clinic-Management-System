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
        // create an admin
        $user = factory('App\User')->create(['user_role' => 0]);

        // log admin
        $this->be($user);

        // register new user
        $user2 = factory('App\User')->create(['user_role' => 1, 'email' => 'test@demo.com']);

        // get response
        $response = $this->json('GET',  '/admin/user_register/checkEmail',['email'=>$user2->email])->assertSee(1);
    }
}
