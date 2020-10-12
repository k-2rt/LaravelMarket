<?php

namespace App\Repositories\Product;

use App\Models\Admin\Product;
use App\Models\Admin\Brand;
use Image;

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
        return $this->product->where('product_name', 'LIKE', '%' . $keyword . '%')->paginate(20);
    }

    /**
     * Get Brands of search product
     *
     * @param String $keyword
     * @return Object
     */
    public function searchProdcutBrandsByKeyword($keyword)
    {
        return $this->product->select('brand_id')
                             ->with('brand:id,brand_name')
                             ->where('product_name', 'LIKE', '%' . $keyword . '%')
                             ->groupBy('brand_id')
                             ->get();
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
        $this->product->buyone_getone = $request->buyone_getone ?? "0";
        $this->product->best_rated = $request->best_rated ?? "0";
        $this->product->trend = $request->trend ?? "0";
        $this->product->mid_slider = $request->mid_slider ?? "0";
        $this->product->hot_new = $request->hot_new ?? "0";
        $this->product->status = '1';
        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one) {
            $image_one_name = uniqid() . '_' . $image_one->getClientOriginalName();
            Image::make($image_one)->resize(300, 300)->save('public/product/' . $image_one_name);
            $this->product->image_one = 'public/product/' . $image_one_name;
        }

        if ($image_two) {
            $image_two_name = uniqid() . '_' . $image_two->getClientOriginalName();
            Image::make($image_two)->resize(300, 300)->save('public/product/' . $image_two_name);
            $this->product->image_two = 'public/product/' . $image_two_name;
        }

        if ($image_three) {
            $image_three_name = uniqid() . '_' . $image_three->getClientOriginalName();
            Image::make($image_three)->resize(300, 300)->save('public/product/' . $image_three_name);
            $this->product->image_three = 'public/product/' . $image_three_name;
        }

        $this->product->save();
    }
}
