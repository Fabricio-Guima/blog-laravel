<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' =>(integer)$this->id,
            'title' =>(string)$this->title,
            'body' =>(string)$this->body,
            'created_at' =>(string)$this->created_at,
        ];
    }
}
