<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishList;
use Auth;

class WishListController extends Controller
{
    protected $wish_list;

    public function __construct(WishList $wish_list)
    {
        $this->wish_list = $wish_list;
    }

    /**
     * Add a wish list
     *
     * @param String $product_id
     * @return void
     */
    public function addWishList($product_id)
    {
        $user_id = Auth::id();
        $wish_product = $this->wish_list->where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->first();

        if ($wish_product) {
            $wish_product->delete();

            $notification = array(
                'type' => 'error',
                'message' => 'ほしいものリストから削除しました',
            );
        } else {
            $this->wish_list->create([
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);

            $notification = array(
                'type' => 'success',
                'message' => 'ほしいものリストに追加しました',
            );
        }

        return response()->json($notification);
    }

    /**
     * Show wish lists
     *
     * @return void
     */
    public function showWishlists()
    {
        $wish_products = $this->wish_list->getWishListsWithProduct(Auth::id());

        return view('main.wishlist', compact('wish_products'));
    }

    /**
     * Delete wish list
     *
     * @param String $id
     * @return void
     */
    public function deleteWishlist($id)
    {
        $this->wish_list->find($id)->delete();

        $notification = array(
            'type' => 'info',
            'is_completed' => '1',
            'message' => 'ほしいものリストから削除しました',
        );

        return redirect()->back()->with($notification);
    }
}
