<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $order_repo;

    public function __construct(OrderRepo $order_repo)
    {
        $this->order_repo = $order_repo;
    }

    /**
     * Show todays orders
     *
     * @return void
     */
    public function showTodayOrder()
    {
        $orders = $this->order_repo->getTodaysOrders();

        return view('admin.report.today_order', compact('orders'));
    }

    /**
     * Show todays delivered order
     *
     * @return void
     */
    public function showTodaysDeliveredOrder()
    {
        $orders = $this->order_repo->getTodaysDeliveredOrders();

        return view('admin.report.today_delivered', compact('orders'));
    }

    /**
     * Show orders of this month
     *
     * @return void
     */
    public function showOrdersOfThisMonth()
    {
        $orders = $this->order_repo->getDeliveredOrdersOfThisMonth();

        return view('admin.report.this_month_delivered', compact('orders'));
    }

    /**
     * Show & Search orders
     *
     * @param Request $request
     * @return void
     */
    public function searchOrders(Request $request)
    {
        $keywords = [
            'order_date_from' => $request->input('order_date_from'),
            'order_date_to' => $request->input('order_date_to'),
            'transaction' => $request->input('transaction'),
            'payment' => $request->input('payment'),
            'status' => $request->input('status'),
            'subtotal' => $request->input('subtotal'),
            'total' => $request->input('total'),
        ];

        if (!empty(array_filter($keywords))) {
            $orders = $this->order_repo->searchOrders($keywords);
        } else {
            $orders = $this->order_repo->getAll();
        }

        return view('admin.report.search', compact('orders', 'keywords'));
    }
}
