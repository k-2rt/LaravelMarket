<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('pages.index');
});

Auth::routes(['verify' => true]);
Route::get('home', 'HomeController@index')->name('home');
Route::get('password/change', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword')->name('password.change');

Route::get('user/logout', 'HomeController@logout')->name('user.logout');

// Admin Route
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// Password Reset Routes
Route::get('admin/password/change','AdminController@showChangePasswordForm')->name('admin.password.change');
Route::post('admin/password/change','AdminController@changePassword')->name('admin.password.change');


// Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
// Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');

// Admin categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storeCategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@deleteCategory')->name('delete.category');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@editCategory')->name('edit.category');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@updateCategory')->name('update.category');

// Admin brands
Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\BrandController@storeBrand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\BrandController@deleteBrand')->name('delete.brand');
Route::get('edit/brand/{id}', 'Admin\Category\BrandController@editBrand')->name('edit.brand');
Route::post('update/brand/{id}', 'Admin\Category\BrandController@updateBrand')->name('update.brand');

// Admin sub categories
Route::get('admin/subcategories', 'Admin\Category\SubCategoryController@subcategory')->name('subcategories');
Route::post('admin/store/subcategory', 'Admin\Category\SubCategoryController@storeSubcategory')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\SubCategoryController@deleteSubcategory')->name('delete.subcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\SubCategoryController@editSubcategory')->name('edit.subcategory');
Route::post('update/subcategory/{id}', 'Admin\Category\SubCategoryController@updateSubcategory')->name('update.subcategory');

// Admin  Coupons
Route::get('admin/coupon', 'Admin\Coupon\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\Coupon\CouponController@storeCoupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\Coupon\CouponController@deleteCoupon')->name('delete.coupon');
Route::get('edit/coupon/{id}', 'Admin\Coupon\CouponController@editCoupon')->name('edit.coupon');
Route::post('update/coupon/{id}', 'Admin\Coupon\CouponController@updateCoupon')->name('update.coupon');

// Admin Products
Route::get('admin/product/index', 'Admin\ProductController@index')->name('index.product');
Route::get('admin/product/create', 'Admin\ProductController@create')->name('create.product');
Route::post('admin/product/store', 'Admin\ProductController@store')->name('store.product');
Route::get('inactive/product/{id}', 'Admin\ProductController@inactive')->name('inactive.product');
Route::get('active/product/{id}', 'Admin\ProductController@active')->name('active.product');
Route::get('delete/product/{id}', 'Admin\ProductController@deleteProduct')->name('delete.product');
Route::get('show/product/{id}', 'Admin\ProductController@showProduct')->name('show.product');
Route::get('edit/product/{id}', 'Admin\ProductController@editProduct')->name('edit.product');
Route::post('update/product/{id}', 'Admin\ProductController@updateProduct')->name('update.product');
Route::post('update/product/image/{id}', 'Admin\ProductController@updateProductImage')->name('update.product_images');
// For show sub categories with Ajax
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getSubcategories');

// Newsletters
Route::get('admin/newsletter', 'Admin\Others\NewsletterController@newsletter')->name('admin.newsletter');
Route::post('admin/store/newsletter', 'Admin\Others\NewsletterController@storeNewsletter')->name('store.newsletter');
Route::get('delete/newsletter/{id}', 'Admin\Others\NewsletterController@deleteNewsletter')->name('delete.newsletter');

// Admin blog route
Route::get('blog/category/list', 'Admin\PostController@blogCategoryList')->name('index.blog.category');
Route::post('blog/category/blog', 'Admin\PostController@storeBlogCategory')->name('store.blog.category');
Route::get('delete/blog/category/{id}', 'Admin\PostController@deleteBlogCategory')->name('delete.blog.category');
Route::get('edit/blog/category/{id}', 'Admin\PostController@editBlogCategory')->name('edit.blog.category');
Route::post('update/blog/category/{id}', 'Admin\PostController@updateBlogCategory')->name('update.blog.category');

Route::get('index/blog/post', 'Admin\PostController@indexPost')->name('index.blog.post');
Route::get('create/blog/post', 'Admin\PostController@createPost')->name('create.blog.post');
Route::post('store/blog/post', 'Admin\PostController@storeBlogPost')->name('store.blog.post');
Route::get('delete/post/{id}', 'Admin\PostController@deletePost')->name('delete.post');
Route::get('edit/post/{id}', 'Admin\PostController@editPost')->name('edit.post');
Route::post('update/post/{id}', 'Admin\PostController@updatePost')->name('update.post');

// Add Wish List Route
Route::get('add/wishlist/{id}', 'WishListController@addWishList');

// Add Cart Route
Route::get('add/cart/{id}', 'CartController@addProductToCart');
Route::get('check/cart', 'CartController@checkCart');
