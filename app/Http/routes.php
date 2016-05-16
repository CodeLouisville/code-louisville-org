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
    Route::get('candidates', 'Pages@candidates');
    Route::get('candidates/enroll', 'Pages@enroll');
    Route::get('employers', 'Pages@employers');
    Route::get('employers/graduates', 'Pages@graduates');
    Route::get('employers/graduates/add', ['middleware' => 'admin', 'uses' => 'Pages@graduates_add']);
    Route::get('employers/graduates/edit', function () { return redirect('employers/graduates'); });
    Route::get('employers/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Pages@graduates_edit']);

    /*
    |---------------------------------------------------------------------------
    | Forms
    |---------------------------------------------------------------------------
    */
    Route::post('candidates', 'Forms@register');
    Route::post('candidates/enroll', 'Forms@enroll');
    Route::post('mentors', 'Forms@mentor');
    Route::post('employers', 'Forms@employer');
    Route::post('mentors/add', ['middleware' => 'admin', 'uses' => 'Forms@mentor_add']);
    Route::put('mentors/edit/{id}', ['middleware' => 'mentor', 'uses' => 'Forms@mentor_edit']);
    Route::post('employers/graduates/add', ['middleware' => 'admin', 'uses' => 'Forms@graduate_add']);
    Route::put('employers/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Forms@graduate_edit']);

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
