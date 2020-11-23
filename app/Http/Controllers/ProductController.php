<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Repositories\Product\ProductRepositoryInterface as ProductRepo;
use Cart;
use Auth;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Post;
use App\Models\Comment;

class ProductController extends Controller
{
    protected $product;
    protected $product_repo;
    protected $category;
    protected $sub_category;
    protected $post;
    protected $comment;

    public function __construct(Product $product,
                                ProductRepo $product_repo,
                                Category $category,
                                Subcategory $sub_category,
                                Post $post,
                                Comment $comment)
    {
        $this->product = $product;
        $this->product_repo = $product_repo;
        $this->category = $category;
        $this->sub_category = $sub_category;
        $this->post = $post;
        $this->comment = $comment;
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
        $comments = $this->comment->getProductCommentsById($id);
        $colors = explode(',', $product->product_color);
        $sizes = explode(',', $product->product_size);

        return view('main.product_details', compact('product', 'colors', 'sizes', 'comments'));
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
     * Show category lists
     *
     * @param String $id
     * @return void
     */
    public function showCategoryList($id) {
        $products = $this->product->getPaginateCategories($id);
        $categories = $this->category->getAllCategories();
        $product_category = $this->category->findCategory($id);
        $brands = $this->product->getBrandsByCategoryId($id);

        return view('main.category_list', compact('products', 'categories', 'product_category', 'brands'));
    }

    /**
     * Show sub category lists
     *
     * @param String $id
     * @return void
     */
    public function showSubCategoryList($id) {
        $products = $this->product->getPaginateProducts($id);
        $categories = $this->category->getAllCategories();
        $product_subcategory = $this->sub_category->findSubCategory($id);
        $brands = $this->product->getBrandsBySubCategoryId($id);

        return view('main.sub_category_list', compact('products', 'categories', 'product_subcategory', 'brands'));
    }

    public function searchItem(Request $request)
    {
        $keyword = $request->keyword;
        $mode = $request->mode;

        if ($mode === 'article') {
            $posts = $this->post->searchArticlesByKeyword($keyword);
            $search_article = 'checked';

            return view('main.search_article', compact('posts', 'keyword', 'search_article'));
        } else {
            $products = $this->product_repo->searchProductsByKeyword($keyword);
            $categories = $this->category->getAllCategories();
            return view('main.search_product', compact('products', 'categories', 'keyword'));
        }
    }
}
