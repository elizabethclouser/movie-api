<?php

namespace App\Repositories\Movies;

use App\Interfaces\MovieRepoInterface;
use App\Structs\Movie;
use App\Models\Movie as MovieModel;
use App\Exceptions\ServiceException;
use App\Enums\MovieError;

class MovieDbRepo implements MovieRepoInterface
{
    private MovieModel $movieModel;

    public function __construct(MovieModel $movieModel)
    {
        $this->movieModel = $movieModel;
    }

    public function get(): array
    {
        return $this->movieModel->get()->map(
            function (MovieModel $movie): Movie {
                return $this->toDto($movie);
            }
        )->toArray();
    }

    public function show(int $movieId): Movie
    {
        $movie = $this->movieModel->find($movieId);

        if ($movie) {
            return $this->toDto($movie);
        }

        throw new ServiceException(MovieError::NOT_FOUND);
    }

    private function toDto(MovieModel $movie) {
        return new Movie(
            $movie->title,
            $movie->format,
            $movie->length_minutes,
            $movie->release_year,
            $movie->rating
        );
    }

    public function create(array $data): Movie
    {
        $movie = $this->movieModel->create($data);

        if ($movie) {
            return $this->toDto($movie);
        }

        throw new ServiceException(MovieError::NOT_CREATED);
    }

    public function update(int $movieId, array $data): Movie
    {
        $movie = $this->movieModel->find($movieId);
                                   
        if (!$movie) {
            throw new ServiceException(MovieError::NOT_FOUND);
        }

        $updated = $movie->update($data);
        if ($updated) {
            $updated = $this->movieModel->find($movieId);
                                        
            return $this->toDto($updated);
        }

        throw new ServiceException(MovieError::NOT_UPDATED);
    }

    public function destroy(int $movieId): bool
    {
        $movie = $this->movieModel->find($movieId);

        if (!$movie) {
            throw new ServiceException(MovieError::NOT_FOUND);
        }

        $deleted = $movie->delete();
        if (!$deleted) {
            throw new ServiceException(MovieError::NOT_DELETED);
        }

        return true;
    }
}
