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
        $pathOri = "D:\instagram\baru";
        $mengikuti = json_decode(file_get_contents("$pathOri/connections/followers_and_following/following.json"));
        foreach($mengikuti->relationships_following as $list){
            $newMengikuti[] = $list->string_list_data[0]->value;
        }
        
        $pengikut = json_decode(file_get_contents("$pathOri/connections/followers_and_following/followers_1.json"));
        foreach($pengikut as $list){
            $newPengikut[] = $list->string_list_data[0]->value;
        }

        foreach($newMengikuti as $list){
            if(!in_array($list, $newPengikut)){
                $compare[] = $list;
            }
        }
        sort($compare);
        return view('instagram', ['data' => $compare]);
    }
}
