<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DealerOrderResource extends JsonResource
{

    public function toArray($request){
        //return parent::toArray($request);
        $data = [
            'order_id'=>$this->order_id,
            'grand_total'=>$this->grand_total,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'order_status'=>$this->order_status,
            'dealer'=>[
                'first_name'=>$this->dealer->first_name,
                'last_name'=>$this->dealer->last_name
            ],
        ];

        return $data;
    }
}
