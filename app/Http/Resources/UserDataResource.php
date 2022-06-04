<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;
class UserDataResource extends JsonResource
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
            "name" => $this->name , 
            "description" =>  $this->description , 
            "email" => $this->email , 
            "email_verified_at" => $this->email_verified_at , 
            "password" => $this->password , 
            "remember_token" => $this->remember_token ,
            "total_post" =>  $this->totalPost(),
            "total_followers" =>  $this->totalFollowers(),
            "total_potos" =>  $this->totalPhotos(),
            "photos" => PostResource::collection($this->Photos()),
            "total_videos" => $this->totalVideo(),
            "videos" =>  PostResource::collection($this->videos()),
            "pro_image" => asset('storage/app/public/posts/'.$this->pro_image),
            "created_at" => $this->created_at , 
            "updated_at" => $this->updated_at 
             
        ];
    }
}
