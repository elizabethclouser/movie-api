<?php

namespace App\Services;

use App\Structs\Movie;
use App\Interfaces\MovieRepoInterface;
use App\Exceptions\ServiceException;
use App\Repositories\Movies\MovieDbRepo;

class Movies
{
    private MovieRepoInterface $movieRepo;

    public function __construct(MovieDbRepo $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    /**
     * @return array<Movie>
     */
    public function get(): array 
    {
        return $this->movieRepo->get();
    }

    public function show(int $movieId): Movie
    {
        return $this->movieRepo->show($movieId);
    }

    public function create(array $data): Movie
    {
        return $this->movieRepo->create($data);
    }

    public function update(int $movieId, array $data): Movie
    {
        return $this->movieRepo->update($movieId, $data);
    }

    public function destroy(int $movieId): bool
    {
        return $this->movieRepo->destroy($movieId);
    }
}
