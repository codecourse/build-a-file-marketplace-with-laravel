<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileShowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCreateController;
use App\Http\Controllers\ProductEditController;
use App\Http\Controllers\ProductIndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleShowController;
use App\Http\Controllers\StripeOnboardingController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\Subdomain\SubdomainHomeController;
use App\Http\Controllers\Subdomain\SubdomainProductCheckoutController;
use App\Http\Controllers\Subdomain\SubdomainProductCheckoutSuccessController;
use App\Http\Controllers\Subdomain\SubdomainProductShowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::domain('{user:subdomain}.' . config('app.url'))->name('subdomain.')->group(function () {
    Route::get('/', SubdomainHomeController::class)->name('home');
    Route::get('/{product:slug}', SubdomainProductShowController::class)->name('products.show');
    Route::post('/{product:slug}/checkout', SubdomainProductCheckoutController::class)->name('products.checkout');
    Route::get('/{product:slug}/checkout/success', SubdomainProductCheckoutSuccessController::class)->name('products.checkout.success');
});

Route::get('/', HomeController::class)->name('home');

Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::get('/products', ProductIndexController::class)->name('products');
Route::get('/products/create', ProductCreateController::class)->name('products.create');
Route::get('/products/{product}/edit', ProductEditController::class)->name('products.edit');

Route::get('/sales/{sale:token}', SaleShowController::class)->name('sales.show');

Route::get('/files/{file}', FileShowController::class)->name('files.show');

Route::post('/webhooks/stripe', StripeWebhookController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
