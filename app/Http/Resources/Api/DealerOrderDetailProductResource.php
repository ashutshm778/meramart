<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DealerOrderDetailProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $data = [
            'product_id'=>$this->product_id,
            'product_price'=>$this->product_price,
            'discount_price'=>$this->discount_price,
            'final_price'=>$this->final_price,
            'quantity'=>$this->quantity,
            'product_order_status'=>$this->product_order_status,
            'product'=>[
                'name'=>$this->product->name,
                'thumbnail_image'=>asset('public/'.api_asset($this->product->thumbnail_image)),
            ],

        ];

        return $data;
    }
}
