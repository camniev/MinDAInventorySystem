<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Summary;
use Carbon\Carbon;
use DB;
use App\User;
use App\Requests;

class RPCPPEController extends Controller
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

        $data = DB::table('requests')
                    ->groupBy('requests.requested_by')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->onEachSide(2);

        return view('rpcppe.rpcppe-list',compact('data','reorderdata'));
    }

    public function view_details($id,$person)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$data = DB::table('summaries')
    			->where(['summaries.report_date'=>$id,'summaries.requested_by'=>$person,'summaries.type'=>'ris'])
    			->orderBy('summaries.id','asc')
    			->get();

    	//dd($data);
    	return view('rpcppe.rpcppe-detail-view',compact('data','reorderdata'));
    }

    public function get_item($id){

    	if(request()->ajax())
        {

    	$data = DB::table('summaries')
    		->where(['summaries.requested_by'=>$id,'summaries.type'=>'ris'])
    		->select('report_date')
    		->orderBy('id','asc')
    		->get();

    	    return response()->JSON(['data' => $data]);
        }

    }
}
