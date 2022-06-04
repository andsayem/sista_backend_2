<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ;

class CommentResource extends JsonResource
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
            "id" => $this->id , 
            "post_id"=> $this->post_id,
            "user_id"=> $this->user_id,
            "parent_id"=> $this->parent_id,
            "comm_test"=> $this->comm_test,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "deleted_at"=> $this->deleted_at,
            "childs"=> $this->attributesToArray($this->childs),
            
        ];
    }
}
