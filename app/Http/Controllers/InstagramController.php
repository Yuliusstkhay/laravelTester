<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $pathOri = "C:\Users\Yulius\Videos\ig";
        $mengikuti = json_decode(file_get_contents("$pathOri/connections/followers_and_following/following.json"));
        foreach($mengikuti->relationships_following as $list){
            $newMengikuti[] = $list->string_list_data[0]->value;
        }
        
        $pengikut = json_decode(file_get_contents("$pathOri/connections/followers_and_following/followers_1.json"));
        foreach($pengikut as $list){
            $newPengikut[] = $list->string_list_data[0]->value;
        }

        foreach($newMengikuti as $list){
            $cekAccount = Instagram::where('ig', $list)->first();
            if(!in_array($list, $newPengikut) && $cekAccount == null){
                $compare[] = $list;
            }
        }
        sort($compare);
        return view('instagram', ['data' => $compare]);
    }

    /**
     * @route 'ig.save'
     * @method POST
     * @description untuk save ke DB
     * @return JSON
     */
    public function save(Request $request){
        try {
            DB::beginTransaction();
                foreach($request->account ?? [] as $list){
                    /*-------------------------
                    |    CEK EXISTING DATA    |
                    -------------------------*/
                    if(Instagram::where('ig', $list)->first() !== null){
                        DB::rollBack();
                        return ['result' => false, 'message' => "$list has been exist"];
                    }

                    $ig = new Instagram();
                    $ig->ig = $list;
                    if(!$ig->save()){
                        DB::rollBack();
                        return ['result' => false, 'message' => 'Failed save data'];
                    }
                }
            DB::commit();
            return ['result' => true, 'message' => 'Successfully save data'];
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return ['result' => false, 'message' => 'Failed save data'];
        }
    }
}
