<?php

class AdminGameFunctionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GameFunction::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $functions = GameFunction::orderBy('game_function_category_id', 'asc')->orderBy('game_function_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $functions = GameFunction::orderBy('game_function_category_id', 'asc')->orderBy('game_function_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/functions/index')
            ->with('functions',$functions)
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
        GameFunction::destroy($id);

        return Redirect::route('admin.functions');
    }

}