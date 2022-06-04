<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ;

class ConversationsResource extends JsonResource
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
            "sender_id" => $this->sender_id , 
            "receiver_id"=> $this->receiver_id,
            "receiver" => new UserResource($this->userjoin($this->receiver_id)) , 
            "sender" => new UserResource($this->userjoin($this->sender_id)) ,
            "message"=> $this->message, 
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
            
        ];
    }
}
