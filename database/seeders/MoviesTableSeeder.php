<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\MovieFormat;

class MoviesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movies')->insert(
            [
                'title'          => Str::random(10),
                'format'         => array_rand(
                    [
                        MovieFormat::VHS,
                        MovieFormat::DVD,
                        MovieFormat::STREAMING,
                    ],
                    1,
                ),
                'length_minutes' => rand(60, 180),
                'release_year'   => rand(1983, 2022),
                'rating'         => rand(1, 5),
            ]
        );
    }
}
