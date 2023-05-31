<?php

namespace App\Http\Resources\Api;

use App\Models\DealerOrderRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class DealerOrderRequestResource extends JsonResource
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
            'order_request_id'=>$this->order_request_id,
            'total_amount'=>0,
            'final_amount'=>0,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'order_request_status'=>$this->request_status,
            'dealer'=>[
                'first_name'=>$this->dealer->first_name,
                'last_name'=>$this->dealer->last_name
            ],
        ];

        $order_requests = DealerOrderRequest::where('order_request_id',$this->order_request_id)->get();
        foreach($order_requests as $order_request){
            $data['total_amount'] += $order_request->product_price * $order_request->product_quantity;
            $data['final_amount'] += $order_request->product_discount_amount * $order_request->product_quantity;
        }
        return $data;
    }
}
