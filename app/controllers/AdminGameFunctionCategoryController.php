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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/categories/create');
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
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $category = new GameFunctionCategory();
            $category->game_function_category_name_nl = Input::get('name_nl');
            $category->game_function_category_name_en = Input::get('name_en');

            $category->save();

            return Redirect::route('admin.categories');

        } else {
            return Redirect::route('admin.categories.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = GameFunctionCategory::find($id);

        return View::make('admin/categories/edit')
            ->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $category = GameFunctionCategory::find($id);

        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
            $category->game_function_category_name_nl = Input::get('name_nl');
            $category->game_function_category_name_en = Input::get('name_en');

            // save changes
            $category->save();

            return Redirect::route('admin.categories');

        } else {

            return Redirect::to('admin/categories/edit/' . $category->game_function_category_id)
                ->withInput()
                ->withErrors($validator);
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
        GameFunctionCategory::destroy($id);

        return Redirect::route('admin.categories');
    }

}