<?php

namespace App\Services;

use App\Http\Requests\FilmRequest;
use App\Models\Film;

class FilmService
{
    /**
     * Default constructor to load data and view
     * @param Film $film
     */
    public function __construct(
        protected Film $film
    ) {
    }

    /**
     * Get all films
     *
     * @return object
     */
    public function all()
    {
        return $this->film->with('media')->orderBy('release_date', 'desc')->paginate(1);
    }

    /**
     * Store a new resource
     *
     * @param FilmRequest $request
     * @return object
     */
    public function store(FilmRequest $request)
    {
        $data = $request->validated();
        $data['media_id'] = $request->media_id;

        return $this->film->create($data);
    }

    /**
     * Get a single resource
     *
     * @param string $slug
     * @return object
     */
    public function find(string $slug)
    {
        return $this->film->with([
            'media',
            'comments' => fn ($q) => $q->with('user')
        ])->where('slug', $slug)
        ->firstOrFail();
    }
}
