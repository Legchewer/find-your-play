<?php

class GameController extends \BaseController {

    public function Index($id)
    {

        $game = Game::find($id);
        $game->load('gameFunctions');
        $game->load('gameFeatures');
        $features = $game->game_features;
        $functions = $game->game_functions;
        $cognitive = array();
        $fysical = array();
        $social = array();
        $emotional = array();

        if(App::getLocale() == 'nl')
        {
            foreach($features as $feature)
            {
                $f_nl = $feature::where('game_feature_lang','=','NL')->lists('game_feature_value','game_feature_name');
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

            return View::make('web.speldetail',['game' => $game,'cognitive' => $cog_items,'fysical' => $fys_items,'social' => $soc_items,'emotional' => $emo_items,'features' => $f_nl]);
        }
        else
        {
            foreach($features as $feature)
            {
                $f_en = $feature::where('game_feature_lang','=','EN')->lists('game_feature_value','game_feature_name');
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

            return View::make('web.speldetail',['game' => $game,'cognitive' => $cog_items,'fysical' => $fys_items,'social' => $soc_items,'emotional' => $emo_items,'features' => $f_en]);
        }
    }
}