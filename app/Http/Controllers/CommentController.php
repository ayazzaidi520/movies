<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    /**
     * Default constructor to load data and view
     * @param CommentService $commentService
     */
    public function __construct(
        protected CommentService $commentService
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return object
     */
    public function store(CommentRequest $request)
    {
        return $this->commentService->store($request);
    }
}
