<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\DealerOrderDetailProductResource;

class DealerOrderDetailResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'grand_total'=>$this->grand_total,
            'total_discount'=>$this->total_discount,
            'address'=>$this->address,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'order_status'=>$this->order_status,
            'order_detail'=>DealerOrderDetailProductResource::collection($this->orderDetail),
        ];

        return $data;
    }
}
