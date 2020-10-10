<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;
use App\Models\Admin\Product;
use App\Models\Admin\Brand;
use App\User;


class AdminController extends Controller
{
    protected $product;
    protected $brand;
    protected $user;
    protected $order_repo;

    public function __construct(OrderRepo $order_repo, Product $product, Brand $brand, User $user)
    {
        $this->product = $product;
        $this->brand = $brand;
        $this->user = $user;
        $this->order_repo = $order_repo;
    }

    /**
     * Show admin home view
     *
     * @return void
     */
    public function index() {
        $today_total = $this->order_repo->calculateTodaysOrderTotal();
        $month_total = $this->order_repo->calculateMonthOrderTotal();
        $year_total = $this->order_repo->calculateYearOrderTotal();
        $delevered = $this->order_repo->calculateOrderTotalOfTodaysDelivered();
        $return = $this->order_repo->calculateReturnOrder();
        $prodcut_count = $this->product->countAllProducts();
        $brand_count = $this->brand->countAllBrands();
        $user_count = $this->user->countAllUsers();

        return view('admin.home', compact('today_total', 'month_total', 'year_total', 'delevered', 'return', 'prodcut_count', 'brand_count', 'user_count'));
    }

    /**
     * Show change pass form view
     *
     * @return void
     */
    public function showChangePasswordForm() {
        return view('admin.auth.password_change');
    }

    /**
     * Change admin user pass
     *
     * @param Request $request
     * @return void
     */
    public function changePassword(Request $request) {
        $password = Auth::user()->password;
        $oldpass = $request->oldpassword;
        $newpass = $request->password;
        $confirm = $request->password_confirmation;

        if (Hash::check($oldpass, $password)) {
            if ($newpass === $confirm) {
                $user = Admin::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                $notification = array(
                    'message' => 'パスワードは変更されました。',
                    'alert-type' => 'success'
                );

                return redirect()->route('admin.login')->with($notification);
            } else {
                $notification = array(
                    'message' => '新しいパスワードと確認用を合わせて下さい。',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'パスワードが違います。',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function logout() {
        Auth::Logout();
        $notification = array(
            'message' => 'ログアウトしました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login')->with($notification);
    }
}
