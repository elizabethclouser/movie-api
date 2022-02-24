<?php

namespace Tests\Unit\Repositories\Movies;

use Tests\TestCase;

use Mockery;
use App\Models\Movie;
use App\Repositories\Movies\MovieDbRepo;
use App\Exceptions\ServiceException;
use App\Enums\MovieError;

class MovieDbRepoTest extends TestCase
{
    private $movieModelMock;
    private int $invalidMovieId;

    public function setUp(): void
    {
        parent::setUp();

        $this->movieModelMock = Mockery::mock(Movie::class);
        $this->app->instance(Movie::class, $this->movieModelMock);
        $this->invalidMovieId = 123123123123;

        $this->movieDbRepo = $this->app->make(MovieDbRepo::class);
    }

    public function test_that_exception_is_thrown_on_failed_deletion(): void
    {
        $this->movieModelMock->shouldReceive('delete')
                            ->once()
                            ->with($this->invalidMovieId);

        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage(MovieError::NOT_DELETED);
            
        $this->movieDbRepo->destroy($this->invalidMovieId);
    }
}
