<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetail;

class OrderDetailRepository implements OrderDetailRepositoryInterface
{
    protected $order_detail;

    /**
    * @param object $order
    */
    public function __construct(OrderDetail $order_detail)
    {
        $this->order_detail = $order_detail;
    }

    /**
     * Get order detail info by order id
     *
     * @return object
     */
    public function getOrderDetailInfoByOrderId($id): Object
    {
        return $this->order_detail->with('product:id,product_code,image_one')
                                  ->where('order_id', '=', $id)
                                  ->get();
    }
}
