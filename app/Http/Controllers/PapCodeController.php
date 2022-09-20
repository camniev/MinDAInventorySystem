<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PapCodeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_code($id){
    	if(request()->ajax()) 
        {
	    	$items	= DB::table('pap_codes')
	    				->where(['pap_codes.division'=>$id])
	    				->get();

	    	return response()->JSON(['data'=>$items]);

	    }
    }
}
