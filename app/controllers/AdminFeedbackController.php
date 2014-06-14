<?php

class AdminFeedbackController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        // filter for games with feedback, sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $games = Game::has('feedback')->orderBy('game_type_id', 'asc')->orderBy('game_title_nl', 'asc')->paginate(5);

        }
        else
        {
            $games = Game::has('feedback')->orderBy('game_type_id', 'asc')->orderBy('game_title_en', 'asc')->paginate(5);

        }

        return View::make('admin/feedback/index')
            ->with('games',$games);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Feedback::destroy($id);

        return Redirect::route('admin.feedback');
    }

}