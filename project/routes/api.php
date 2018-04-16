<?php

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', 'CategoryController')->name('index');
});
