<?php

  use Illuminate\Http\Request;

  Route::get('/ext/auth', function(Request $request) {
    return Syncad::login($request->token);
  });

  Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {
      Route::post('connection/test', function(Request $request){
        return Syncad::testConnection($request->key);
      });

      Route::group(['middleware' => ['syncad']], function(){
        Route::post('login/init', 'SyncadController@pokesLogin');

        Route::post('make/user', 'SyncadController@makeUser');
      });
    });
  });