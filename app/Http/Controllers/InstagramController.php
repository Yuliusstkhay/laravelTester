<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstagramController extends Controller
{
    /**
     * @route 'instagram/compare'
     * @method GET
     * @description untuk compare following dan follower
     * @return view
     */
    public function compare(){
        $mengikuti = json_decode(file_get_contents('public\IG\following.json'));
        foreach($mengikuti->relationships_following as $list){
            $newMengikuti[] = $list->string_list_data[0]->value;
        }
        
        $pengikut = json_decode(file_get_contents('public\IG\followers_1.json'));
        foreach($pengikut as $list){
            $newPengikut[] = $list->string_list_data[0]->value;
        }

        foreach($newMengikuti as $list){
            if(!in_array($list, $newPengikut)){
                $compare[] = $list;
            }
        }
        return $compare;
    }
}
