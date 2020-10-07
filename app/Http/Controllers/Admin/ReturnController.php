<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;

class ReturnController extends Controller
{
    protected $order_repo;

    public function __construct(OrderRepo $order_repo)
    {
        $this->order_repo = $order_repo;
    }

    public function showReturnRequest()
    {
        $orders = $this->order_repo->getReturnStatusRequest();
        $page_title = "返品申請";

        return view('admin.return.request', compact('orders', 'page_title'));
    }

    public function showReturnedLists()
    {
        $orders = $this->order_repo->getApprovedReturnRequest();
        $page_title = "返品完了";

        return view('admin.return.request', compact('orders', 'page_title'));
    }

    public function approveRequest($id)
    {
        $orders = $this->order_repo->updateReturnRequest($id);

        $notification = array(
            'message' => '承認しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
