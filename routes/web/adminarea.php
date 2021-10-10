<?php

declare(strict_types=1);

Route::domain('{routeDomain}')->group(function () {
    Route::name('adminarea.')
         ->namespace('Cortex\Categories\Http\Controllers\Adminarea')
         ->middleware(['web', 'nohttpcache', 'can:access-adminarea'])
         ->prefix(route_prefix('adminarea'))->group(function () {

        // Categories Routes
             Route::name('cortex.categories.categories.')->prefix('categories')->group(function () {
                 Route::match(['get', 'post'], '/')->name('index')->uses('CategoriesController@index');
                 Route::get('import')->name('import')->uses('CategoriesController@import');
                 Route::post('import')->name('stash')->uses('CategoriesController@stash');
                 Route::post('hoard')->name('hoard')->uses('CategoriesController@hoard');
                 Route::get('import/logs')->name('import.logs')->uses('CategoriesController@importLogs');
                 Route::get('create')->name('create')->uses('CategoriesController@create');
                 Route::post('create')->name('store')->uses('CategoriesController@store');
                 Route::get('{category}')->name('show')->uses('CategoriesController@show');
                 Route::get('{category}/edit')->name('edit')->uses('CategoriesController@edit');
                 Route::put('{category}/edit')->name('update')->uses('CategoriesController@update');
                 Route::match(['get', 'post'], '{category}/logs')->name('logs')->uses('CategoriesController@logs');
                 Route::delete('{category}')->name('destroy')->uses('CategoriesController@destroy');
             });
         });
});
