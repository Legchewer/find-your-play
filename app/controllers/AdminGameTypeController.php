<?php

class AdminGameTypeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GameType::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $types = GameType::orderBy('game_kind_id', 'asc')->orderBy('game_type_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $types = GameType::orderBy('game_kind_id', 'asc')->orderBy('game_type_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/types/index')
            ->with('types',$types)
            ->with('count',$count);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        GameType::destroy($id);

        return Redirect::route('admin.types');
    }

}