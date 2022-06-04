<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventResource extends ResourceCollection
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
           // "id" => $this->id ,
            "title" => $this->title ,
            "details" => $this->details ,
            "event_date" => $this->event_date ,
            "event_time" => $this->event_time ,
            "location" => $this->location ,
            "created_at" => $this->created_at 
        ];
    }
}
