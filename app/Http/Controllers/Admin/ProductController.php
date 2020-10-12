<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Product;
use App\Repositories\Product\ProductRepositoryInterface as ProductRepo;

class ProductController extends Controller
{
    protected $product_repo;

    public function __construct(ProductRepo $product_repo)
    {
        $this->product_repo = $product_repo;
    }

    public function index() {
        $products = $this->product_repo->fetchProductsWithCategoryAndBrand();

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
        $this->product_repo->createNewProduct($request);

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
        $product = $this->product_repo->findProduct($id);
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
        $product = $this->product_repo->findProductInfo($id);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show eidt product view
     *
     * @param String $id
     * @return void
     */
    public function editProduct($id) {
        $product = $this->product_repo->findProduct($id);
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
        $product = $this->product_repo->findProduct($id);

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

    /**
     * Show product stock page
     *
     * @return void
     */
    public function showProductStock()
    {
        $products = $this->product_repo->fetchProductsWithCategoryAndBrand();

        return  view('admin.product.stock', compact('products'));
    }

}
