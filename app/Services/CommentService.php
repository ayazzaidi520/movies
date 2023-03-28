<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentService
{
    /**
     * Default constructor to load data and view
     * @param Comment $comment
     */
    public function __construct(
        protected Comment $comment
    ) {
    }

    /**
     * Store a new resource
     *
     * @param CommentRequest $request
     * @return object
     */
    public function store(CommentRequest $request)
    {
        return $this->comment->create($request->validated());
    }
}
