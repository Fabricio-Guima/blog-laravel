<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentStoreRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['indexPublic', 'showPublic']);
    }

    public function index()
    {       
        $posts = auth()->user()->posts()->paginate(9);
        return PostResource::collection($posts);

    }

    public function indexPublic(){

        $allPosts = Post::paginate(9); 
        
        return PostResource::collection($allPosts);
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        //pegar os comments e passar para o resource automaticamente
        $post->load('comments');

       //$post = Post::where('id', $post->id)->first();
       
       return new PostResource($post);       
       
    }

     public function showPublic(Post $post)
    {
        
        //pegar os comments e passar para o resource automaticamente
        $post->load('comments');

       //$post = Post::where('id', $post->id)->first();
       
       return new PostResource($post);       
       
    }

    

    public function store(PostStoreRequest $request)
    {

        $input = $request->validated();

        $post = auth()->user()->posts()->create($input);

        return new PostResource($post);
        
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $this->authorize('update', $post);

        $input = $request->validated();


        $post->fill($input);
        $post->save();

        return new PostResource($post->fresh());        
    }

    public function destroy(Post $post){

        $this->authorize('destroy', $post);

        $post->delete();

        return response()->json(['message' => 'Postagem deletada com sucesso']);
    }

    public function addComment(Post $post,PostCommentStoreRequest $request){

        $input = $request->validated();
        //  auth()->user()->

        // dd(auth()->user()->id);
        // dd($input);

        $input['user_id'] = auth()->user()->id;

        $postComment = $post->comments()->create([ 
            'user_id' => $input['user_id'],           
            'post_id' => $post->id,
            'body' => $input['body'],


        ]);

       return $postComment;

    }
}
