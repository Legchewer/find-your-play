<?php

class AdminDashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get certain information

        // N/A messages
        $na_nl = "niks werd aangepast";
        $na_en = "nothing has been modified";

        /**********************
         * games
         **********************/

        $latest_game_createddate = Game::max('game_created');
        $latest_game_modifieddate = Game::max('game_modified');

        $latest_game_added = Game::whereRaw('game_created = ?', [$latest_game_createddate])->first();

        if (App::getLocale() == 'nl')
        {
            $latest_game_added_value = $latest_game_added->game_title_nl;

            // other language fallback when not translated
            if ($latest_game_added_value == ''){
                $latest_game_added_value = '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fi-alert"></i>' . $latest_game_added->game_title_en . '</span>';
            }
        }
        else {

            $latest_game_added_value = $latest_game_added->game_title_en;

            // other language fallback when not translated
            if ($latest_game_added_value == ''){
                $latest_game_added_value = '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fi-alert"></i>' . $latest_game_added->game_title_nl . '</span>';
            }

        }

        $latest_game_modified = Game::whereRaw('game_modified = ?', [$latest_game_modifieddate])->first();

        if($latest_game_modified !== null){

            if (App::getLocale() == 'nl')
            {
                $latest_game_modified_value = $latest_game_modified->game_title_nl;

                // other language fallback when not translated
                if ($latest_game_modified_value == ''){
                    $latest_game_modified_value = '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fi-alert"></i>' . $latest_game_modified->game_title_en . '</span>';
                }
            }
            else {
                $latest_game_modified_value = $latest_game_modified->game_title_en;

                // other language fallback when not translated
                if ($latest_game_modified_value == ''){
                    $latest_game_modified_value = '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fi-alert"></i>' . $latest_game_modified->game_title_nl . '</span>';
                }
            }
        }
        else {
            if (App::getLocale() == 'nl')
            {
                $latest_game_modified_value = $na_nl;
            }
            else {
                $latest_game_modified_value = $na_en;
            }
        }

        $games_count = Game::count();

        /**********************
         * members
         **********************/

        $latest_member_createddate = Member::max('member_created');
        $latest_member_modifieddate = Member::max('member_modified');

        $latest_member_added = Member::whereRaw('member_created = ?', [$latest_member_createddate])->first();

        $latest_member_added_value = $latest_member_added->person->person_givenname . " " . $latest_member_added->person->person_surname;

        if (App::getLocale() == 'nl'){
            $latest_member_added_role = $latest_member_added->role->role_name_nl;
        } else {
            $latest_member_added_role = $latest_member_added->role->role_name_en;
        }

        $members_count = Member::count();

        return View::make('admin/dashboard')
            ->with('latest_game_added', $latest_game_added_value)
            ->with('latest_game_added_date', $latest_game_createddate)
            ->with('latest_game_modified', $latest_game_modified_value)
            ->with('latest_game_modified_date', $latest_game_modifieddate)
            ->with('games_count', $games_count)
            ->with('latest_member_added', $latest_member_added_value)
            ->with('latest_member_added_role', $latest_member_added_role)
            ->with('latest_member_added_date', $latest_member_createddate)
            ->with('members_count', $members_count);

	}

}