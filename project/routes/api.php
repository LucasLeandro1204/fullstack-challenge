<?php

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', 'CategoryController')->name('index');
});

Route::prefix('advertisement')->name('advertisement.')->group(function () {
    Route::get('/{category?}', 'AdvertisementController@index')->name('index');
});
