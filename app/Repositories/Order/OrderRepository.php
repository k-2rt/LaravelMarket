<?php

namespace App\Repositories\Order;

use App\Models\Order;
use Auth;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    /**
    * @param object $order
    */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get latest orders only 10 by user id
     *
     * @return Object
     */
    public function getOrdersByUserId(): Object
    {
        return $this->order->where('user_id', Auth::id())->orderBy('id', 'DESC')->limit(10)->get();
    }

    /**
     * Get orders that status is 0
     *
     * @return Object
     */
    public function getPendingOrders(): Object
    {
        return $this->order->where('status', '=', '0')->get();
    }

    /**
     * Get orders that status is 1
     *
     * @return Object
     */
    public function getAcceptedOrders(): Object
    {
        return $this->order->where('status', '=', '1')->get();
    }

    /**
     * Get orders that status is 2
     *
     * @return Object
     */
    public function getProcessOrders(): Object
    {
        return $this->order->where('status', '=', '2')->get();
    }

    /**
     * Get orders that status is 3
     *
     * @return Object
     */
    public function getDeliveredOrders(): Object
    {
        return $this->order->where('status', '=', '3')->get();
    }

    /**
     * Get orders that status is 4
     *
     * @return Object
     */
    public function getCancelOrders(): Object
    {
        return $this->order->where('status', '=', '4')->get();
    }

    /**
     * Get a order with user info by order id
     *
     * @param String $id
     * @return Order
     */
    public function getOrderByOrderId($id): Order
    {
        return $this->order->with('user:id,name,phone')
                           ->with('shipping')
                           ->where('id', '=', $id)
                           ->first();
    }

    /**
     * Change status to 1
     *
     * @param String $id
     * @return Bool
     */
    public function changeCompletedPaymentStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '1']);
    }

    /**
     * Change status to 2
     *
     * @param String $id
     * @return Bool
     */
    public function changeProcessStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '2']);
    }

    /**
     * Change status to 3
     *
     * @param String $id
     * @return Bool
     */
    public function changeDeliveryStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '3']);
    }

    /**
     * Change status to 4
     *
     * @param String $id
     * @return Bool
     */
    public function changeCancelStatus($id): Bool
    {
        return $this->order->where('id', '=', $id)->update(['status' => '4']);
    }
}
