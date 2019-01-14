<?php

Route::group([
    'middleware' => ['web', 'laracms.auth'],
    'namespace'  => 'Grundmanis\Laracms\Modules\Shop\Controllers',
    'prefix'     => 'laracms/'
], function () {
    Route::get('customers', 'BuyerController@index')->name('laracms.customers');
    Route::get('customers/edit/{user}', 'BuyerController@edit')->name('laracms.customers.edit');
    Route::post('customers/edit/{user}', 'BuyerController@update');
    Route::get('customers/destroy/{user}', 'BuyerController@destroy')->name('laracms.customers.destroy');

    Route::get('shops', 'ShopController@index')->name('laracms.shops');
    Route::get('shops/{shop}/products', 'ShopController@products')->name('laracms.shops.products');
    Route::get('shops/edit/{shop}', 'ShopController@edit')->name('laracms.shops.edit');
    Route::post('shops/edit/{shop}', 'ShopController@update');
    Route::get('shops/destroy/{shop}', 'ShopController@destroy')->name('laracms.shops.destroy');

    Route::get('orders', 'OrderController@index')->name('laracms.orders');
    Route::get('orders/{order}/items', 'OrderController@items')->name('laracms.orders.items');

    Route::get('reviews', 'ReviewController@index')->name('laracms.reviews');
    Route::get('reviews/destroy/{review}', 'ReviewController@destroy')->name('laracms.reviews.destroy');
    Route::get('reviews/edit/{review}', 'ReviewController@edit')->name('laracms.reviews.edit');
    Route::post('reviews/edit/{review}', 'ReviewController@update');

    Route::get('categories', 'CategoryController@index')->name('laracms.categories');
    Route::get('categories/create', 'CategoryController@create')->name('laracms.categories.create');
    Route::post('categories/create', 'CategoryController@store');
    Route::get('categories/edit/{category}', 'CategoryController@edit')->name('laracms.categories.edit');
    Route::post('categories/edit/{category}', 'CategoryController@update');
    Route::get('categories/destroy/{category}', 'CategoryController@destroy')->name('laracms.categories.destroy');

    Route::get('fields', 'FieldController@index')->name('laracms.fields');
    Route::get('fields/create', 'FieldController@create')->name('laracms.fields.create');
    Route::post('fields/create', 'FieldController@store');
    Route::get('fields/edit/{field}', 'FieldController@edit')->name('laracms.fields.edit');
    Route::post('fields/edit/{field}', 'FieldController@update');
    Route::get('fields/destroy/{field}', 'FieldController@destroy')->name('laracms.fields.destroy');
});