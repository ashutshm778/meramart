<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ModifyDealerOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $data = [
            'order_request_id'=>$this->order_request_id,
            'modify_order_request_id'=>$this->modify_order_request_id,
            'product_price'=>$this->product_price,
            'product_discount'=>$this->product_discount,
            'product_discount_amount'=>$this->product_discount_amount,
            'product_quantity'=>$this->product_quantity,
            'created_at'=>$this->created_at->format('d-M-Y'),
            'product'=>[
                'name'=>$this->product->name
            ],
        ];

        return $data;
    }
}
