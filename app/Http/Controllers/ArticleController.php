<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Post;
use Session;

class ArticleController extends Controller
{
    protected $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function showArticles() {
        $posts = $this->post->getPostsWithPostCategories();

        return view('main.article', compact('posts'));
    }

    public function showArticleDetail($id) {
        $post = $this->post->find($id);

        return view('main.article_detail', compact('post'));
    }

    public function changeJapaneseNotation() {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang', 'japanese');

        return redirect()->back();
    }

    public function changeEnglishNotation() {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang', 'english');

        return redirect()->back();
    }
}
