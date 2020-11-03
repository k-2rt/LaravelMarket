<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin\Post;
use App\Repositories\Product\ProductRepositoryInterface as ProductRepo;

class HomeController extends Controller
{
    protected $post;
    protected $product_repo;

    public function __construct(Post $post, ProductRepo $product_repo) {
        $this->post = $post;
        $this->product_repo = $product_repo;
    }

    /**
     * Show main page
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->post->with('post_category')->orderBy('id', 'DESC')->limit(3)->get();
        $hot_new_products = $this->product_repo->getHotNewProducts();
        $trend_products = $this->product_repo->getTrendProducts();
        $hot_deal_products = $this->product_repo->getHotDealProducts();

        return view('main.index', compact('articles', 'hot_new_products', 'trend_products', 'hot_deal_products'));
    }

    /**
     * Show user home page
     *
     * @return void
     */
    public function home()
    {
        if (Auth::check()) {
            return view('home');
        } else {
            $notification = array(
                'type' => 'warning',
                'message' => 'ログインをして下さい',
            );

            return redirect()->route('login')->with($notification);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            $notification = array(
                'message' => 'ログアウトしました',
                'alert-type' => 'success'
            );

            return Redirect()->route('login')->with($notification);
        } else {
            $notification = array(
                'type' => 'warning',
                'message' => 'ログインをして下さい',
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
