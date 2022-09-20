<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\ParCount;
use DB;
use App\Summary;

class RPCIController extends Controller
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
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'),DB::raw('sum(summaries.physical_count) as physical_count'))
                ->groupBy('stock_libs.stock_code')
                ->get();



/*
    	$data = DB::table('summaries')
    				->where(['summaries.type'=>'ris','summaries.date_receive'=>$id])
    				->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.id as id'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.stock_number as stock_number'),DB::raw('summaries.cluster as cluster'),DB::raw('summaries.unit as unit'), DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('sum(summaries.cost) as totalcost'),DB::raw('summaries.remarks as remarks'))
    				->groupBy(DB::raw('summaries.stock_number'))
    				->get();

    	$sig = DB::table('sign_settings')
                    ->get();

    	//dd($data);
*/

    	return view('rpci.rpci-master',compact('reorderdata'));
    }

    public function report_view($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('summaries')
                    ->where(['summaries.type'=>'ris','summaries.date_receive'=>$id])
                    ->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.id as id'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.stock_number as stock_number'),DB::raw('summaries.cluster as cluster'),DB::raw('summaries.unit as unit'), DB::raw('sum(summaries.available) as totalquantity'),DB::raw('sum(summaries.cost) as totalcost'),DB::raw('summaries.remarks as remarks'),DB::raw('summaries.physical_count as physical_count'),DB::raw('sum(summaries.available) as available'))
                    ->groupBy(DB::raw('summaries.stock_number'))
                    ->get();

        $sig = DB::table('sign_settings')
                    ->get();

        //dd($data);

        //return view('rpci.rpci-list-view',compact('data','sig','reorderdata'));

        if($sig->count()>0){
           return view('rpci.rpci-list-view',compact('data','sig','reorderdata'));
        }else{
            return view('error-sign',compact('reorderdata'));
        }
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

    public function get_stock_total($stock)
    {
        if(request()->ajax())
        {
            $data = DB::table('summaries')
                    ->where(['summaries.type'=>'iar','summaries.stock_number'=>$stock])
                    ->select(DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('summaries.id as id'), DB::raw('summaries.description as description'),DB::raw('sum(summaries.cost) as totalcost'),DB::raw('sum(summaries.available) as available'),DB::raw('summaries.physical_count as physical_count'))
                    ->groupBy(DB::raw('summaries.stock_number'))
                    ->get();

            return response()->JSON(['data' => $data]);
        }
    }

    public function update_stock_total(Request $request, $id)
    {
        if(request()->ajax())
        {
            $projectcounts = ParCount::firstOrCreate(
                    ['year' => Carbon::now()->format('Y')],
                    ['project_count' => 0]
                );
            $projectcounts->save();

            $countitem = ParCount::where('year', now()->year)->increment('project_count');

            $parcount = DB::table('par_counts')
                        ->where(['year' => Carbon::now()->format('Y')])
                        ->get(['project_count']);

            foreach ($parcount as $c) {
                $cc = $c->project_count;
            }

            //$par = Carbon::now()->format('Y').'-'.Carbon::now()->format('n').'-'.str_pad($cc, 5, '0', STR_PAD_LEFT);

            $par = Carbon::now()->format('Y').'-'.Carbon::now()->format('n').'-'.str_pad($id, 4, '0', STR_PAD_LEFT);

            $data = DB::table('summaries')
                ->where(['summaries.stock_number'=>$id])
                ->update([
                    'physical_count'    =>  $request->get('physicalcount'),
                    //'quantity'          =>  $request->get('physicalcount'),
                    //'available'         =>  $request->get('availitem'),
                    'remarks'           =>  $request->get('remarks')
                    //'par_ics_series'    =>  'PPE-'.$par

                ]);
            return response()->JSON(['data' => $data]);
        }
    }
}
