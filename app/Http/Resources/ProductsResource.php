<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ;
class ProductsResource extends JsonResource
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
            "title" => $this->title ,  
            "category_id"  => $this->category_id ,
            "details" => $this->details,
            "price" => $this->price, 
            "file" => $this->file, 
            "price_offer" => $this->price_offer ,
            "offer_value" => $this->offer_value ,
            "offer_type" => $this->offer_type , 
            "status" => $this->status ,
            "file" =>  asset('storage/app/public/posts/'.$this->filejoin->file_name) 
            // "email" => $this->email , 
            // "email_verified_at" => $this->email_verified_at , 
            // "password" => $this->password , 
            // "remember_token" => $this->remember_token , 
            // "created_at" => $this->created_at , 
            // "updated_at" => $this->updated_at ,
            // "pro_image" => asset('storage/app/public/posts/'.$this->pro_image)   , 
            //"file" =>  asset('storage/app/public/posts/'.$this->filejoin)   :  '', 
             
        ];
    }
}
