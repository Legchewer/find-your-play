<?php

class AdminBudgetGroupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = BudgetGroup::all()->count();

        // sort by name and paginate

            $budgetgroups = BudgetGroup::orderBy('budget_group_id', 'asc')->paginate(10);

        return View::make('admin/budgetgroups/index')
            ->with('budgetgroups',$budgetgroups)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/budgetgroups/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'value' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $budgetgroup = new BudgetGroup();
            $budgetgroup->budget_group_value = Input::get('value');

            $budgetgroup->save();

            return Redirect::route('admin.budgetgroups');

        } else {
            return Redirect::route('admin.budgetgroups.create')
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
        $budgetgroup = BudgetGroup::find($id);

        return View::make('admin/budgetgroups/edit')
            ->with('budgetgroup',$budgetgroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $budgetgroup = BudgetGroup::find($id);

        $rules = [
            'value' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
            $budgetgroup->budget_group_value = Input::get('value');

            // save changes
            $budgetgroup->save();

            return Redirect::route('admin.budgetgroups');

        } else {

            return Redirect::to('admin/budgetgroups/edit/' . $budgetgroup->budget_group_id)
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
        BudgetGroup::destroy($id);

        return Redirect::route('admin.budgetgroups');
    }

}