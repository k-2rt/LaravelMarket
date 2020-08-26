<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show subcategory view
     *
     * @return void
     */
    public function subcategory() {
        $categories = Category::all();
        $sub_categories = Subcategory::select('subcategories.*', 'categories.category_name')
                            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                            ->orderBy('id')
                            ->get();

        return view('admin.category.subcategory', compact('categories', 'sub_categories'));
    }

    /**
     * Store subcategory
     *
     * @param Request $request
     * @return void
     */
    public function storeSubcategory(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:255',
        ]);

        Subcategory::create($request->all());

        $notification = array(
            'message' => 'サブカテゴリーを追加しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete subcategory
     *
     * @param String $id
     * @return void
     */
    public function deleteSubcategory($id) {
        Subcategory::find($id)->delete();

        $notification = array(
            'message' => 'サブカテゴリーを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    /**
     * Show edit subcategory view
     *
     * @param String $id
     * @return void
     */
    public function editSubcategory($id) {
        $categories = Category::all();
        $subcategory = Subcategory::find($id);

        return view('admin.category.edit_subcategory', compact('categories', 'subcategory'));
    }

    /**
     * Update subcategory
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateSubcategory(Request $request, $id) {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name'  => 'required|max:255',
        ]);

        Subcategory::find($id)->update($request->all());

        $notification = array(
            'message' => 'サブカテゴリーを更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategories')->with($notification);
    }

}
