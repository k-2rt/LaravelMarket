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
    return view('main.index');
});

Auth::routes(['verify' => true]);
Route::get('home', 'HomeController@index')->name('home');
Route::get('password/change', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword')->name('password.change');

Route::get('user/logout', 'HomeController@logout')->name('user.logout');

// Admin Route
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

// OAuth Route
Route::get('login/redirect/{provider}', 'Auth\OAuthLoginController@socialLogin');
Route::get('login/callback/{provider}', 'Auth\OAuthLoginController@handleProviderCallback');

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

// Wish List Route
Route::get('add/wishlist/{id}', 'WishListController@addWishList');

// Cart Route
Route::get('add/cart/{id}', 'CartController@addProductToCart');
Route::get('check/cart', 'CartController@checkCart');
Route::get('show/cart', 'CartController@showCart')->name('show.cart');
Route::get('remove/cart/item/{rowId}', 'CartController@removeCartItem')->name('remove.cart.item');
Route::post('update/cart/item', 'CartController@updateCartItem')->name('update.cart.item');
Route::post('insert/into/cart', 'CartController@addCartFromModal')->name('insert.into.cart');
Route::get('product/checkout', 'CartController@checkoutProduct')->name('checkout.product');
Route::get('user/wishlist', 'CartController@showWishlists')->name('user.wishlist');

Route::post('apply/coupon', 'CartController@applyCoupon')->name('apply.coupon');
Route::get('remove/coupon', 'CartController@removeCoupon')->name('remove.coupon');

Route::get('product/details/{id}/{product_name}', 'ProductController@showProductDetails')->name('product.detail');
Route::post('add/product/cart/{id}', 'ProductController@addProductToCart')->name('add.product.cart');
// Products Details Page
Route::get('show/product/list/{id}', 'ProductController@showProductList')->name('show.product.list');

Route::get('show/category/list/{id}', 'ProductController@showCategoryList')->name('show.category.list');

// Blog Post Route
Route::get('index/article', 'ArticleController@showArticles')->name('index.article');
Route::get('show/article/{id}', 'ArticleController@showArticleDetail')->name('show.article');

// Change Language
Route::get('language/japanese', 'ArticleController@changeJapaneseNotation')->name('language.japanese');
Route::get('language/english', 'ArticleController@changeEnglishNotation')->name('language.english');

// Payment Products
Route::get('payment/page', 'PaymentController@showPaymentPage')->name('payment.page');
Route::post('process/payment', 'PaymentController@processPayment')->name('process.payment');
Route::post('payment/stripe', 'PaymentController@payByStripe')->name('payment.stripe');

Route::post('update/shipping/address', 'AddressController@updateShippingAddress')->name('update.shipping.address');
Route::get('show/address/page', 'AddressController@showAddressPage')->name('show.address.page');

// SEO Setting Route
Route::get('admin/seo', 'Admin\Others\SEOController@seo')->name('admin.seo');
Route::post('admin/update/seo', 'Admin\Others\SEOController@updateSEO')->name('update.seo');

// Track Order Route
Route::get('order_history/lists', 'ProfileController@showOrderHistoryLists')->name('order_history.lists');
Route::get('tracking/order/{id}', 'ProfileController@showTrackingOrder')->name('tracking.order');

// Return Order Route
Route::get('success/order/lists', 'ProfileController@showSuccessLists')->name('success.order.lists');

Route::get('request/return/order/{id}', 'ProfileController@requestReturnOrder')->name('request.return.order');

Route::get('contact/page', 'ContactController@showContactPage')->name('contact.page');
Route::post('contact/form', 'ContactController@sendContactMessage')->name('contact.form');

Route::post('search/product', 'ProductController@searchProduct')->name('search.product');

Route::middleware('auth:admin')->group(function() {
    Route::get('admin/home', 'AdminController@index');
    Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');
    // Password Reset Routes
    Route::get('admin/password/change','AdminController@showChangePasswordForm')->name('admin.password.change');
    Route::post('admin/password/change','AdminController@changePassword')->name('admin.password.change');

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

    Route::get('admin/product/stock', 'Admin\ProductController@showProductStock')->name('admin.product.stock');

    // Admin Order Route
    Route::get('admin/pending/order', 'Admin\OrderController@showPendingOrderLists')->name('admin.pending.order');
    Route::get('admin/accepted/payment', 'Admin\OrderController@showAcceptedOrderLists')->name('admin.accepted.payment');
    Route::get('admin/cancel/order', 'Admin\OrderController@showCancelOrderLists')->name('admin.cancel.order');
    Route::get('admin/process/order', 'Admin\OrderController@showProcessOrderLists')->name('admin.process.order');
    Route::get('admin/delivered/order', 'Admin\OrderController@showDeliveredOrderLists')->name('admin.delivered.order');
    Route::get('admin/order/details/{id}', 'Admin\OrderController@showOrderDetails')->name('admin.order.details');
    Route::get('admin/accept/payment/{id}', 'Admin\OrderController@acceptPayment')->name('admin.accept.payment');
    Route::get('admin/cancel/payment/{id}', 'Admin\OrderController@cancelPayment')->name('admin.cancel.payment');
    Route::get('admin/update/process/order/{id}', 'Admin\OrderController@updateProcessOrder')->name('admin.update.process.order');
    Route::get('admin/delivery/done/{id}', 'Admin\OrderController@updateDeliveryOrder')->name('admin.delivery.done');

    // Order Report Route
    Route::get('admin/report/today/order', 'Admin\ReportController@showTodayOrder')->name('report.today.order');
    Route::get('admin/report/delivered/order', 'Admin\ReportController@showTodaysDeliveredOrder')->name('report.delivered.order');
    Route::get('admin/report/month/order', 'Admin\ReportController@showOrdersOfThisMonth')->name('report.month.order');
    Route::get('admin/search/orders', 'Admin\ReportController@searchOrders')->name('search.report');

    // Admin User Route
    Route::get('admin/user/lists', 'Admin\UserRoleController@showUserRoleLists')->name('admin.user.lists');
    Route::get('admin/delete/{id}', 'Admin\UserRoleController@deleteAdminUser')->name('delete.admin');
    Route::get('admin/edit/{id}', 'Admin\UserRoleController@editAdminUser')->name('edit.admin');
    Route::get('admin/create', 'Admin\UserRoleController@createAdminUser')->name('admin.create.user');
    Route::post('admin/store', 'Admin\UserRoleController@storeAdminUser')->name('store.admin.user');
    Route::post('admin/update/{id}', 'Admin\UserRoleController@updateAdminUser')->name('update.admin.user');

    // Admin Site Route
    Route::get('admin/site/setting', 'Admin\SiteSettingController@showSiteSetting')->name('admin.site.setting');
    Route::post('admin/site/setting/{id}', 'Admin\SiteSettingController@updateSiteSetting')->name('update.site.setting');

    Route::get('admin/request/return', 'Admin\ReturnController@showReturnRequest')->name('admin.request.return');

    Route::get('admin/approve/request/{id}', 'Admin\ReturnController@approveRequest')->name('admin.approve.request');
    Route::get('admin/return/lists', 'Admin\ReturnController@showReturnedLists')->name('admin.returned.lists');

    Route::get('admin/message/lists', 'ContactController@showMessageLists')->name('admin.message.lists');

});
