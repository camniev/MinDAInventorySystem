<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disposal;
use App\Disposal_Detail;
use DB;
use App\User;

class DisposalController extends Controller
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

    	$items = DB::table('disposals')
                    ->orderBy('disposals.isok','asc')
    				->orderBy('disposals.created_at','desc')
    				->paginate(10)
                    ->onEachSide(2);

    	return view('disposal.disposal-lists',compact('items','reorderdata'));
    }

    public function new_entry()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('disposal.disposal-new-plan',compact('reorderdata'));
    }

    public function save_entry(Request $request)
    {
    	$validateData = $request->validate([
    		'cy'		=>	'required',
    		'item'		=> 	'required',

    	]);

    	$items = new Disposal;
    		$items->cy_date		= 	$request->get('cy');
    		$items->item 		=	$request->get('item');

    		$items->save();

    		return redirect('/disposals/update-disposal-activity-plan/'.$items->id)->with('alert','Save successfully, now ready to series of activities for disposal');
    }

    public function add_activity($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('disposals')
    					->where(['disposals.id'=>$id])
    					->get();

    	return view('disposal.disposal-new-plan-activities',compact('lists','reorderdata'));
    }

    public function save_activity_entry(Request $request)
    {
    	$validateData = $request->validate([
    		'activity'			=>	'required',
    		'activity_date' 	=>	'required',
    	]);

    	$d_id = $request->get('d_id');

    	$items	=	new Disposal_Detail;
    		$items->d_id 			   =	$request->get('d_id');
    		$items->activity 		   =	$request->get('activity');
    		$items->activity_date 	   = 	$request->get('activity_date');
            $items->activity_date_end   =    $request->get('activity_date_end');

    		$items->save();
    		return redirect('/disposals/update-disposal-activity-plan/'.$d_id);
    }

    public function update_activity($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('disposals')
    					->join('disposal__details','disposals.id','disposal__details.d_id')
    					->where(['disposal__details.d_id'=>$id,'disposals.id'=>$id])
    					->get();

    	return view('disposal.disposal-plan-activities',compact('lists','reorderdata'));

    }

    public function view_activity($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('disposals')
    					->join('disposal__details','disposals.id','disposal__details.d_id')
    					->where(['disposal__details.d_id'=>$id,'disposals.id'=>$id])
    					->get();

    	return view('disposal.disposal-plan-view-activities',compact('lists','reorderdata'));
    }

    public function delete_activity($id,$id2)
    {
    	$items = DB::table('disposal__details')
    					->where(['disposal__details.id'=>$id2])
    					->delete();

    	return redirect('/disposals/update-disposal-activity-plan/'.$id)->with('alert','Disposal activity was remove from the database');
    }

    public function delete_disposal($id)
    {
    	$items = DB::table('disposal__details')
    					->where(['disposal__details.d_id'=>$id])
    					->delete();

    	$items2 = DB::table('disposals')
    					->where(['disposals.id'=>$id])
    					->delete();

    	return redirect('/disposals')->with('alert','Disposal item was remove from the list');
    }

    public function status_disposal($id)
    {
        if(request()->ajax())
            {
            $items = DB::table('disposals')
                        ->where(['disposals.id'=>$id])
                        ->get();

            return response()->JSON(['data' => $items]);
        }
    }

    public function save_activity_complete(Request $request, $id)
    {
        if(request()->ajax()) 
        {
            $items = Disposal::findOrFail($id);

            $c = $request->get('chkcomplete');


                $items->isok    =   $request->get('chkcomplete');

                $items->save();

            return response()->JSON(['data'=>$items]);
        }
    }

    public function index_sample()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('sample.sample',compact('reorderdata'));
    }
}
