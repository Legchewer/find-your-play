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

    Route::get('/language/{lang}', function($lang)
    {

        Session::put('my.locale', $lang);


         return Redirect::back();

    });

    Route::get('/index',['as' => 'web.index',function()
    {
        return View::make('web.index');
    }]);

    Route::get('/about',function()
    {
        return View::make('web.overons');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/register',function()
        {
            if (App::getLocale() == 'nl')
            {
                $roles = DB::table('roles')->where('role_id','!=',1)->lists('role_name_nl','role_id');

            }
            else
            {
                $roles = DB::table('roles')->where('role_id','!=',1)->lists('role_name_en','role_id');

            }

            return View::make('web.registreren',compact('roles'));
        });

        Route::post('/register',['as' => 'web.register', 'uses' => 'UserController@register']);

        Route::get('/profile',function()
        {
            $user = Auth::user()->person;
            return View::make('web.profiel', ['user' => $user]);
        });

        Route::post('/profile',['as' => 'web.edit','uses' => 'UserController@edit']);

    });

    Route::get('/search',function()
    {
        if (App::getLocale() == 'nl')
        {
            $game_kinds = DB::table('game_kinds')->where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = DB::table('game_difficulties')->lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = DB::table('themes')->where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = DB::table('game_function_categories')->lists('game_function_category_name_nl','game_function_category_id');
            $game_players = DB::table('game_has_players')->lists('game_players_name_nl','game_players_id');
            $game_age = DB::table('games')->groupBy('game_age_nl')->lists('game_age_nl');
        }
        else
        {
            $game_kinds = DB::table('game_kinds')->where('game_kind_name_en','!=','')->lists('game_kind_name_en','game_kind_id');
            $game_difficulties = DB::table('game_difficulties')->lists('game_difficulty_name_en','game_difficulty_id');
            $game_themes = DB::table('themes')->where('theme_name_en','!=','')->lists('theme_name_en','theme_id');
            $game_functions = DB::table('game_function_categories')->lists('game_function_category_name_en','game_function_category_id');
            $game_players = DB::table('game_has_players')->lists('game_players_name_en','game_players_id');
            $game_age = DB::table('games')->groupBy('game_age_en')->lists('game_age_en');
        }

        $game_producer = DB::table('games')->groupBy('game_producer')->lists('game_producer');
        $game_budget = DB::table('budget_groups')->lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'));
    });

    Route::post('/search',['as' => 'web.search','uses' => 'SearchController@NameSearch']);

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
     * Change language
     */
    Route::get('/language/{lang}', ['as'   => 'admin.dashboard', function($lang)
    {

        Session::put('my.locale', $lang);

        if (Auth::check()){
            return Redirect::to('admin/dashboard');
        } else {
            return Redirect::to('/');
        }

    }
    ]);

    /*
     * Dashboard
     */
    Route::get('/dashboard', ['as'   => 'admin.dashboard', 'uses' => 'AdminDashboardController@index'])
        ->before('auth-admin');

    /*
     * Games
     */
    Route::get('/games', ['as'   => 'admin.games', 'uses' => 'AdminGameController@index'])
        ->before('auth-admin');

    // hard delete theme
    Route::get('/games/destroy/{id}', ['as' => 'admin.games.destroy', 'uses' => 'AdminGameController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Themes
     */

    // themes list
    Route::get('/themes', ['as'   => 'admin.themes', 'uses' => 'AdminThemeController@index'])
        ->before('auth');

    // add theme form
    Route::get('/themes/create', ['as' => 'admin.themes.create', 'uses' => 'AdminThemeController@create'])
        ->before('auth');

    // store new theme
    Route::post('/themes/store', ['as' => 'admin.themes.store', 'uses' => 'AdminThemeController@store'])
        ->before('auth','csrf');

    // hard delete theme
    Route::get('/themes/destroy/{id}', ['as' => 'admin.themes.destroy', 'uses' => 'AdminThemeController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Functions
     */

    // functions list
    Route::get('/functions', ['as'   => 'admin.functions', 'uses' => 'AdminGameFunctionController@index'])
        ->before('auth');

    // hard delete function
    Route::get('/functions/destroy/{id}', ['as' => 'admin.functions.destroy', 'uses' => 'AdminGameFunctionController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Function categories
     */

    // categories list
    Route::get('/categories', ['as'   => 'admin.categories', 'uses' => 'AdminGameFunctionCategoryController@index'])
        ->before('auth');

    // hard delete category
    Route::get('/categories/destroy/{id}', ['as' => 'admin.categories.destroy', 'uses' => 'AdminGameFunctionController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Game kinds
     */

    // game kinds list
    Route::get('/kinds', ['as'   => 'admin.kinds', 'uses' => 'AdminGameKindController@index'])
        ->before('auth');

    // hard delete kind
    Route::get('/kinds/destroy/{id}', ['as' => 'admin.kinds.destroy', 'uses' => 'AdminGameKindController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Game types
     */

    // game types list
    Route::get('/types', ['as'   => 'admin.types', 'uses' => 'AdminGameTypeController@index'])
        ->before('auth');

    // hard delete type
    Route::get('/types/destroy/{id}', ['as' => 'admin.types.destroy', 'uses' => 'AdminGameTypeController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Game difficulties
     */

    // game difficulties list
    Route::get('/difficulties', ['as'   => 'admin.difficulties', 'uses' => 'AdminGameDifficultyController@index'])
        ->before('auth');

    // hard delete difficulties
    Route::get('/difficulties/destroy/{id}', ['as' => 'admin.difficulties.destroy', 'uses' => 'AdminGameDifficultyController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    /*
     * Budget groups
     */

    // budget groups list
    Route::get('/budget-groups', ['as'   => 'admin.budgetgroups', 'uses' => 'AdminBudgetGroupController@index'])
        ->before('auth');

    // hard delete budget group
    Route::get('/budget-groups/destroy/{id}', ['as' => 'admin.budgetgroups.destroy', 'uses' => 'AdminThemeController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // FEEDBACK ANDERS DOEN (geen tabel)

});

Route::get('/404', ['as' => '404', function()
{
    return View::make('404');

}
]);