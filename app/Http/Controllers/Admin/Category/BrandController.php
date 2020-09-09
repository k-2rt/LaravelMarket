<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;

class BrandController extends Controller
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
    public function brand() {
        $brands = Brand::all();

        return view('admin.category.brand', compact('brands'));
    }


    /**
     * Store brand
     * イメーシURLは現在の日付と画像名を組み合わせ保存
     *
     * @param Request $request
     * @return void
     */
    public function storeBrand(Request $request) {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand_image = $request->file('brand_logo');

        if ($brand_image) {
            $temp_path = $brand_image->store('public/brand');
            $read_temp_path = str_replace('public/', 'storage/', $temp_path);
            $brand->brand_logo = $read_temp_path;
        }

        $brand->save();

        $notification = array(
            'message' => 'ブランドを追加しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete brand
     *
     * @param String $id
     * @return void
     */
    public function deleteBrand($id) {
        $brand = Brand::find($id);
        unlink($brand->brand_logo);
        $brand->delete();

        $notification = array(
            'message' => 'ブランドを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit view
     *
     * @param String $id
     * @return void
     */
    public function editBrand($id) {
        $brand = Brand::find($id);

        return view('admin.category.edit_brand', compact('brand'));
    }

    public function updateBrand(Request $request, $id) {
        $request->validate([
            'brand_name' => 'required|max:55',
        ]);

        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand_image = $request->file('brand_logo');
        $old_logo = $request->old_logo;

        if ($brand_image) {
            if ($old_logo) {
                unlink($old_logo);
            }

            $create_date = date('Ymd');
            $image_full_name = $create_date . '_' . strtolower($brand_image->getClientOriginalName());
            $upload_path = 'public/brand/';
            $brand_image->move($upload_path, $image_full_name);
            $brand->brand_logo = $upload_path . $image_full_name;
        } else {
            $brand->brand_logo = $old_logo;
        }

        $brand->update();

        $notification = array(
            'message' => 'ブランドを更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('brands')->with($notification);
    }

}
