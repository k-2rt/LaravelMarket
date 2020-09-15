<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Cart;
use Auth;

class CartController extends Controller
{
    protected $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    /**
     * Add product to cart
     *
     * @param String $id
     * @return JSON
     */
    public function addProductToCart($id) {
        if (Auth::check()) {
            $product = $this->product->where('id', $id)->first();

            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;

            if ($product->discount_price === NULL) {
                $data['price'] = $product->selling_price;
            } else {
                $data['price'] = $product->discount_price;
            }

            Cart::add($data);

            $notification = array(
                'type' => 'success',
                'message' => '商品をカートに追加しました',
            );
        } else {
            $notification = array(
                'type' => 'warning',
                'message' => 'ログインをして下さい',
            );
        }

        return response()->json($notification);
    }

    public function checkCart() {
        $content = Cart::content();

        return response()->json($content);
    }
}
