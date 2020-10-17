<?php

namespace App\Repositories\Product;

use App\Models\Admin\Product;
use App\Models\Admin\Brand;
use Image;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;
    protected $brand;

    /**
    * @param object $product
    */
    public function __construct(Product $product, Brand $brand)
    {
        $this->product = $product;
        $this->brand = $brand;
    }

    /**
     * Get a product
     *
     * @param String $id
     * @return Object
     */
    public function findProduct($id): Object
    {
        return $this->product->find($id);
    }

    /**
     * Get products with category name & brand name
     *
     * @return Object
     */
    public function fetchProductsWithCategoryAndBrand(): Object
    {
        return $this->product->with('category:id,category_name')
                             ->with('brand:id,brand_name')
                             ->get();
    }

    /**
     * Get a product with category & subcategory & brand name by id
     *
     * @param String $id
     * @return Object
     */
    public function findProductInfo($id): Object
    {
        return $this->product->with('category:id,category_name')
                             ->with('brand:id,brand_name')
                             ->with('subcategory:id,subcategory_name')
                             ->find($id);
    }

    /**
     * Get products that trend is 1
     *
     * @return Object
     */
    public function getTrendProducts(): Object
    {
        return $this->product->with('current_user_wish')
                             ->where('status', 1)
                             ->where('trend', 1)
                             ->orderBy('id', 'DESC')
                             ->limit(24)
                             ->get();
    }

    /**
     * Get hot new products with brand name
     *
     * @return Object
     */
    public function getHotNewProducts(): Object
    {
        return $this->product->with('brand:id,brand_name')
                             ->where('status', 1)
                             ->where('hot_new', 1)
                             ->where('discount_price', NULL)
                             ->where('product_quantity', '<>', 0)
                             ->limit(3)
                             ->latest('updated_at')
                             ->get();
    }

    /**
     * Get hot deal products with brand name
     *
     * @return Object
     */
    public function getHotDealProducts(): Object
    {
        return $this->product->with('brand:id,brand_name')
                             ->where('status', 1)
                             ->where('hot_deal', 1)
                             ->where('product_quantity', '<>', 0)
                             ->where('discount_price', '<>', NULL)
                             ->limit(8)
                             ->orderBy('id', 'DESC')
                             ->get();
    }

    /**
     * Decrement stock of product
     *
     * @param Object $item
     * @return void
     */
    public function decrementProductQuantity($item): void
    {
        $this->product->find($item->product_id)->decrement('product_quantity', $item->quantity);
    }

    /**
     * Search products by keyword
     *
     * @param String $keyword
     * @return Object
     */
    public function searchProductsByKeyword($keyword): Object
    {
        return $this->product->with('current_user_wish')
                             ->with('brand:id,brand_name')
                             ->where('product_name', 'LIKE', '%' . $keyword . '%')
                             ->paginate(10);
    }

    /**
     * Delete a product
     *
     * @param Stirng $id
     * @return void
     */
    public function deleteProduct($id)
    {
        $product = $this->findProduct($id);
        $image_one = $product->image_one;
        $image_two = $product->image_two;
        $image_three = $product->image_three;

        if ($image_one) {
            $image_path = str_replace('storage/', 'public/', $image_one);
            if (Storage::exists($image_path)) {
                Storage::delete($image_path);
            }
        }

        if ($image_two) {
            $image_path = str_replace('storage/', 'public/', $image_two);
            if (Storage::exists($image_path)) {
                Storage::delete($image_path);
            }
        }

        if ($image_three) {
            $image_path = str_replace('storage/', 'public/', $image_three);
            if (Storage::exists($image_path)) {
                Storage::delete($image_path);
            }
        }

        $product->delete();
    }

    /**
     * Create new product
     *
     * @param Request $request
     * @return void
     */
    public function createNewProduct($request)
    {
        $this->product->fill($request->all());

        $this->product->main_slider = $request->main_slider ?? "0";
        $this->product->hot_deal = $request->hot_deal ?? "0";
        $this->product->best_rated = $request->best_rated ?? "0";
        $this->product->trend = $request->trend ?? "0";
        $this->product->mid_slider = $request->mid_slider ?? "0";
        $this->product->hot_new = $request->hot_new ?? "0";
        $this->product->status = '1';
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            $image_one_name = uniqid() . '_' . $image_one->getClientOriginalName();
            $img = Image::make($image_one)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_one_name, $img);
            $this->product->image_one = 'storage/product/' . $image_one_name;
        }

        if ($image_two) {
            $image_two_name = uniqid() . '_' . $image_two->getClientOriginalName();
            $img = Image::make($image_two)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_two_name, $img);
            $this->product->image_two = 'storage/product/' . $image_two_name;
        }

        if ($image_three) {
            $image_three_name = uniqid() . '_' . $image_three->getClientOriginalName();
            $img = Image::make($image_three)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_three_name, $img);
            $this->product->image_three = 'storage/product/' . $image_three_name;
        }

        $this->product->save();
    }

    /**
     * Update product
     *
     * @param Rrequest $request
     * @param String $id
     * @return void
     */
    public function updateProductInfo($request, $id)
    {
        $product = $this->findProduct($id);

        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->product_size = $request->product_size;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->product_details = $request->product_details;
        $product->video_link = $request->video_link;
        $product->main_slider = $request->main_slider ?? "0";
        $product->hot_deal = $request->hot_deal ?? "0";
        $product->best_rated = $request->best_rated ?? "0";
        $product->trend = $request->trend ?? "0";
        $product->mid_slider = $request->mid_slider ?? "0";
        $product->hot_new = $request->hot_new ?? "0";

        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            if ($old_one) {
                $image_path = str_replace('storage/', 'public/', $old_one);
                if (Storage::exists($image_path)) {
                    Storage::delete($image_path);
                }
            }

            $image_one_name = uniqid() . '_' . $image_one->getClientOriginalName();
            $img = Image::make($image_one)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_one_name, $img);
            $product->image_one = 'storage/product/' . $image_one_name;
        }

        if ($image_two) {
            if ($old_two) {
                $image_path = str_replace('storage/', 'public/', $old_two);
                if (Storage::exists($image_path)) {
                    Storage::delete($image_path);
                }
            }

            $image_two_name = uniqid() . '_' . $image_two->getClientOriginalName();
            $img = Image::make($image_two)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_two_name, $img);
            $product->image_two = 'storage/product/' . $image_two_name;
        }

        if ($image_three) {
            if ($old_three) {
                $image_path = str_replace('storage/', 'public/', $old_three);
                if (Storage::exists($image_path)) {
                    Storage::delete($image_path);
                }
            }

            $image_three_name = uniqid() . '_' . $image_three->getClientOriginalName();
            $img = Image::make($image_three)->resize(300, 300)->encode('jpg');
            Storage::put('public/product/' . $image_three_name, $img);
            $product->image_three = 'storage/product/' . $image_three_name;
        }

        $product->save();
    }
}
