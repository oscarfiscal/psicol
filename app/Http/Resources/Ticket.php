<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
           'type'=>'boleto',
           'boleto_id'=>$this->id,
           'attributes'=>[
            'user_id'=>new User($this->user),
            'evento_id'=>new Event($this->event),
             'code'=>$this->code,
             'location'=>$this->location,
             'price'=>$this->price,
           
               
                         ]
       ]
                
                
                ];
    }
}
