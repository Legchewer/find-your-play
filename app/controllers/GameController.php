<?php

class GameController extends \BaseController {

    public function Index($id)
    {
        $game = Game::find($id);
        $game->load('gameFunctions');
        $functions = $game->game_functions;
        $cognitive = array();
        $fysical = array();
        $social = array();
        $emotional = array();
        $wishlist_games = [];
        if(Cookie::get('wishlist')){
            $wishlist_games = Cookie::get('wishlist');
        }

        if(App::getLocale() == 'nl')
        {
            foreach($game->gameFeatures as $g){
                $feature = $g->where('game_feature_lang','=','NL')->get();
            }

            foreach($functions as $fn)
            {
                if($fn->game_function_category_id == 1)
                {
                    $cognitive[] = $fn->game_function_name_nl;
                }
                if($fn->game_function_category_id == 2)
                {
                    $fysical[] = $fn->game_function_name_nl;
                }
                if($fn->game_function_category_id == 3)
                {
                    $social[] = $fn->game_function_name_nl;
                }
                if($fn->game_function_category_id == 4)
                {
                    $emotional[] = $fn->game_function_name_nl;
                }
            }
            $cog_items = implode(", ", $cognitive);
            $fys_items = implode(", ", $fysical);
            $soc_items = implode(", ", $social);
            $emo_items = implode(", ", $emotional);

            return View::make('web.speldetail',['game' => $game,'cognitive' => $cog_items,'fysical' => $fys_items,'social' => $soc_items,'emotional' => $emo_items,'features' => $feature,'wishlist' => $wishlist_games]);
        }
        else
        {
            foreach($game->gameFeatures as $g){
                $feature = $g->where('game_feature_lang','=','EN')->get();
            }
            foreach($functions as $fn)
            {
                if($fn->game_function_category_id == 1)
                {
                    if($fn->game_function_name_en != '')
                        $cognitive[] = $fn->game_function_name_en;
                }
                if($fn->game_function_category_id == 2)
                {
                    if($fn->game_function_name_en != '')
                        $fysical[] = $fn->game_function_name_en;
                }
                if($fn->game_function_category_id == 3)
                {
                    if($fn->game_function_name_en != '')
                        $social[] = $fn->game_function_name_en;
                }
                if($fn->game_function_category_id == 4)
                {
                    if($fn->game_function_name_en != '')
                        $emotional[] = $fn->game_function_name_en;
                }
            }

            $cog_items = implode(", ", $cognitive);
            $fys_items = implode(", ", $fysical);
            $soc_items = implode(", ", $social);
            $emo_items = implode(", ", $emotional);

            return View::make('web.speldetail',['game' => $game,'cognitive' => $cog_items,'fysical' => $fys_items,'social' => $soc_items,'emotional' => $emo_items,'features' => $feature,'wishlist' => $wishlist_games]);
        }
    }
    public function AddToWishlist($id)
    {
        if(Cookie::get('wishlist')){

            $arr = Cookie::get('wishlist');
            array_push($arr,$id);
            Cookie::queue('wishlist', $arr, 525949);
        }else{
            $arr = [];
            Cookie::queue('wishlist', $arr, 525949); // expires in about 1 year
        }

        return Redirect::to('web/game/' . $id);
    }
    public function RemoveFromWishlist($id)
    {
        if(Cookie::get('wishlist')){

            $arr = Cookie::get('wishlist');
            if(($key = array_search($id, $arr)) !== false) {
                unset($arr[$key]);
            }
            Cookie::queue('wishlist', $arr, 525949);
        }

        return Redirect::to('web/game/' . $id);
    }
    public function Feedback($id)
    {
        $rules = [
            'feedback' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $feedback = new Feedback();
            $feedback->game_id= $id;
            $feedback->member_id = Auth::user()->member_id;
            $feedback->feedback_text = Input::get('feedback');
            $feedback->save();

            return Redirect::to('web/game/' . $id);

        } else {
            return Redirect::to('web/game/' . $id)
                ->withInput()
                ->withErrors($validator);
        }
    }
}