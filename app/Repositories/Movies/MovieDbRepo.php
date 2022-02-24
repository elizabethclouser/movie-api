<?php

namespace App\Repositories\Movies;

use App\Interfaces\MovieRepoInterface;
use App\Structs\Movie;
use App\Models\Movie as MovieModel;
use App\Exceptions\ServiceException;

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

        if ($movie->count()) {
            return $this->toDto($movie);
        }

        throw new ServiceException('Cannot find movie');
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

        throw new ServiceException('Movie could not be created');
    }

    public function update(int $movieId, array $data): Movie
    {
        $update = $this->movieModel->find($movieId)->update($data);

        if ($update === true) {
            $updated = $this->movieModel->find($movieId);
                                        
            return $this->toDto($updated);
        }

        throw new ServiceException('Movie could not be updated');
    }

    public function destroy(int $movieId): bool
    {
        $deleted = $this->movieModel->delete($movieId);

        if (!$deleted) {
            throw new ServiceException('Movie could not be deleted');
        }

        return true;
    }
}
