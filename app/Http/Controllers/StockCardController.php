<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Summary;
use Carbon\Carbon;
use DB;
use App\User;

class StockCardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = DB::table('summaries')
    				->where(['summaries.type'=>'iar','summaries.category'=>'StockCard'])
    				->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->onEachSide(2);

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('stockcard.stock-card-list',compact('data','reorderdata'));
    }

    public function show_list($stocknumber)
    {

    	$data = DB::table('summaries')
    				->where(['summaries.stock_number'=>$stocknumber])
    				->orderBy('summaries.id','asc')
    				->get();

    	$reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('stockcard.stock-card-view',compact('data','reorderdata'));
    }

    public function view_detail($stock,$begin,$end)
    {

    	$reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
        $pcount=0;
    	$outpt='';
        $datas='';

    	foreach ($period as $date) {

		    $rpt = $date->format('n-Y');
            
            //echo($date);

		    $data = DB::table('summaries')
		    		->where(['summaries.stock_number'=>$stock, 'summaries.category'=>'StockCard', 'report_date'=>$rpt])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
                        $pb = (int)$dat->physical_count;
		   				//$pb = (int)$pb + (int)$dat->quantity;
                        $pcount = (int)$pcount + (int)$dat->quantity;
                        $pdate = $dat->invoice_date;
		   			}else{
		   				$pb = (int)$dat->quantity;
		   			}

                    $datas=$data;
		   		}
		   		
		}

/*		
		$date->modify('+1 month');

		$dateForward = Carbon::parse($end)->monthsUntil($dateOn);

        $summ='';

		foreach ($dateForward as $date2) {
			
			$summ = DB::table('summaries')
						->where(['summaries.report_date'=>$date2->format('n-Y'),'summaries.stock_number'=>$stock, 'summaries.category'=>'StockCard'])
						->orderBy('summaries.created_at','asc')
						->get();
						
                        echo($date2->format('n-Y'));
		}
*/
        $ty='ris';
        $bg = Carbon::parse($begin)->format('n-Y');


        $items = DB::table('summaries')
                        ->where(['summaries.stock_number'=>$stock,'summaries.category'=>'StockCard', 'summaries.type'=>'iar'])
                        ->orderBy('summaries.created_at','desc')
                        ->first();
		
			if(!empty($datas)){

				return view('stockcard.stock-card-view',compact('datas','items','reorderdata','pb'));
				
			}else{
				if(!empty($datas) && (int)$pb > 1)
				{
					return view('stockcard.stock-card-view',compact('pcount','pb','data','summ','reorderdata','pdate','items'));
				}else{
                    return view('stockcard.stock-card-view-item',compact('datas','reorderdata','pb'));

				}
				
			}
  
		
    }

    public function error404()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('stockcard.error-404',compact('reorderdata'));
    }
}
