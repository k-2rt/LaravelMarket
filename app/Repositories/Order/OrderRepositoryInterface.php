<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    /**
     * Get latest orders only 10 by user id
     *
     * @return Object
     */
    public function getOrdersByUserId();

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
