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
	return Redirect::to('web');
});

// WEB ROUTE GROUP

Route::group(['prefix' => 'web'], function() {

    Route::get('/language/{lang}', function($lang)
    {

        Session::put('my.locale', $lang);


         return Redirect::back();

    });

    Route::get('/',['as' => 'web.index',function()
    {
        return View::make('web.index');
    }]);

    Route::post('/',['as' => 'web.index.post','uses' => 'SearchController@SearchFormIndex']);

    Route::get('/about',function()
    {
        return View::make('web.overons');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/register',function()
        {
            if (App::getLocale() == 'nl')
            {
                $roles = Role::where('role_id','!=',1)->lists('role_name_nl','role_id');

            }
            else
            {
                $roles = Role::where('role_id','!=',1)->lists('role_name_en','role_id');

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

    Route::get('/search/{string?}',['as' =>'web.search', 'uses' => 'SearchController@FilterIndex']);

    Route::post('/search/{string?}',['as' => 'web.search.post','uses' => 'SearchController@FilterSearch']);

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
     * Members
     */
    Route::get('/members', ['as'   => 'admin.members', 'uses' => 'AdminMemberController@index'])
        ->before('auth-admin');

    // hard delete member
    Route::get('/members/destroy/{id}', ['as' => 'admin.members.destroy', 'uses' => 'AdminMemberController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add member form
    Route::get('/members/create', ['as' => 'admin.members.create', 'uses' => 'AdminMemberController@create'])
        ->before('auth');

    // store new role
    Route::post('/members/store', ['as' => 'admin.members.store', 'uses' => 'AdminMemberController@store'])
        ->before('auth','csrf');

    /*
     * Roles
     */
    Route::get('/roles', ['as'   => 'admin.roles', 'uses' => 'AdminRoleController@index'])
        ->before('auth-admin');

    // hard delete role
    Route::get('/roles/destroy/{id}', ['as' => 'admin.roles.destroy', 'uses' => 'AdminRoleController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add role form
    Route::get('/roles/create', ['as' => 'admin.roles.create', 'uses' => 'AdminRoleController@create'])
        ->before('auth');

    // store new role
    Route::post('/roles/store', ['as' => 'admin.roles.store', 'uses' => 'AdminRoleController@store'])
        ->before('auth','csrf');

    // edit role
    Route::get('/roles/edit/{id}', ['as' => 'admin.roles.edit', 'uses' => 'AdminRoleController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update role
    Route::post('/roles/update/{id}', ['as' => 'admin.roles.update', 'uses' => 'AdminRoleController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

    /*
     * Games
     */
    Route::get('/games', ['as'   => 'admin.games', 'uses' => 'AdminGameController@index'])
        ->before('auth-admin');

    // hard delete theme
    Route::get('/games/destroy/{id}', ['as' => 'admin.games.destroy', 'uses' => 'AdminGameController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add game form
    Route::get('/games/create', ['as' => 'admin.games.create', 'uses' => 'AdminGameController@create'])
        ->before('auth');

    // store new game
    Route::post('/games/store', ['as' => 'admin.games.store', 'uses' => 'AdminGameController@store'])
        ->before('auth','csrf');

    /*
     * Themes
     */

    // themes list
    Route::get('/themes', ['as'   => 'admin.themes', 'uses' => 'AdminThemeController@index'])
        ->before('auth');

    // hard delete theme
    Route::get('/themes/destroy/{id}', ['as' => 'admin.themes.destroy', 'uses' => 'AdminThemeController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add theme form
    Route::get('/themes/create', ['as' => 'admin.themes.create', 'uses' => 'AdminThemeController@create'])
        ->before('auth');

    // store new theme
    Route::post('/themes/store', ['as' => 'admin.themes.store', 'uses' => 'AdminThemeController@store'])
        ->before('auth','csrf');

    // edit theme
    Route::get('/themes/edit/{id}', ['as' => 'admin.themes.edit', 'uses' => 'AdminThemeController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update theme
    Route::post('/themes/update/{id}', ['as' => 'admin.themes.update', 'uses' => 'AdminThemeController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

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

    // add function form
    Route::get('/functions/create', ['as' => 'admin.functions.create', 'uses' => 'AdminGameFunctionController@create'])
        ->before('auth');

    // store new function
    Route::post('/functions/store', ['as' => 'admin.functions.store', 'uses' => 'AdminGameFunctionController@store'])
        ->before('auth','csrf');

    // edit function
    Route::get('/functions/edit/{id}', ['as' => 'admin.functions.edit', 'uses' => 'AdminGameFunctionController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update function
    Route::post('/functions/update/{id}', ['as' => 'admin.functions.update', 'uses' => 'AdminGameFunctionController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

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

    // add function category form
    Route::get('/categories/create', ['as' => 'admin.categories.create', 'uses' => 'AdminGameFunctionCategoryController@create'])
        ->before('auth');

    // store new function category
    Route::post('/categories/store', ['as' => 'admin.categories.store', 'uses' => 'AdminGameFunctionCategoryController@store'])
        ->before('auth','csrf');

    // edit function category
    Route::get('/categories/edit/{id}', ['as' => 'admin.categories.edit', 'uses' => 'AdminGameFunctionCategoryController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update function category
    Route::post('/categories/update/{id}', ['as' => 'admin.categories.update', 'uses' => 'AdminGameFunctionCategoryController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

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

    // add kind form
    Route::get('/kinds/create', ['as' => 'admin.kinds.create', 'uses' => 'AdminGameKindController@create'])
        ->before('auth');

    // store new kind
    Route::post('/kinds/store', ['as' => 'admin.kinds.store', 'uses' => 'AdminGameKindController@store'])
        ->before('auth','csrf');

    // edit kind
    Route::get('/kinds/edit/{id}', ['as' => 'admin.kinds.edit', 'uses' => 'AdminGameKindController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update kind
    Route::post('/kinds/update/{id}', ['as' => 'admin.kinds.update', 'uses' => 'AdminGameKindController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

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

    // add type form
    Route::get('/types/create', ['as' => 'admin.types.create', 'uses' => 'AdminGameTypeController@create'])
        ->before('auth');

    // store new type
    Route::post('/types/store', ['as' => 'admin.types.store', 'uses' => 'AdminGameTypeController@store'])
        ->before('auth','csrf');

    // edit type
    Route::get('/types/edit/{id}', ['as' => 'admin.types.edit', 'uses' => 'AdminGameTypeController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update type
    Route::post('/types/update/{id}', ['as' => 'admin.types.update', 'uses' => 'AdminGameTypeController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

    /*
     * Game Players
     */

    // game players list
    Route::get('/players', ['as'   => 'admin.players', 'uses' => 'AdminGamePlayersController@index'])
        ->before('auth');

    // hard delete players
    Route::get('/players/destroy/{id}', ['as' => 'admin.players.destroy', 'uses' => 'AdminGamePlayersController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add players form
    Route::get('/players/create', ['as' => 'admin.players.create', 'uses' => 'AdminGamePlayersController@create'])
        ->before('auth');

    // store new players
    Route::post('/players/store', ['as' => 'admin.players.store', 'uses' => 'AdminGamePlayersController@store'])
        ->before('auth','csrf');

    // edit players
    Route::get('/players/edit/{id}', ['as' => 'admin.players.edit', 'uses' => 'AdminGamePlayersController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update players
    Route::post('/players/update/{id}', ['as' => 'admin.players.update', 'uses' => 'AdminGamePlayersController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

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

    // add difficulty form
    Route::get('/difficulties/create', ['as' => 'admin.difficulties.create', 'uses' => 'AdminGameDifficultyController@create'])
        ->before('auth');

    // store new difficulty
    Route::post('/difficulties/store', ['as' => 'admin.difficulties.store', 'uses' => 'AdminGameDifficultyController@store'])
        ->before('auth','csrf');

    // edit difficulty
    Route::get('/difficulties/edit/{id}', ['as' => 'admin.difficulties.edit', 'uses' => 'AdminGameDifficultyController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update difficulty
    Route::post('/difficulties/update/{id}', ['as' => 'admin.difficulties.update', 'uses' => 'AdminGameDifficultyController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

    /*
     * Budget groups
     */

    // budget groups list
    Route::get('/budget-groups', ['as'   => 'admin.budgetgroups', 'uses' => 'AdminBudgetGroupController@index'])
        ->before('auth');

    // hard delete budget group
    Route::get('/budget-groups/destroy/{id}', ['as' => 'admin.budgetgroups.destroy', 'uses' => 'AdminBudgetGroupController@destroy'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // add budget group form
    Route::get('/budget-groups/create', ['as' => 'admin.budgetgroups.create', 'uses' => 'AdminBudgetGroupController@create'])
        ->before('auth');

    // store new budget group
    Route::post('/budget-groups/store', ['as' => 'admin.budgetgroups.store', 'uses' => 'AdminBudgetGroupController@store'])
        ->before('auth','csrf');

    // edit budget group
    Route::get('/budget-groups/edit/{id}', ['as' => 'admin.budgetgroups.edit', 'uses' => 'AdminBudgetGroupController@edit'])
        ->where(['id' => '[0-9]+'])
        ->before('auth');

    // update budget group
    Route::post('/budget-groups/update/{id}', ['as' => 'admin.budgetgroups.update', 'uses' => 'AdminBudgetGroupController@update'])
        ->where(['id' => '[0-9]+'])
        ->before('auth','csrf');

    // FEEDBACK ANDERS DOEN (geen tabel?)

});

Route::get('/404', ['as' => '404', function()
{
    return View::make('404');

}
]);