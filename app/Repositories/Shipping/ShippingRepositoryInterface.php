<?php

namespace App\Repositories\Shipping;

interface ShippingRepositoryInterface
{
    /**
     * Get shipping info by order id
     *
     * @return object
     */
    public function getShippingInfoByOrderId($id);
}
