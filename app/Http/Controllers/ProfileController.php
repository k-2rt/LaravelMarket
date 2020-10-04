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
}
