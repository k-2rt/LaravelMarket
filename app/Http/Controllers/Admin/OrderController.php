<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;
use App\Repositories\Shipping\ShippingRepositoryInterface as ShipRepo;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface as OrderDetailRepo;

class OrderController extends Controller
{
    protected $order_repo;
    protected $ship_repo;
    protected $order_detail_repo;

    public function __construct(OrderRepo $order_repo, ShipRepo $ship_repo, OrderDetailRepo $order_detail_repo)
    {
        $this->middleware('auth:admin');
        $this->order_repo = $order_repo;
        $this->ship_repo = $ship_repo;
        $this->order_detail_repo = $order_detail_repo;
    }

    /**
     * Show pending order list
     *
     * @return void
     */
    public function showPendingOrderLists()
    {
        $orders = $this->order_repo->getPendingOrders();

        return view('admin.order.order_lists', compact('orders'));
    }

    /**
     * Show accepted order list
     *
     * @return void
     */
    public function showAcceptedOrderLists()
    {
        $orders = $this->order_repo->getAcceptedOrders();

        return view('admin.order.order_lists', compact('orders'));
    }

    /**
     * Show cancel order list
     *
     * @return void
     */
    public function showCancelOrderLists()
    {
        $orders = $this->order_repo->getCancelOrders();

        return view('admin.order.order_lists', compact('orders'));
    }

    /**
     * Show process order list
     *
     * @return void
     */
    public function showProcessOrderLists()
    {
        $orders = $this->order_repo->getProcessOrders();

        return view('admin.order.order_lists', compact('orders'));
    }

    /**
     * Show delivered order list
     *
     * @return void
     */
    public function showDeliveredOrderLists()
    {
        $orders = $this->order_repo->getDeliveredOrders();

        return view('admin.order.order_lists', compact('orders'));
    }

    /**
     * Show order details
     *
     * @return void
     */
    public function showOrderDetails($id)
    {
        $order = $this->order_repo->getOrderByOrderId($id);
        $shipping = $this->ship_repo->getShippingInfoByOrderId($id);
        $order_details = $this->order_detail_repo->getOrderDetailInfoByOrderId($id);

        return view('admin.order.order_details', compact('order', 'shipping', 'order_details'));
    }

    /**
     * Change status to 1
     *
     * @param String $id
     * @return void
     */
    public function acceptPayment($id)
    {
        $this->order_repo->changeCompletedPaymentStatus($id);

        $notification = array(
            'message' => '支払いを承認しました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.accepted.payment')->with($notification);
    }

    /**
     * Change status to 2
     *
     * @param String $id
     * @return void
     */
    public function updateProcessOrder($id)
    {
        $this->order_repo->changeProcessStatus($id);

        $notification = array(
            'message' => '発送しました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.process.order')->with($notification);
    }

    /**
     * Change status to 3
     *
     * @param String $id
     * @return Array
     */
    public function updateDeliveryOrder($id)
    {
        $this->order_repo->changeDeliveryStatus($id);

        $notification = array(
            'message' => '配達済みにしました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);
    }

    /**
     * Change status to 4
     *
     * @param String $id
     * @return void
     */
    public function cancelPayment($id)
    {
        $this->order_repo->changeCancelStatus($id);

        $notification = array(
            'message' => '注文をキャンセルしました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.cancel.order')->with($notification);
    }
}
