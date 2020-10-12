<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Product;
use App\Repositories\Product\ProductRepositoryInterface as ProductRepo;
use App\Http\Requests\ProdcutRequest;

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
    public function store(ProdcutRequest $request) {
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
    public function deleteProduct($id)
    {

        $product = $this->product_repo->deleteProduct($id);

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
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_size' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required',
            'product_details' => 'required',
            'old_one' => 'required',
        ]);

        $this->product_repo->updateProductInfo($request, $id);

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
