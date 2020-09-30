<?php

namespace App\Repositories\OrderDetail;

interface OrderDetailRepositoryInterface
{
    /**
     * Get order detail info by order id
     *
     * @return object
     */
    public function getOrderDetailInfoByOrderId($id);
}
