<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str ;
use Storage ;
use App\Http\Resources\UserResource;
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
            "id" => $this->id ,
            "user_id" => $this->user_id , 
            "userjoin" =>  new UserResource($this->userjoin) , 
            "post_type" => $this->post_type ,
            "caption" => $this->caption ,
            "short_caption" => Str::of( $this->caption)->limit(100),
            "cat_id" => $this->cat_id ,
            "catjoin" => $this->catjoin ,
            "background_id" => $this->background_id ,
            "font_style" => $this->font_style ,
            "followings" => $this->followings(),
            "font_size" => $this->font_size ,
            "created_at" => $this->created_at ,
            "updated_at" => $this->updated_at ,
            "comment" => $this->comments,
            "like" => $this->likes,
            "liked" => $this->MyLike(),
            "share" => '1.1k',
            "file_path" => env('APP_URL').'storage/app/public/',
            "file" => $this->filejoin ? $this->filejoin->path :'', 
            //"file" => $this->filejoin ?   asset('storage/app/public/posts/'.$this->filejoin->path)   :  '', 
        ];
    }
}
