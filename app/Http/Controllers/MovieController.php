<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Movies;
use App\Structs\Movie;
use App\Exceptions\ServiceException;

class MovieController extends Controller
{
    protected const RULES = [
        'title'          => 'required|string|max:50',
        'format'         => 'required|string|in:VHS,DVD,Streaming',
        'length_minutes' => 'required|numeric|between:0,500',
        'release_year'   => 'required|numeric|between:1800,2100',
        'rating'         => 'required|numeric|between:1,5',
    ];

    private Movies $movies;

    public function __construct(Movies $movies) 
    {
        $this->movies = $movies;
    }

    public function get()
    {
        try {
            $movies = $this->movies->get();

            return $this->success($movies);
        } catch (ServiceException $e) {
            return $this->error($e->getMessage());
        }
    }

    public function show(int $movieId)
    {
        try {
            $id = $this->movies->show($movieId);

            return $this->success($id);
        } catch (ServiceException $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, self::RULES);

        try {
            $created = $this->movies->create($request->all());

            return $this->success($created);
        } catch (ServiceException $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(int $movieId, Request $request) 
    {
        $this->validate($request, self::RULES);

        try {
            $updated = $this->movies->update($movieId, $request->all());

            return $this->success($updated);
        } catch (ServiceException $e) {
            return $this->error($e->getMessage());
        }
    }

    public function destroy(int $movieId)
    {
        try {
            $this->movies->destroy($movieId);

            return $this->success();
        } catch (ServiceException $e) {
            return $this->error($e->getMessage());
        }
    }
}
