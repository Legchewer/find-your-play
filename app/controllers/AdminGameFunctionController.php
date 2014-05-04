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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // create appropriate ddl according to current locale
        if (App::getLocale() == 'nl')
        {
            $categories = GameFunctionCategory::lists('game_function_category_name_nl','game_function_category_id');
        }
        else {
            $categories = GameFunctionCategory::lists('game_function_category_name_en','game_function_category_id');
        }

        return View::make('admin/functions/create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl',
            'category' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $function = new GameFunction();
            $function->game_function_name_nl = Input::get('name_nl');
            $function->game_function_name_en = Input::get('name_en');

            $category = GameFunctionCategory::find(Input::get('category'));

            $function->gameFunctionCategory()->associate($category);

            $function->save();

            return Redirect::route('admin.functions');

        } else {
            return Redirect::route('admin.functions.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
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