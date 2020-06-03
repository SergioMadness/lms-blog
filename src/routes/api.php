<?php

use professionalweb\LMS\Blog\Interfaces\ApiMethods;

Route::group(['prefix' => 'api/v2'], function () {
    Route::group(['namespace' => 'professionalweb\LMS\Blog\Http\Controllers\B2B', 'prefix' => 'b2b', 'middleware' => ['api-b2b']], function () {
        Route::get(ApiMethods::API_METHOD_BLOG_LIST, 'BlogController@index');
        Route::get(ApiMethods::API_METHOD_GET_BLOG, 'BlogController@view');
        Route::post(ApiMethods::API_METHOD_STORE_BLOG, 'BlogController@store');
        Route::match(['post', 'patch', 'put'], ApiMethods::API_METHOD_UPDATE_BLOG, 'BlogController@update');
        Route::delete(ApiMethods::API_METHOD_REMOVE_BLOG, 'BlogController@destroy');
    });

    Route::group(['namespace' => 'professionalweb\LMS\Blog\Http\Controllers\B2C', 'middleware' => ['api']], function () {
        Route::get(ApiMethods::API_METHOD_BLOG_LIST, 'BlogController@index');
        Route::get(ApiMethods::API_METHOD_GET_BLOG, 'BlogController@view');
    });
});