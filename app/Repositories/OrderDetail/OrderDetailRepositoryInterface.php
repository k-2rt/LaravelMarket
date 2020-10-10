<?php

namespace App\Repositories\OrderDetail;

interface OrderDetailRepositoryInterface
{
    /**
     * Get order details by order id
     *
     * @return Object
     */
    public function getOrderDetailsByOrderId($id);

    /**
     * Get order details with product_code & product name by order id
     *
     * @return Object
     */
    public function getOrderDetailInfoByOrderId($id);
}
