<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Summary;

class PARController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$data = DB::table('summaries')
    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
    			->orderBy('summaries.created_at','desc')
    			//->groupBy('summaries.requested_by')
    			->paginate(10)
                ->onEachSide(2);

    	$cy = DB::table('summaries')
    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
    			->groupBy('summaries.cy')
    			->orderBy('summaries.created_at','desc')
    			->get();

    	$user = DB::table('summaries')
    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
    			->groupBy('summaries.requested_by')
    			->orderBy('summaries.created_at','desc')
    			->get();

    	return view('par.property-list-view',compact('data','cy','user','reorderdata'));
    }

    public function fiscal_list($fy)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.cy'=>$fy])
                ->orderBy('summaries.created_at','desc')
                //->groupBy('summaries.requested_by')
                ->paginate(10)
                ->onEachSide(1);

        $cy = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.cy')
                ->orderBy('summaries.created_at','desc')
                ->get();

        $user = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.requested_by')
                ->orderBy('summaries.created_at','desc')
                ->get();

        return view('par.property-list-view',compact('data','cy','user','reorderdata'));
    }

    public function end_user($user)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.requested_by'=>$user])
                ->orderBy('summaries.created_at','desc')
                //->groupBy('summaries.requested_by')
                ->paginate(10)
                ->onEachSide(1);

        $cy = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.cy')
                ->orderBy('summaries.created_at','desc')
                ->get();

        $user = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.requested_by')
                ->orderBy('summaries.created_at','desc')
                ->get();

        return view('par.property-list-view',compact('data','cy','user','reorderdata'));
    }

    public function fiscal_end_user($fy,$user)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.requested_by'=>$user,'summaries.cy'=>$fy])
                ->orderBy('summaries.created_at','desc')
                //->groupBy('summaries.requested_by')
                ->paginate(10)
                ->onEachSide(1);

        $cy = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.cy')
                ->orderBy('summaries.created_at','desc')
                ->get();

        $user = DB::table('summaries')
                ->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
                ->groupBy('summaries.requested_by')
                ->orderBy('summaries.created_at','desc')
                ->get();

        return view('par.property-list-view',compact('data','cy','user','reorderdata'));
    }
}
