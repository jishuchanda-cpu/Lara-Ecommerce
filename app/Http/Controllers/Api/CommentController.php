<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $comments = Comment::with('user', 'post')->paginate(10);
        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request): CommentResource
    {
        $comment = Comment::create($request->validated());
        $comment->load('user', 'post');
        return new CommentResource($comment);
    }

    public function show(Comment $comment): CommentResource
    {
        $comment->load('user', 'post');
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->validated());
        $comment->load('user', 'post');
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
