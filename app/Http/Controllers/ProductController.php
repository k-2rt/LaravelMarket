<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Cart;
use Auth;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    /**
     * Show details of a product
     *
     * @param [type] $id
     * @param [type] $product_name
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
}
