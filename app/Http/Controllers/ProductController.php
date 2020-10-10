<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Repositories\Product\ProductRepositoryInterface as ProductRepo;
use Cart;
use Auth;
use App\Models\Admin\Category;

class ProductController extends Controller
{
    protected $product;
    protected $product_repo;
    protected $category;

    public function __construct(Product $product, ProductRepo $product_repo, Category $category) {
        $this->product = $product;
        $this->product_repo = $product_repo;
        $this->category = $category;
    }

    /**
     * Show details of a product
     *
     * @param String $id
     * @param String $product_name
     * @return void
     */
    public function showProductDetails($id, $product_name) {
        $product = $this->product->getProductToDisplayInfo($id);
        $colors = explode(',', $product->product_color);
        $sizes = explode(',', $product->product_size);

        return view('main.product_details', compact('product', 'colors', 'sizes'));
    }

    /**
     * Add product to cart
     *
     * @param String $id
     * @return void
     */
    public function addProductToCart(Request $request, $id) {
        if (Auth::check()) {
            $data = $this->product->configureProductInfo($id);
            $data['qty'] = $request->qty;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;

            Cart::add($data);

            $notification = array(
                'message' => '商品をカートに追加しました',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'ログインをして下さい',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Show product lists
     *
     * @param String $id
     * @return void
     */
    public function showProductList($id) {
        $products = $this->product->getPaginateProducts($id);
        $brands = $this->product->getBrandsBySubCategoryId($id);

        return view('main.product_list', compact('products', 'brands'));
    }

    /**
     * Show category lists
     *
     * @param String $id
     * @return void
     */
    public function showCategoryList($id) {
        $products = $this->product->getPaginateCategories($id);
        $brands = $this->product->getBrandsByCategoryId($id);

        return view('main.category_list', compact('products', 'brands'));
    }

    public function searchProduct(Request $request)
    {
        $products = $this->product_repo->searchProductsByKeyword($request->search);
        $items = $this->product_repo->searchProdcutBrandsByKeyword($request->search);
        $categories = $this->category->getAllCategories();

        return view('main.search', compact('products', 'categories', 'items'));
    }
}
