<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JWTController extends Controller
{
    /**
     * 
     */
    public function index(Request $request){
        Log::alert(print_r($request->all(), true));
        return $request->all();
    }
}
