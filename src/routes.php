<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Sandbox\Webpack\Http\Controllers')
    ->group(function ($routes) {
        Route::get('/webpack-asset.js', 'AssetsController@js');
        Route::get('/webpack-asset.css', 'AssetsController@css');
    });

