<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     public function view(User $user, Comment $postComment){
        
        return $user->id === $postComment->user_id;

    }

    public function update(User $user, Comment $postComment){
        
        return $user->id === $postComment->user_id;

    }

    public function destroy(User $user, Comment $postComment){
        
        return $user->id === $postComment->user_id;

    }

    public function addPost(User $user, Comment $postComment){
        
        return $user->id === $postComment->user_id;

    }
}
