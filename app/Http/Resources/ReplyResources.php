<?php

namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ; 
use App\Http\Resources\UserResource;
class ReplyResources extends JsonResource
{
 
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        return [
            'id' => $this->id , 
            'post_id' => $this->post_id , 
            'user_id' => $this->user_id , 
            'parent_id' => $this->parent_id , 
            'comm_test' => $this->comm_test , 
            'created_at' => $this->created_at , 
            "userjoin" => new UserResource($this->userjoin) , 
            'reply' => ReplyResources::collection($this->reply()), 
            "liked" => $this->commentLike(),
            'updated_at' => $this->updated_at
        ];
    }
}
