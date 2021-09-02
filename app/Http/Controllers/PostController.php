<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $posts = auth()->user()->posts;
        return PostResource::collection($posts);

    }

    public function show(Post $post)
    {

       $post = Post::where('id', $post->id)->first();
       
       return new PostResource($post);
       
        // return PostResource::collection($posts);

    }

    public function store(PostStoreRequest $request)
    {

        $input = $request->validated();

        $post = auth()->user()->posts()->create($input);

        return new PostResource($post);
        
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $input = $request->validated();


        $post->fill($input);
        $post->save();

        return new PostResource($post->fresh());        
    }

    public function destroy(Post $post){

        $post->delete();

        return response()->json(['message' => 'Postagem deletada com sucesso']);
    }
}
