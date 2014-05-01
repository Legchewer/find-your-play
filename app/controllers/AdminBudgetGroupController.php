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