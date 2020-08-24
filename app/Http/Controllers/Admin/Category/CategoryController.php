<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
// use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show category page
     *
     * @return void
     */
    public function category() {
        $categories = Category::all();

        return view('admin.category.category', compact('categories'));
    }

    /**
     * Create category
     *
     * @param Request $request
     * @return void
     */
    public function storeCategory(Request $request) {
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        Category::create($request->all());

        $notification = array(
            'message' => 'カテゴリーを追加しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete category
     *
     * @param [type] $id
     * @return void
     */
    public function deleteCategory($id) {
        Category::find($id)->delete();

        $notification = array(
            'message' => 'カテゴリーを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit category view
     *
     * @param [type] $id
     * @return void
     */
    public function editCategory($id) {
        $category = Category::find($id);
        return view('admin.category.edit_category', compact('category'));
    }

    /**
     * Update category
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateCategory(Request $request, $id) {
        $request->validate([
            'category_name'  => 'required|max:255',
        ]);

        $updatedData = Category::find($id)->fill($request->all())->save();

        if ($updatedData) {
            $notification = array(
                'message' => 'カテゴリーを更新しました。',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'カテゴリーを更新出来ませんでした',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('categories')->with($notification);
    }
}
