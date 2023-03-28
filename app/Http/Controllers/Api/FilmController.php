<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmRequest;
use App\Http\Resources\FilmResource;
use App\Services\FilmService;

class FilmController extends Controller
{
    /**
     * Default constructor to load data and view
     * @param FilmService $filmService
     */
    public function __construct(
        protected FilmService $filmService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return FilmResource
     */
    public function index()
    {
        return new FilmResource($this->filmService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FilmRequest $request
     * @return FilmResource
     */
    public function store(FilmRequest $request)
    {
        return new FilmResource($this->filmService->store($request));
    }
}
