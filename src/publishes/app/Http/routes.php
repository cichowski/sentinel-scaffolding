<?php
/*
|--------------------------------------------------------------------------
| Sentinel Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Sentinel'], function()
{        
    /**
     * These routes exists only for not logged in users
     */
    Route::group(['middleware' => ['web', 'guest']], function () 
    {  
        Route::get('/login', array(
            'as' => 'auth.login',             
            'uses' => 'AuthController@login'
        )); 
        
        Route::get('/init', array(
            'as' => 'auth.init',             
            'uses' => 'AuthController@init'
        ));         

        //This action is throttled by the controller
        Route::post('/login', array(
            'as' => 'auth.login_request',             
            'uses' => 'AuthController@processLogin'
        ));    

        Route::get('/register', array(
            'as' => 'auth.register',             
            'uses' => 'AuthController@register'
        ));

        Route::post('/register', array(
            'as' => 'auth.register_request',             
            'uses' => 'AuthController@processRegistration'
        ));

        Route::get('/password/retrieve', array(
            'as' => 'password.retrieve',             
            'uses' => 'PasswordController@retrieve'
        ));

        Route::post('/password/retrieve', array(
            'as' => 'password.retrieve_request',             
            'uses' => 'PasswordController@sendRetrieveLink'
        ));   
    });

    /**
     * These routes are sensitive and should be throttled
     */
    Route::group(['middleware' => ['web', 'guest', 'throttle:15,1']], function () 
    {              
        Route::get('/activate/{user_id}/{code}', array(
            'as' => 'auth.activate',             
            'uses' => 'AuthController@activate'
        ));        

        Route::get('/password/set/{user_id}/{code}', array(
            'as' => 'password.create',             
            'uses' => 'PasswordController@create'
        ));

        Route::post('/password/set', array(
            'as' => 'password.store',             
            'uses' => 'PasswordController@store'
        ));
    });

    /**
     * Any user can log out
     */
    Route::group(['middleware' => ['web']], function () 
    {
        Route::get('/logout', array(
            'as' => 'auth.logout',             
            'uses' => 'AuthController@logout'
        )); 
    });
});    