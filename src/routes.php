<?php
  Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {
      Route::post('connection/test', 'SyncadController@testConnection');

      Route::group(['middleware' => ['syncad']], function(){
        Route::post('login/init', 'SyncadController@pokesLogin');

        Route::post('make/user', 'SyncadController@makeUser');
      });
    });
  });