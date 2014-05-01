<?php

class AdminGameFunctionCategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all categories
        $count = GameFunctionCategory::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $categories = GameFunctionCategory::orderBy('game_function_category_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $categories = GameFunctionCategory::orderBy('game_function_category_name_nl', 'asc')->paginate(10);

        }

        return View::make('admin/categories/index')
            ->with('categories',$categories)
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
        GameFunctionCategory::destroy($id);

        return Redirect::route('admin.categories');
    }

}