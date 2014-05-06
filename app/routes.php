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

    Route::get('/search',function()
    {
        if (App::getLocale() == 'nl')
        {
            $game_kinds = GameKind::where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = Theme::where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_nl','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_nl','game_players_id');
            $game_age = Game::groupBy('game_age_nl')->lists('game_age_nl');
            $games = Game::select('game_title_nl as game_title','game_description_nl as game_description')->get();
        }
        else
        {
            $game_kinds = GameKind::where('game_kind_name_en','!=','')->lists('game_kind_name_en','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_en','game_difficulty_id');
            $game_themes = Theme::where('theme_name_en','!=','')->lists('theme_name_en','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_en','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_en','game_players_id');
            $game_age = Game::groupBy('game_age_en')->lists('game_age_en');
            $games = Game::select('game_title_en as game_title','game_description_en as game_description')->get();
        }

        $game_producer = Game::groupBy('game_producer')->lists('game_producer');
        $game_budget = BudgetGroup::lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'),['games' => $games]);
    });

    Route::post('/search',['as' => 'web.search','uses' => 'SearchController@NameAndDescriptionSearch']);

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

    // FEEDBACK ANDERS DOEN (geen tabel)

});

Route::get('/404', ['as' => '404', function()
{
    return View::make('404');

}
]);