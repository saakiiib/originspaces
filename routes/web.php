<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPortalController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    Auth::logout();
    session()->flush();
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return 'Cleared!';
});

Route::fallback(function () {
    return redirect('/');
});

require __DIR__.'/admin.php';

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => false,
]);

// Dashboard (must keep)
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/search/suggestions', [FrontendController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/product/{slug}', [FrontendController::class, 'productShow'])->name('product.show');
Route::post('/product/{id}/review', [FrontendController::class, 'storeReview'])->name('product.review');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');
Route::post('/newsletter/subscribe', [FrontendController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/check', [WishlistController::class, 'check'])->name('wishlist.check');
Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::get('/order/invoice/{id}', [CheckoutController::class, 'invoice'])->name('order.invoice');
Route::get('/checkout/districts', [CheckoutController::class, 'getDistricts'])->name('checkout.districts');
Route::get('/checkout/upazilas', [CheckoutController::class, 'getUpazilas'])->name('checkout.upazilas');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
Route::post('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.remove-coupon');
Route::post('/checkout/track-leave', [CheckoutController::class, 'trackLeave'])->name('checkout.trackLeave')->middleware('auth');

// User Portal
Route::middleware(['auth', 'is_user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [UserPortalController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [UserPortalController::class, 'orderDetail'])->name('order.detail');
    Route::get('/profile', [UserPortalController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserPortalController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/logout', [UserPortalController::class, 'logout'])->name('logout');
});

// Static Pages
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/shipping-policy', [FrontendController::class, 'shipping'])->name('shipping');
Route::get('/return-policy', [FrontendController::class, 'returns'])->name('returns');
Route::get('/privacy-policy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [FrontendController::class, 'terms'])->name('terms');
