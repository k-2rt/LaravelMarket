<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Product;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $products = Product::select('products.*', 'categories.category_name', 'brands.brand_name')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('brands', 'products.brand_id', '=', 'brands.id')
                        ->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show create product view
     *
     * @return void
     */
    public function create() {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('categories','brands'));
    }

    /**
     * Undocumented function
     *
     * @param string $category_id
     * @return JSON Array
     */
    public function getSubcategories($category_id) {
        $sub_categories = Subcategory::where('category_id', $category_id)->get();

        return json_encode($sub_categories);
    }

    /**
     * Store product
     * 画像名はユニークの数字に変換し、保存
     * 縦300 x 横300にリサイズ
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $product = new Product();
        $product->fill($request->all());

        $request->main_slider = $request->main_slider ?? "0";
        $request->hot_deal = $request->hot_deal ?? "0";
        $request->best_rated = $request->best_rated ?? "0";
        $request->trend = $request->trend ?? "0";
        $request->mid_slider = $request->mid_slider ?? "0";
        $request->hot_new = $request->hot_new ?? "0";
        $product->status = '1';
        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one) {
            $image_one_name = uniqid() . '_' . $image_one->getClientOriginalName();
            Image::make($image_one)->resize(300, 300)->save('public/product/' . $image_one_name);
            $product->image_one = 'public/product/' . $image_one_name;
        }

        if ($image_two) {
            $image_two_name = uniqid() . '_' . $image_two->getClientOriginalName();
            Image::make($image_two)->resize(300, 300)->save('public/product/' . $image_two_name);
            $product->image_two = 'public/product/' . $image_two_name;
        }

        if ($image_three) {
            $image_three_name = uniqid() . '_' . $image_three->getClientOriginalName();
            Image::make($image_three)->resize(300, 300)->save('public/product/' . $image_three_name);
            $product->image_three = 'public/product/' . $image_three_name;
        }

        $product->save();

        $notification = array(
            'message' => '商品を追加しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.product')->with($notification);
    }

    /**
     * Update status to inactive
     *
     * @param String $id
     * @return void
     */
    public function inactive($id) {
        Product::find($id)->update(['status' => 0]);

        $notification = array(
            'message' => '商品を無効化しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Update status to active
     *
     * @param String $id
     * @return void
     */
    public function active($id) {
        Product::find($id)->update(['status' => 1]);

        $notification = array(
            'message' => '商品を有効化しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete product
     *
     * @param String $id
     * @return void
     */
    public function deleteProduct($id) {
        $product = Product::find($id);
        $image_one = $product->image_one;
        $image_two = $product->image_two;
        $image_three = $product->image_three;

        unlink($image_one);
        unlink($image_two);
        unlink($image_three);

        $product->delete();

        $notification = array(
            'message' => '商品を削除しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show product view
     *
     * @param String $id
     * @return void
     */
    public function showProduct($id) {
        $product = Product::select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
                        ->where('products.id', $id)
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                        ->join('brands', 'products.brand_id', '=', 'brands.id')
                        ->first();

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show eidt product view
     *
     * @param String $id
     * @return void
     */
    public function editProduct($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        $brands = Brand::all();

        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }

    /**
     * Update product
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateProduct(Request $request, $id) {
        Product::find($id)->update($request->all());

        $notification = array(
            'message' => '商品を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.product')->with($notification);
    }

    /**
     * Update product images
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateProductImage(Request $request, $id) {
        $product = Product::find($id);

        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            if ($old_one) {
                unlink($old_one);
            }

            $create_date = date('Ymd');
            $image_full_name = $create_date . '_' . strtolower($image_one->getClientOriginalName());
            $upload_path = 'public/product/';
            $image_one->move($upload_path, $image_full_name);
            $product->image_one = $upload_path . $image_full_name;
        }

        if ($image_two) {
            if ($old_two) {
                unlink($old_two);
            }

            $create_date = date('Ymd');
            $image_full_name = $create_date . '_' . strtolower($image_two->getClientOriginalName());
            $upload_path = 'public/product/';
            $image_two->move($upload_path, $image_full_name);
            $product->image_two = $upload_path . $image_full_name;
        }

        if ($image_three) {
            if ($old_three) {
                unlink($old_three);
            }

            $create_date = date('Ymd');
            $image_full_name = $create_date . '_' . strtolower($image_three->getClientOriginalName());
            $upload_path = 'public/product/';
            $image_three->move($upload_path, $image_full_name);
            $product->image_three = $upload_path . $image_full_name;
        }

        $product->update();

        $notification = array(
            'message' => '商品を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.product')->with($notification);
    }

}
