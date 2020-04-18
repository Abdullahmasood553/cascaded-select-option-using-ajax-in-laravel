<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CauseController extends Controller
{
    public function index() {
        $data = DB::table('categories')->get();
        return view('causes_cat')->with('data', $data);
    }


    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }
}
