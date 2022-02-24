<?php

namespace Tests\Integration\Controllers;

use Tests\TestCase;

use Illuminate\Auth\GenericUser;
use App\Models\Movie;
use Illuminate\Http\Response;

class MovieControllerTest extends TestCase
{
    private GenericUser $user;

    private const COUNT = 25;

    public function setUp(): void
    {
        parent::setUp();

        Movie::factory()->count(self::COUNT)->create();

        $this->user = new GenericUser(['id' => 1, 'name' => 'API Client']);
    }

    public function test_that_movies_get_index_returns_successful_response(): void
    {
        $response = $this->actingAs($this->user)->get('/movies');

        $data = $response->response->original['data'];
        $this->assertCount(self::COUNT, $data);
    }

    public function test_that_unauthorized_requests_are_rejected(): void
    {
        $response = $this->get('/movies');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->response->getStatusCode());
    }
}
