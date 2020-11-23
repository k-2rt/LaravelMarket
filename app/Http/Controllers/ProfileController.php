<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;
use App\Http\Requests\ProfileRequest;
use Auth;

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
        $delivery_date = $order->day_of_week;

        return view('main.profile.tracking', compact('order', 'delivery_date'));
    }

    public function showReturnLists()
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

    /**
     * Show edit profile page
     *
     * @return void
     */
    public function showProfilePage()
    {
        $prefs = config('pref');
        $user = Auth::user();

        return view('main.profile', compact('prefs', 'user'));
    }

    /**
     * Update profile info
     *
     * @param ProfileRequest $request
     * @return void
     */
    public function updateProfileInfo(ProfileRequest $request) {
        $user = Auth::user();
        $user->fill($request->all())->save();

        $notification = array(
            'message' => 'ユーザー情報を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
