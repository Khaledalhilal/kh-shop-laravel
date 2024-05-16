<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BrandController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\CouponController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\GeneralController;
use App\Http\Controllers\Front\detailsController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\SubCategoryController;
use App\Http\Controllers\Front\addToCartController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\checkOutController;
use App\Http\Controllers\Front\getCoupon;
use App\Http\Controllers\Front\HeaderController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\wishlistController;
use App\Http\Controllers\Common\OrderController;
use App\Http\Controllers\Front\ClientController;
use App\Http\Controllers\Front\LiveSearchController;
use App\Http\Controllers\Front\profileController;
use App\Models\Back\Product;
use Illuminate\Support\Facades\Route;
// ? Back
Route::get('/', [DashboardController::class, 'index'])->name("back.dashboard");
Route::resource('categories', CategoryController::class);
Route::resource('subCategories', SubCategoryController::class);
Route::resource('brands', BrandController::class);
Route::resource('products', ProductController::class);
Route::delete('/products/image/{id}', [ProductController::class, 'destroyImage'])->name('products.destroyImage');
Route::resource('coupons', CouponController::class);
// Route::get('coupon/all/Info/{id}', [CouponController::class, 'show'])->name('coupon.show');
Route::resource('orders', OrderController::class);
Route::get('orders/Details/{id}',[OrderController::class, 'orderAddress'])->name('order.address');
Route::get('general/info/', [GeneralController::class, 'index'])->name('general.index');
Route::put('general/info/updateLandingImage/{id}', [GeneralController::class, 'updateLandingImage'])->name('general.updateLandingImage');
Route::post('general/updateContactInfo/{id}', [GeneralController::class, 'updateContactInfo'])->name('general.updateContactInfo');

Route::get('admin/SignIn/', [AdminController::class, 'index'])->name('admin.index');
Route::post('CheckAdminSignIn/', [AdminController::class, 'CheckAdminSignIn'])->name('admin.check');
Route::delete('CheckAdminSignIn/{id}', [AdminController::class, 'destroyAdminSession'])->name('admin.logout');


// Route::resource('users/', UserController::class);


//? front
Route::PUT('address/update/{id}', [AddressController::class, 'update'])->name('address.update');
Route::get('user/SignIn/', [ClientController::class, 'index'])->name('client.index');
Route::post('CheckClientSignIn/', [ClientController::class, 'CheckClientSignIn'])->name('client.check');
Route::delete('destroyClientSession/{id}', [ClientController::class, 'destroyClientSession'])->name('client.logout');
// <-------------------------------------------------------------------->
Route::get('user/SignUp/', [ClientController::class, 'signUp'])->name('client.signUp');
Route::post('add/new/user/', [ClientController::class, 'SignUpNewClient'])->name('client.create');
Route::delete('destroyClientSession/{id}', [ClientController::class, 'destroyClientSession'])->name('client.logout');
// <-------------------------------------------------------------------->
Route::resource('home', HomeController::class);
// <-------------------------------------------------------------------->
Route::get('details/info/{id}', [DetailsController::class, 'showDetailsByProduct'])->name('detailsByProduct');
// <-------------------------------------------------------------------->
Route::get('shop/category/{id}/', [ShopController::class, 'shopByCategory'])->name('shopByCategory.allInfo');
Route::get('shop/subCategory/{id}', [ShopController::class, 'shopBySubCategory'])->name('shopBySubCategory.allInfo');
Route::get('shop/all/{id}', [ShopController::class, 'index'])->name('shop.index');
// <-------------------------------------------------------------------->
Route::post('addToCart/', [addToCartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('deleteFromCart/', [CartController::class, 'deleteFromCart'])->name('cart.deleteFromCart');
Route::get('cart/all/info', [CartController::class, 'index'])->name('cart.all.info');
Route::post('cart/update/', [CartController::class, 'update'])->name('cart.update');
// <-------------------------------------------------------------------->
Route::post('coupon/check/', [getCoupon::class, 'CheckCoupon'])->name('coupon.CheckCoupon');
Route::get('coupon/show/', [getCoupon::class, 'show'])->name('coupon.show');
// <-------------------------------------------------------------------->
Route::post('check/', [checkOutController::class, 'proceedToCheckout'])->name('checkOut.proceedToCheckout');
Route::get('checkout/all/', [checkOutController::class, 'index'])->name('checkout.index');
// <-------------------------------------------------------------------->
Route::get('wishlist/', [wishlistController::class, 'index'])->name('wishlist.index');
Route::post('wishlist/add/', [wishlistController::class, 'store'])->name('wishlist.store');
Route::post('placeOrder/', [OrderController::class, 'store'])->name('order.store');
Route::put('/update-order-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('update.order.status');
Route::delete('wishlist/delete/{id}', [wishlistController::class, 'destroy'])->name('wishlist.destroy');
// <-------------------------------------------------------------------->
Route::get('profile/all-info/', [profileController::class, 'index'])->name('profile.index');
Route::get('admin/profile/all-info/', [profileController::class, 'adminProfile'])->name('profile.admin');
Route::PUT('profile/update/', [profileController::class, 'update'])->name('profile.update');
Route::PUT('admin/profile/update/', [profileController::class, 'updateAdminProfile'])->name('profile.adminUpdate');
Route::get('admin/change_pass/', [profileController::class, 'getAdminPassword'])->name('profile.adminChangePassword');
Route::PUT('admin/change_pass/update', [profileController::class, 'changeAdminPassword'])->name('profile.updateAdminPassword');
//  <-------------------------------------------------------------------->
//todo  <------------------------Live Search-------------------------------------------->
Route::get('search/',[LiveSearchController::class, 'index'])->name('search.index');
//todo  <-------------------------------------------------------------------->
