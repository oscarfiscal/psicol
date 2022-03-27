<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Buyer extends JsonResource
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
           'type'=>'comprador',
           'comprador_id'=>$this->id,
           'attributes'=>[
                'email'=>$this->email,
                'name'=>$this->name,
                'last_name'=>$this->last_name,
                'identification'=>$this->identification,
                'phone'=>$this->phone,
                         ]
       ]
               
               
               ];
    }
}
