<?php

declare(strict_types=1);

Route::group(['domain' => domain()], function () {

    Route::name('backend.')
         ->namespace('Cortex\Categorizable\Http\Controllers\Backend')
         ->middleware(['web', 'nohttpcache', 'can:access-dashboard'])
         ->prefix(config('cortex.foundation.route.locale_prefix') ? '{locale}/backend' : 'backend')->group(function () {

        // Categories Routes
        Route::name('categories.')->prefix('categories')->group(function () {
            Route::get('/')->name('index')->uses('CategoriesController@index');
            Route::get('create')->name('create')->uses('CategoriesController@form');
            Route::post('create')->name('store')->uses('CategoriesController@store');
            Route::get('{category}')->name('edit')->uses('CategoriesController@form');
            Route::put('{category}')->name('update')->uses('CategoriesController@update');
            Route::get('{category}/logs')->name('logs')->uses('CategoriesController@logs');
            Route::delete('{category}')->name('delete')->uses('CategoriesController@delete');
        });

    });

});
