<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
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
    abort(404);
});

require __DIR__.'/admin.php';

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

// Dashboard (must keep)
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Frontend Routes (OriginSpaces showcase theme)
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/collections', [FrontendController::class, 'collections'])->name('collections');
Route::get('/product/{slug}', [FrontendController::class, 'productShow'])->name('product.show');

Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');

Route::get('/sitemap.xml', function () {
    $products = \App\Models\Product::where('status', true)->get();
    $urls = [
        url('/'),
        url('/about'),
        url('/collections'),
        url('/gallery'),
        url('/contact'),
        url('/privacy-policy'),
        url('/terms-of-service'),
    ];
    foreach ($products as $p) {
        $urls[] = url('/product/' . $p->slug);
    }
    $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $url) {
        $xml .= '<url><loc>' . htmlspecialchars($url, ENT_XML1, 'UTF-8') . '</loc></url>';
    }
    $xml .= '</urlset>';
    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// Debug Routes
Route::get('/debug/products', [FrontendController::class, 'debugProducts'])->name('debug.products');

// Static Pages
Route::get('/privacy-policy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [FrontendController::class, 'terms'])->name('terms');
