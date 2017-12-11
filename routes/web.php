<?php

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
Route::get('mentor', 'Pages@mentor');
Route::get('mentor/add', ['middleware' => 'admin', 'uses' => 'Pages@mentor_add']);
Route::get('mentor/edit', function () {
    return redirect('mentor');
});
Route::get('mentor/edit/{id}', ['middleware' => 'mentor', 'uses' => 'Pages@mentor_edit']);
Route::get('learn', 'Pages@learn');
Route::get('learn/apply', 'Pages@apply');
Route::get('hire', 'Pages@hire');
Route::get('hire/graduates', 'Pages@graduates');
Route::get('hire/graduates/add', ['uses' => 'Pages@graduates_add']);
Route::get('hire/graduates/edit', function () {
    return redirect('hire/graduates');
});
Route::get('hire/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Pages@graduates_edit']);

/*
|---------------------------------------------------------------------------
| Forms
|---------------------------------------------------------------------------
*/
Route::post('learn', 'Forms@register');
Route::post('learn/apply', 'Forms@apply');
Route::post('mentor', 'Forms@mentor');
Route::post('hire', 'Forms@hire');
Route::post('mentor/add', ['middleware' => 'admin', 'uses' => 'Forms@mentor_add']);
Route::put('mentor/edit/{id}', ['middleware' => 'mentor', 'uses' => 'Forms@mentor_edit']);
Route::post('hire/graduates/add', ['middleware' => 'admin', 'uses' => 'Forms@graduate_add']);
Route::put('hire/graduates/edit/{id}', ['middleware' => 'admin', 'uses' => 'Forms@graduate_edit']);

/*
|---------------------------------------------------------------------------
| API
|---------------------------------------------------------------------------
*/
Route::get('api/content', function () {
    return App\Content::all();
});
Route::put('api/content', ['middleware' => 'admin', function () {
    App\Content::updateOrCreate(['key' => Request::input('key')], Request::all());
}]);
Route::put('api/content/create', ['middleware' => 'admin', 'uses' => 'Api@create']);
Route::delete('api/content', ['middleware' => 'admin', function () {
    App\Content::where('key', Request::input('key'))->delete();
}]);

// Example Usage: /api/enrollments/exists?email=youremail@gmail.com
Route::get('api/enrollments/exists', function () {
    // check if one or more submissions have been made with the email
    if (App\Enrollments::where("email", Input::get("email"))->count() >= 1) {
        return response()->json(['exists' => true]); // found submissions
    } else {
        return response()->json(['exists' => false]); // no submissions
    }
});
