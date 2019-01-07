<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QueueAddingTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_add_queue1()
    {
        // create a receptionist
        // $user = factory('App\User')->create(['user_role' => 1]);

        // // log receptionist
        // $this->be($user);

        // // create appointment
        // $user = factory('App\Appointment')->create();

        // // get response
        // $number = factory('App\Queue1')->create(['user_role' => 1, 'email' => 'test@demo.com']);
    } 
}
