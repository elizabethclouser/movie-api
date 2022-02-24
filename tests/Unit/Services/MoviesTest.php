<?php

namespace Tests\Unit\Services;

use Tests\TestCase;

use App\Services\Movies;
use App\Interfaces\MovieRepoInterface;
use Mockery;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Movies\MovieDbRepo;

class MovieControllerTest extends TestCase
{
    private $movieRepoMock;
    private Movies $moviesService;
    private Collection $moviesStub;
    private int $invalidMovieId;

    private const COUNT = 25;

    public function setUp(): void
    {
        parent::setUp();

        $this->movieRepoMock = Mockery::mock('\App\Repositories\Movies\MovieDbRepo', '\App\Interfaces\MovieRepoInterface');
        $this->app->instance(MovieRepoInterface::class, $this->movieRepoMock);
        $this->moviesService = $this->app->make(Movies::class);
        $this->moviesStub = Movie::factory()->count(self::COUNT)->make();
        $this->invalidMovieId = 98987676;
    }

    public function test_that_movies_get_method_returns_data(): void
    {
        $this->movieRepoMock->shouldReceive('get')
                            ->once()
                            ->with()
                            ->andReturn($this->moviesStub->toArray());

        $movies = $this->moviesService->get();

        $this->assertEquals(count($movies), self::COUNT);
    }
}
