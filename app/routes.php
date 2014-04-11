<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('web/index');
});

// WEB ROUTE GROUP

Route::group(['prefix' => 'web'], function() {

    Route::get('/index',['as' => 'web.index',function()
    {
        return View::make('web.index');
    }]);

    Route::get('/about',function()
    {
        return View::make('web.overons');
    });

    Route::group(['prefix' => 'gebruiker'], function() {
        Route::get('/registreren',function()
        {
            $roles = DB::table('roles')->where('role_id','!=',1)->lists('role_name_nl','role_id');
            //$roles = DB::table('roles')->lists('role_name_nl','role_id');

            return View::make('web.registreren',compact('roles'));
        });

        Route::post('/registreren',['as' => 'web.register', 'uses' => 'UserController@register']);

        Route::get('/profiel',function()
        {
            $user = Auth::user()->person;
            return View::make('web.profiel', ['user' => $user]);
        });

        Route::post('/profiel',['as' => 'web.edit','uses' => 'UserController@edit']);

    });

    Route::get('/search',function()
    {
        return View::make('web.spelzoeken');
    });

    Route::get('/game',function()
    {
        return View::make('web.speldetail');
    });

    /*
     * Authentication
     */
    Route::post('/auth', ['as'   => 'web.auth', 'uses' => 'UserController@auth'])
        ->before('guest');

    /*
     * Logout
     */
    Route::get('/logout', ['as'   => 'admin.logout',
        function () {

            Auth::logout();

            return Redirect::to('/');
        }
    ])->before('auth-web');

});

// ADMIN ROUTE GROUP

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', ['as' => 'admin.root', function()
    {
        if (Auth::check()){

            return Redirect::to('admin/dashboard');

        } else {

            return Redirect::to('admin/login');
        }

    }
    ]);

    Route::get('/login', ['as' => 'admin.login', function()
    {
        return View::make('admin.login');

    }
    ]);

    /*
     * Authentication
     */
    Route::post('/auth', ['as'   => 'admin.auth', 'uses' => 'AdminMemberController@auth'])
        ->before('guest');

    /*
     * Logout
     */
    Route::get('/logout', ['as'   => 'admin.logout',
        function () {

            Auth::logout();

            return Redirect::to('/');
        }
    ])->before('auth-admin');

    /*
     * Dashboard
     */
    Route::get('/dashboard', ['as'   => 'admin.dashboard', 'uses' => 'AdminDashboardController@index'])
        ->before('auth-admin');

    /*
     * Themes
     */

    // themes list
    Route::get('/themes', ['as'   => 'admin.themes', 'uses' => 'AdminThemeController@index'])
        ->before('auth');

});

Route::get('/404', ['as' => '404', function()
{
    return View::make('404');

}
]);