<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;
use App\Summary;

class SuppliesController extends Controller
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

    	/*
        $data = DB::table('summaries')
    				->where(['summaries.type'=>'ris'])
    				->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.unit as unit'), DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('sum(summaries.cost) as totalcost'))
    				->groupBy(DB::raw('summaries.stock_number'))
    				->get();

        $authsig = DB::table('sign_settings')
                    ->get();

    	//return view('rsmi.rsmi-view-list',compact('data','authsig'));

        */

        $data=DB::table('summaries')
                    ->where(['summaries.type'=>'ris'])
                    ->groupBy('summaries.date_receive')
                    ->orderBy('summaries.id','desc')
                    ->get();

        return view('rsmi.rsmi-master',compact('data','reorderdata'));
    }

    public function get_dates()
    {
    	if(request()->ajax())
        {
        	$data=DB::table('summaries')
        			->where(['summaries.type'=>'ris'])
        			->groupBy('summaries.date_receive')
        			->orderBy('summaries.id','desc')
        			->get();

        	return response()->JSON(['data' => $data]);
        }
    }

    public function issued_list($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$data = DB::table('summaries')
    				->where(['summaries.type'=>'ris','summaries.date_receive'=>$id])
    				->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.unit as unit'), DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('summaries.cost as cost'),DB::raw('summaries.papcode as papcode'))
    				->groupBy(DB::raw('summaries.stock_number'))
    				->get();


    	$receive_date = Carbon::parse($id)->format('F j, Y');

        $authsig = DB::table('sign_settings')
                    ->get();

        if($authsig->count()>0){
    	   return view('rsmi.rsmi-view-list',compact('data','receive_date','authsig','reorderdata'));
        }else{
            return view('error-sign',compact('reorderdata'));
        }
    }
}
