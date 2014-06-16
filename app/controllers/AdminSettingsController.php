<?php

class AdminSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $settings = Setting::all();

        return View::make('admin/settings/index')
            ->with('settings',$settings);
	}

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        $rules = [
            'lang_nl' => 'required_without:lang_en' ,
            'lang_en' => 'required_without:lang_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values

            $lang_nl = Setting::find(1);
            $lang_en = Setting::find(2);

            $lang_nl->setting_value_nl = Input::get('lang_nl');
            $lang_nl->setting_value_en = Input::get('lang_nl');

            $lang_nl->save();

            $lang_en->setting_value_nl = Input::get('lang_en');
            $lang_en->setting_value_en = Input::get('lang_en');

            $lang_en->save();


            return Redirect::route('admin.root');

        } else {

            return Redirect::to('admin/settings')
                ->withInput()
                ->withErrors($validator);
        }
    }

}