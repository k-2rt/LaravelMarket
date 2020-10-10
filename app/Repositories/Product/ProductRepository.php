<?php

namespace App\Repositories\Product;

use App\Models\Admin\Product;
use App\Models\Admin\Brand;

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
}
