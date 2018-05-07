<?php

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', 'CategoryController')->name('index');
});

Route::prefix('advertisement')->name('advertisement.')->group(function () {
    Route::get('/', 'AdvertisementController@index')->name('index');
});
