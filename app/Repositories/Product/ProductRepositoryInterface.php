<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    /**
     * Get products with category name & brand name
     *
     * @return Object
     */
    public function fetchProductsWithCategoryAndBrand();

    /**
     * Decrement stock of product
     *
     * @param Object $item
     * @return void
     */
    public function decrementProductQuantity($item);

    /**
     * Search products by keyword
     *
     * @param String $keyword
     * @return Object
     */
    public function searchProductsByKeyword($keyword);

    /**
     * Get Brands of search product
     *
     * @param String $keyword
     * @return Object
     */
    public function searchProdcutBrandsByKeyword($keyword);
}
