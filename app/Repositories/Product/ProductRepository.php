<?php

namespace App\Repositories\Product;

use App\Models\Admin\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    /**
    * @param object $product
    */
    public function __construct(Product $product)
    {
        $this->product = $product;
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
}
