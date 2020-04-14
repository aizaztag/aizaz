<?php

namespace Tests\Feature\App\Http\Requests;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaveProductRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function request_should_fail_when_no_title_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('products.store'), [
                'price' => $this->faker->numberBetween(7, 12)
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('price');
    }

    /** @test */
    public function request_should_fail_when_no_price_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('products.store'), [
                'title' => $this->faker->word()
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('price');
    }

    /** @test */
    public function request_should_fail_when_title_has_more_than_50_characters()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('products.store'), [
                'title' => $this->faker->paragraph()
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('price');
    }

    /** @test */
    public function request_should_pass_when_data_is_provided()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('products.store'), [
                'title' => $this->faker->word(),
                'price' => $this->faker->numberBetween(1, 50)
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonMissingValidationErrors([
            'title',
            'price'
        ]);
    }
}