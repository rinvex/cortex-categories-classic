<?php

declare(strict_types=1);

use Cortex\Categories\Http\Controllers\Adminarea\CategoriesController;

Route::domain('{adminarea}')->group(function () {
    Route::name('adminarea.')
         ->middleware(['web', 'nohttpcache', 'can:access-adminarea'])
         ->prefix(route_prefix('adminarea'))->group(function () {

        // Categories Routes
             Route::name('cortex.categories.categories.')->prefix('categories')->group(function () {
                 Route::match(['get', 'post'], '/')->name('index')->uses([CategoriesController::class, 'index']);
                 Route::post('import')->name('import')->uses([CategoriesController::class, 'import']);
                 Route::get('create')->name('create')->uses([CategoriesController::class, 'create']);
                 Route::post('create')->name('store')->uses([CategoriesController::class, 'store']);
                 Route::get('{category}')->name('show')->uses([CategoriesController::class, 'show']);
                 Route::get('{category}/edit')->name('edit')->uses([CategoriesController::class, 'edit']);
                 Route::put('{category}/edit')->name('update')->uses([CategoriesController::class, 'update']);
                 Route::match(['get', 'post'], '{category}/logs')->name('logs')->uses([CategoriesController::class, 'logs']);
                 Route::delete('{category}')->name('destroy')->uses([CategoriesController::class, 'destroy']);

                 Route::name('ajax.')->prefix('ajax')->group(function () {
                     Route::get('{category}/children')->name('get.children')->uses([CategoriesController::class, 'nodeChildren']);
                     Route::post('{category}/update-position')->name('update.position')->uses([CategoriesController::class, 'updateNodePosition']);
                 });
             });
         });
});
