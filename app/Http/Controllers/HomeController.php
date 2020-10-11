<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin\Post;

class HomeController extends Controller
{
    protected $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    /**
     * Show main page
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->post->with('post_category')->get();

        return view('main.index', compact('articles'));
    }

    /**
     * Show user home page
     *
     * @return void
     */
    public function home()
    {
        return view('home');
    }

    public function logout() {
        Auth::logout();
        $notification = array(
            'message' => 'ログアウトしました',
            'alert-type' => 'success'
        );

        return Redirect()->route('login')->with($notification);
    }
}
