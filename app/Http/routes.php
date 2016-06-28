<?php

Route::group(['middleware' => ['web']], function () {

    /*
    |---------------------------------------------------------------------------
    | Authentication
    |---------------------------------------------------------------------------
    */
    Route::get('login', 'AuthController@login');
    Route::get('login/github', 'AuthController@loginCallback');
    Route::get('logout', 'AuthController@logout');

    /*
    |---------------------------------------------------------------------------
    | Pages
    |---------------------------------------------------------------------------
    */
    Route::get('/', 'Pages@home');
    Route::get('mentors', 'Pages@mentors');
    Route::get('mentors/add', ['middleware' => 'admin', 'uses' => 'Pages@mentors_add']);
    Route::get('mentors/edit', function () { return redirect('mentors'); });
    Route::get('mentors/edit/{id}', ['middleware' => 'mentor', 'uses' => 'Pages@mentors_edit']);
    Route::get('learn', 'Pages@learn');
    Route::get('learn/enroll', 'Pages@enroll');
    Route::get('hire', 'Pages@hire');
    Route::get('hire/graduates', 'Pages@graduates');
    Route::get('hire/graduates/add', ['middleware' => 'admin', 'uses' => 'Pages@graduates_add']);
    Route::get('hire/graduates/edit', function () { return redirect('hire/graduates'); });
    Route::get('hire/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Pages@graduates_edit']);

    /*
    |---------------------------------------------------------------------------
    | Forms
    |---------------------------------------------------------------------------
    */
    Route::post('learn', 'Forms@register');
    Route::post('learn/enroll', 'Forms@enroll');
    Route::post('mentors', 'Forms@mentor');
    Route::post('hire', 'Forms@hire');
    Route::post('mentors/add', ['middleware' => 'admin', 'uses' => 'Forms@mentor_add']);
    Route::put('mentors/edit/{id}', ['middleware' => 'mentor', 'uses' => 'Forms@mentor_edit']);
    Route::post('hire/graduates/add', ['middleware' => 'admin', 'uses' => 'Forms@graduate_add']);
    Route::put('hire/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Forms@graduate_edit']);

    /*
    |---------------------------------------------------------------------------
    | API
    |---------------------------------------------------------------------------
    */
    Route::get('api/content', function(){ return App\Content::all(); });
    Route::put('api/content', ['middleware' => 'admin', function() {
        App\Content::updateOrCreate(['key' => Request::input('key')], Request::all());
    }]);
    Route::put('api/content/create', ['middleware' => 'admin', 'uses' => 'Api@create']);
    Route::delete('api/content', ['middleware' => 'admin', function() {
        App\Content::where('key', Request::input('key'))->delete();
    }]);
});
