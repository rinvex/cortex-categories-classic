<?php

declare(strict_types=1);

Route::domain(domain())->group(function () {
    Route::name('adminarea.')
         ->namespace('Cortex\Categories\Http\Controllers\Adminarea')
         ->middleware(['web', 'nohttpcache', 'can:access-adminarea'])
         ->prefix(config('cortex.foundation.route.locale_prefix') ? '{locale}/'.config('cortex.foundation.route.prefix.adminarea') : config('cortex.foundation.route.prefix.adminarea'))->group(function () {

        // Categories Routes
             Route::name('categories.')->prefix('categories')->group(function () {
                 Route::get('/')->name('index')->uses('CategoriesController@index');
                 Route::get('import')->name('import')->uses('CategoriesController@import');
                 Route::post('import')->name('stash')->uses('CategoriesController@stash');
                 Route::post('hoard')->name('hoard')->uses('CategoriesController@hoard');
                 Route::get('import/logs')->name('import.logs')->uses('CategoriesController@importLogs');
                 Route::get('create')->name('create')->uses('CategoriesController@form');
                 Route::post('create')->name('store')->uses('CategoriesController@store');
                 Route::get('{category}')->name('show')->uses('CategoriesController@show');
                 Route::get('{category}/edit')->name('edit')->uses('CategoriesController@form');
                 Route::put('{category}/edit')->name('update')->uses('CategoriesController@update');
                 Route::get('{category}/logs')->name('logs')->uses('CategoriesController@logs');
                 Route::delete('{category}')->name('destroy')->uses('CategoriesController@destroy');
             });
         });
});
