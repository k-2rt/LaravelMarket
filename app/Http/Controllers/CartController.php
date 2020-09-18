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
            $data = $this->product->configureProductInfo($id);

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

    /**
     * Show cart view
     *
     * @return void
     */
    public function showCart() {
        $cart = Cart::content();

        return view('main.cart', compact('cart'));
    }

    /**
     * Remove item from cart
     *
     * @param String $rowId
     * @return void
     */
    public function removeCartItem($rowId) {
        Cart::remove($rowId);

        $notification = array(
            'message' => '商品をカートから削除しました',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Update quantity of a item in cart
     *
     * @param Request $request
     * @return void
     */
    public function updateCartItem(Request $request) {
        $rowId = $request->product_id;
        $qty = $request->qty;

        Cart::update($rowId, $qty);

        $notification = array(
            'message' => '数量を変更しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show product modal view
     *
     * @param String $id
     * @return JSON
     */
    public function viewProduct($id) {
        $product = $this->product->getProductToDisplayInfo($id);

        $colors = explode(',', $product->product_color);
        $sizes = explode(',', $product->product_size);

        return response()->json(array(
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
        ));
    }

    /**
     * Add item to cart from modal view
     *
     * @param Request $request
     * @return void
     */
    public function addCartFromModal(Request $request) {
        if (Auth::check()) {
            $data = $this->product->configureProductInfo($request->product_id);
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
