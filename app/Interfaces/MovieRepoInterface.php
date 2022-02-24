<?php

namespace App\Interfaces;

use App\Structs\Movie;

interface MovieRepoInterface
{
    public function get(): array;
    public function show(int $movieId): Movie;
    public function create(array $data): Movie;
    public function update(int $movieId, array $data): Movie;
    public function destroy(int $movieId): bool;
}
