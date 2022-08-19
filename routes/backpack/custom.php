<?php

use App\Http\Controllers\Admin\MagasinCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('magasin', 'MagasinCrudController');
    Route::crud('contact', 'ContactCrudController');
    Route::crud('section', 'SectionCrudController');
    Route::crud('publication', 'PublicationCrudController');
    Route::post('shop-update', [MagasinCrudController::class, 'updateShop'])->name('shop.update');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file