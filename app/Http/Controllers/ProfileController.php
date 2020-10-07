<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;

class ProfileController extends Controller
{
    protected $order_repo;

    public function __construct(OrderRepo $order_repo)
    {
        $this->middleware('auth');
        $this->order_repo = $order_repo;
    }

    public function showOrderHistoryLists()
    {
        $orders = $this->order_repo->getCurrentUserOrders();

        return view('main.profile.order_history', compact('orders'));
    }

    public function showTrackingOrder($id)
    {
        $order = $this->order_repo->findOrderWithCoupon($id);

        return view('main.profile.tracking', compact('order'));
    }

    public function showSuccessLists()
    {
        $orders = $this->order_repo->getDeliveredOrdersOfAuth();

        return view('main.profile.return_order', compact('orders'));
    }

    public function requestReturnOrder($id)
    {
        $this->order_repo->changeWorkingReturnStatus($id);

        $notification = array(
            'message' => '返品を申請しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
