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