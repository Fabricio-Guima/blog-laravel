<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\PostCommentUpdateController;
use App\Http\Requests\PostCommentUpdateRequest;
use App\Http\Resources\PostCommentResource;
use App\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('allCommentsByPostPublic');
    }

    public function allCommentsByPost(Post $postComment ){

        // $this->authorize('update', $postComment);       
       
        $comments =  $postComment->comments()->paginate(9);        
        
        return  PostCommentResource::collection($comments);
        
    }

     public function allCommentsByPostPublic(Post $postComment ){

        // $this->authorize('update', $postComment);          
       
       
        $comments =  $postComment->comments()->paginate(9);        
        
        return  PostCommentResource::collection($comments);
        
    }

    public function allCommentsByUser(){
       
        $userComments = auth()->user()->comments()->paginate(9);
        
        return PostCommentResource::collection($userComments);
       
        // $comments =  $postComment->comments()->paginate(9);        
        
        // return  PostCommentResource::collection($comments);
        
    }


    public function show(Comment $postComment) {
       
        return  new PostCommentResource($postComment);
    }

    public function update(Comment $postComment, PostCommentUpdateRequest $request)
    {
        $this->authorize('update', $postComment);

        $input = $request->validated();

        $input['user_id'] = auth()->user()->id;


        $postComment->fill([
            'user_id' => $input['user_id'],
            'body' => $input['body']
        ]);
        $postComment->save();

        return new PostCommentResource($postComment);
        
    }

    public function destroy(Comment $postComment)
    {
        $this->authorize('destroy', $postComment);
        $postComment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
