<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [  
             
            'data'=>[
           'type'=>'evento',
           'evento_id'=>$this->id,
           'attributes'=>[
                'place'=>$this->place,
                'city'=>$this->city,
                'date'=>$this->date,
                'category'=>$this->category,
               
                         ]
       ]
                
                
                ];
    }
}
