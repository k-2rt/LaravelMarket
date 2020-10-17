<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    /**
     * Get a product
     *
     * @param String $id
     * @return Object
     */
    public function findProduct($id);

    /**
     * Get products with category name & brand name
     *
     * @return Object
     */
    public function fetchProductsWithCategoryAndBrand();

    /**
     * Get a product with category & subcategory & brand name by id
     *
     * @param String $id
     * @return Object
     */
    public function findProductInfo($id);

    /**
     * Get products that trend is 1
     *
     * @return Object
     */
    public function getTrendProducts();

    /**
     * Get hot new products with brand name
     *
     * @return Object
     */
    public function getHotNewProducts();

    /**
     * Get hot deal products with brand name
     *
     * @return Object
     */
    public function getHotDealProducts();

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
     * Delete a product
     *
     * @param Stirng $id
     * @return void
     */
    public function deleteProduct($id);

    /**
     * Create new product
     *
     * @param Request $request
     * @return void
     */
    public function createNewProduct($request);

    /**
     * Update product
     *
     * @param Rrequest $request
     * @param String $id
     * @return void
     */
    public function updateProductInfo($request, $id);
}
