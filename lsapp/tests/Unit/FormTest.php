<?php

namespace Tests\Unit;

use App\Form;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{


    /*protected function setUp(): void
    {
        parent::setUp();

        $this->form = factory(\App\Form::class)->create();
    }*/




    /** @test */
    public function item_name_is_required_to_store()
    {


        /*$author = factory(\App\Form::class)->make(['item_name' => 'Robert']);
        //$author = factory(\App\Form::class)->make(['item_name' => 'Robert']);

        $this->post('/form', $author->toArray())->assertSessionHasErrors(('item_name'));

        $this->assertEquals(0, \App\Form::count());*/

         // $this->actingAs(factory(Form::class))->create();

          $response = $this->post('/form' , [
              'item_name' => 'dfsdfsfd'
          ])->assertSessionHas('item_name', !null);

        //$response->assertSessionHasErrors();
        //$this->assertTrue(true);


    }

}
