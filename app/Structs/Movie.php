<?php

namespace App\Structs;

class Movie
{
    public string $title;
    public string $format;
    public int $lengthMinutes;
    public int $releaseYear;
    public int $rating;

    public function __construct(
        string $title,
        string $format,
        int $lengthMinutes,
        int $releaseYear,
        int $rating
    ) {
        $this->title = $title;
        $this->format = $format;
        $this->lengthMinutes = $lengthMinutes;
        $this->releaseYear = $releaseYear;
        $this->rating = $rating;
    }
}
