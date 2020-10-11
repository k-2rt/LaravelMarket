<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PostCategory;
use App\Models\Admin\Post;
use Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show blog categories list
     *
     * @return void
     */
    public  function blogCategoryList() {
        $blog_categories = PostCategory::all();

        return view('admin.blog.category.index', compact('blog_categories'));
    }

    /**
     * Store  blog category
     *
     * @param Request $request
     * @return void
     */
    public function storeBlogCategory(Request $request) {
        $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_ja' => 'required|max:255',
        ]);

        PostCategory::create($request->all());

        $notification = array(
            'message' => 'カテゴリーを追加しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete blog category
     *
     * @param String $id
     * @return void
     */
    public function deleteBlogCategory($id) {
        PostCategory::find($id)->delete();

        $notification = array(
            'message' => 'カテゴリーを削除しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit blog category view
     *
     * @param String $id
     * @return void
     */
    public function editBlogCategory($id) {
        $blog_category = PostCategory::find($id);

        return view('admin.blog.category.edit', compact('blog_category'));
    }

    /**
     * Update blog category
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateBlogCategory(Request $request, $id) {
        PostCategory::find($id)->update($request->all());

        $notification = array(
            'message' => 'カテゴリーを更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.blog.category')->with($notification);
    }

    /**
     * Show create post view
     *
     * @return void
     */
    public function createPost() {
        $article_categories = PostCategory::all();

        return view('admin.blog.create', compact('article_categories'));
    }

    /**
     * Store article post
     *
     * @param Request $request
     * @return void
     */
    public function storeArticlePost(Request $request) {
        $post = new Post();
        $post->fill($request->all());
        $post_image = $request->file('post_image');

        if ($post_image) {
            $post_image_name = uniqid() . "_" . $post_image->getClientOriginalName();
            Image::make($post_image)->resize(400, 200)->save('public/post/' . $post_image_name);
            $post->post_image = 'public/post/' . $post_image_name;
        }

        $post->save();

        $notification = array(
            'message' => '投稿しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.blog.post')->with($notification);
    }

    /**
     * Show post list
     *
     * @return void
     */
    public function indexPost() {
        $posts = Post::select('posts.*', 'posts.post_category_id', 'post_categories.category_name_en')
                    ->join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                    ->orderBy('id')
                    ->get();

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Delete post
     *
     * @param String $id
     * @return void
     */
    public function deletePost($id) {
        $post = Post::find($id);
        $post_image = $post->post_image;
        if ($post_image) {
            unlink($post_image);
        }

        $post->delete();

        $notification = array(
            'message' => '投稿を削除しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit post view
     *
     * @param [type] $id
     * @return void
     */
    public function editPost($id) {
        $post = Post::find($id);
        $blog_categories = PostCategory::all();


        return view('admin.blog.edit', compact('post', 'blog_categories'));
    }

    public function updatePost(Request $request, $id) {
        $post = Post::find($id);
        $post->fill($request->all());
        $old_image = $request->old_image;
        $post_image = $request->file('post_image');

        if ($post_image) {
            if ($old_image) {
                unlink($old_image);
            }

            $post_image_name = uniqid() . "_" . $post_image->getClientOriginalName();
            Image::make($post_image)->resize(400, 200)->save('public/post/' . $post_image_name);
            $post->post_image = 'public/post/' . $post_image_name;
        } else {
            $post->post_image = $old_image;
        }

        $post->save();

        $notification = array(
            'message' => '投稿を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.blog.post')->with($notification);
    }
}
