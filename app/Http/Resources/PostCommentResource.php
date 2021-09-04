<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (integer)$this->id,
            'user_id' =>  (integer)$this->user_id,
            'post_id' =>  (integer)$this->post_id,
            'body' =>  (string)$this->body,
            'created_at' =>  (string)$this->created_at,
        ];

    }
}
