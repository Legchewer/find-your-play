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

    Route::get('/', ['as' => 'web.index', function()
    {
        /*if (Auth::check()){
            return Redirect::to('admin/dashboard');
        } else {
            return Redirect::to('admin/login');
        }*/
        return View::make('index');

    }
    ]);

});

// ADMIN ROUTE GROUP

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', ['as' => 'admin.root', function()
    {
        /*if (Auth::check()){
            return Redirect::to('admin/dashboard');
        } else {
            return Redirect::to('admin/login');
        }*/
        return Redirect::to('admin/dashboard');

    }
    ]);

    Route::get('/login', ['as' => 'login', function()
    {
        //return View::make('login');

    }
    ]);

    /*
     * Authentication
     *
    Route::post('/auth', ['as'   => 'admin.auth', 'uses' => 'UserController@auth'])
        ->before('guest');

    /*
     * Logout
     *
    Route::get('/logout', ['as'   => 'admin.logout',
        function () {

            Auth::logout();

            return Redirect::to('/');
        }
    ])->before('auth');

    /*
     * Dashboard
     */
    Route::get('/dashboard', ['as'   => 'admin.dashboard', 'uses' => 'DashboardController@index']);
        //->before('auth');

});

Route::get('/login', ['as' => 'login', function()
{
    return View::make('login');

}
]);

/*Route::get('/404', ['as' => '404', function()
{
    return View::make('404');

}
]);

Route::get('/info', ['as' =>'info', function()
{

    return View::make('info');
}
]);*/

/*
 * Change language
 *
Route::get('/language/{lang}', ['as'   => 'admin.dashboard', function($lang)
{
    //App::setLocale($lang); // niet persistent
    //return View::make('admin/dashboard');

    Session::put('my.locale', $lang);

    if (Auth::check()){
        return Redirect::to('admin/dashboard');
    } else {
        return Redirect::to('/');
    }

}
]);*/
