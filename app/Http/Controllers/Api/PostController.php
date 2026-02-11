<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $posts = Post::with('user', 'comments')->paginate(10);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request): PostResource
    {
        $post = Post::create($request->validated());
        $post->load('user', 'comments');
        return new PostResource($post);
    }

    public function show(Post $post): PostResource
    {
        $post->load('user', 'comments');
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());
        $post->load('user', 'comments');
        return new PostResource($post);
    }

    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
