<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    /**
     * Get all orders
     *
     * @return Object
     */
    public function getAll();

    /**
     * Get orders of this month
     *
     * @return Object
     */
    public function getThisMonth();

    /**
     * Get latest current user orders only 10
     *
     * @return Object
     */
    public function getCurrentUserOrders();

    /**
     * Find an order with coupon by order id
     *
     * @return Object
     */
    public function findOrderWithCoupon($id);

    /**
     * Get orders that status is 0
     *
     * @return Object
     */
    public function getPendingOrders();

    /**
     * Get orders that status is 1
     *
     * @return Object
     */
    public function getAcceptedOrders();

    /**
     * Get orders that status is 2
     *
     * @return Object
     */
    public function getProcessOrders();

    /**
     * Get orders that status is 3
     *
     * @return Object
     */
    public function getDeliveredOrders();

    /**
     * Get orders that status is 4
     *
     * @return Object
     */
    public function getCancelOrders();

    /**
     * Get orders that status is 1
     *
     * @return Object
     */
    public function getOrderByOrderId($id);

    /**
     * Get today's pendding orders
     *
     * @return Object
     */
    public function getTodaysOrders();

    /**
     * Get today's delivered orders
     *
     * @return Object
     */
    public function getTodaysDeliveredOrders();

    /**
     * Get delivered orders of this month
     *
     * @return Object
     */
    public function getDeliveredOrdersOfThisMonth();

    /**
     * Search orders
     *
     * @param Request $request
     * @return Object
     */
    public function searchOrders($request);

    /**
     * Change status to 1
     *
     * @param String $id
     * @return Bool
     */
    public function changeCompletedPaymentStatus($id);

    /**
     * Change status to 2
     *
     * @param String $id
     * @return Bool
     */
    public function changeProcessStatus($id);

    /**
     * Change status to 3
     *
     * @param String $id
     * @return Bool
     */
    public function changeDeliveryStatus($id);

    /**
     * Change status to 4
     *
     * @param String $id
     * @return Bool
     */
    public function changeCancelStatus($id);
}
