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

if (config('app.env') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@home')->name('home');
Route::get('user/logout', 'HomeController@logout')->name('user.logout');

Auth::routes(['verify' => true]);

Route::get('password/change', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword')->name('update.password');

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
Route::get('admin/subcategories', 'Admin\Category\SubcategoryController@subcategory')->name('subcategories');
Route::post('admin/store/subcategory', 'Admin\Category\SubcategoryController@storeSubcategory')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\SubcategoryController@deleteSubcategory')->name('delete.subcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\SubcategoryController@editSubcategory')->name('edit.subcategory');
Route::post('update/subcategory/{id}', 'Admin\Category\SubcategoryController@updateSubcategory')->name('update.subcategory');

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

// Admin article route
Route::get('article/category/list', 'Admin\PostController@articleCategoryList')->name('index.article.category');
Route::post('article/category/list', 'Admin\PostController@storeArticleCategory')->name('store.article.category');
Route::get('delete/article/category/{id}', 'Admin\PostController@deleteArticleCategory')->name('delete.article.category');
Route::get('edit/article/category/{id}', 'Admin\PostController@editArticleCategory')->name('edit.article.category');
Route::post('update/article/category/{id}', 'Admin\PostController@updateArticleCategory')->name('update.article.category');

Route::get('index/article/post', 'Admin\PostController@indexPost')->name('index.article.post');
Route::get('create/article/post', 'Admin\PostController@createPost')->name('create.article.post');
Route::post('store/article/post', 'Admin\PostController@storeArticlePost')->name('store.article.post');
Route::get('delete/post/{id}', 'Admin\PostController@deletePost')->name('delete.post');
Route::get('edit/post/{id}', 'Admin\PostController@editPost')->name('edit.post');
Route::post('update/post/{id}', 'Admin\PostController@updatePost')->name('update.post');

// Wish List Route
Route::get('add/wishlist/{id}', 'WishListController@addWishList');
Route::get('delete/wish/list/{id}', 'WishListController@deleteWishlist')->name('delete.wish.list');
Route::get('user/wishlist', 'WishListController@showWishlists')->name('user.wishlist');

// Cart Route
Route::get('add/cart/{id}', 'CartController@addProductToCart');
Route::get('check/cart', 'CartController@checkCart');
Route::get('show/cart', 'CartController@showCart')->name('show.cart');
Route::get('remove/cart/item/{rowId}', 'CartController@removeCartItem')->name('remove.cart.item');
Route::post('update/cart/item', 'CartController@updateCartItem')->name('update.cart.item');
Route::post('insert/into/cart', 'CartController@addCartFromModal')->name('insert.into.cart');
Route::get('product/checkout', 'CartController@checkoutProduct')->name('checkout.product');

Route::post('apply/coupon', 'CartController@applyCoupon')->name('apply.coupon');
Route::get('remove/coupon', 'CartController@removeCoupon')->name('remove.coupon');

// Products Details Page
Route::get('product/details/{id}/{product_name}', 'ProductController@showProductDetails')->name('product.detail');
Route::post('add/product/cart/{id}', 'ProductController@addProductToCart')->name('add.product.cart');
Route::get('show/category/list/{id}', 'ProductController@showCategoryList')->name('show.category.list');
Route::get('show/subcategory/list/{id}', 'ProductController@showSubCategoryList')->name('show.subcategory.list');

// Blog Post Route
Route::get('index/article', 'ArticleController@showArticles')->name('index.article');
Route::get('show/article/{id}', 'ArticleController@showArticleDetail')->name('show.article');

// Change Language
Route::get('language/japanese', 'ArticleController@changeJapaneseNotation')->name('language.japanese');
Route::get('language/english', 'ArticleController@changeEnglishNotation')->name('language.english');

// Payment Products
Route::get('confirm/page', 'PaymentController@showConfirmPage')->name('confirm.page');
Route::post('payment/stripe', 'PaymentController@payByStripe')->name('payment.stripe');

Route::post('update/profile/info', 'ProfileController@updateProfileInfo')->name('update.profile.info');
Route::get('show/profile/page', 'ProfileController@showProfilePage')->name('show.profile.page');

// Track Order Route
Route::get('order_history/lists', 'ProfileController@showOrderHistoryLists')->name('order_history.lists');
Route::get('tracking/order/{id}', 'ProfileController@showTrackingOrder')->name('tracking.order');

// Return Order Route
Route::get('return/order/lists', 'ProfileController@showReturnLists')->name('return.order.lists');

Route::get('request/return/order/{id}', 'ProfileController@requestReturnOrder')->name('request.return.order');

Route::get('contact/page', 'ContactController@showContactPage')->name('contact.page');
Route::post('contact/form', 'ContactController@sendContactMessage')->name('contact.form');

Route::post('search/item', 'ProductController@searchItem')->name('search.item');

Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');
// Password Reset Routes
Route::get('admin/password/change','AdminController@showChangePasswordForm')->name('admin.password.change');
Route::post('admin/password/change','AdminController@changePassword')->name('admin.update.password');

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
