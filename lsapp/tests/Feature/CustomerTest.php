<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public  function  only_logged_in_user(){

       $response = $this->get('/customers')->assertRedirect('/login');

    }
    /**
     * @test
     */
    public  function  auth_user(){

         $this->actingAs(factory(User::Class)->create());

        $response = $this->get('/new_ticket')->assertOk();


    }


    /**
     * @test
     */
    public function ticket_checker()
    {

    }



}
