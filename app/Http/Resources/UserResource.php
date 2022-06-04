<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ;
class UserResource extends JsonResource
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
            "description" => $this->description , 
            "email" => $this->email , 
            "email_verified_at" => $this->email_verified_at , 
            "password" => $this->password , 
            "remember_token" => $this->remember_token , 
            "created_at" => $this->created_at , 
            "updated_at" => $this->updated_at ,
           // "pro_image" => asset('storage/app/public/posts/'.$this->pro_image)   ,
            "pro_image" => env('APP_URL').'storage/app/public/posts/'.$this->pro_image  , 
            //"file" =>  asset('storage/app/public/posts/'.$this->filejoin)   :  '', 
             
        ];
    }
}
