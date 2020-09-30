<?php

namespace App\Repositories\Shipping;

use App\Models\Shipping;

class ShippingRepository implements ShippingRepositoryInterface
{
    protected $shipping;

    /**
    * @param object $shipping
    */
    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * Get shipping info by order id
     *
     * @return object
     */
    public function getShippingInfoByOrderId($id): Shipping
    {
        return $this->shipping->where('order_id', '=', $id)->first();
    }
}
