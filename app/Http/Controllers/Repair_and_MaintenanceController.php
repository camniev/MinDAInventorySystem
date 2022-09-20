<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use User;
use App\Repair_and_Maintenance;

class Repair_and_MaintenanceController extends Controller
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

    	$items = DB::table('repair_and__maintenances')
    				->orderBy('repair_and__maintenances.repair_update','asc')
                    ->orderBy('repair_and__maintenances.created_at', 'desc')
    				->paginate(10)
                    ->onEachSide(2);

    	return view('repair.pre-repair-list', compact('items','reorderdata'));
    }

    public function new_entry()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('repair.pre-repair-new',compact('reorderdata'));
    }

    public function save_entry(Request $request)
    {
    	$validateDate = $request->validate([
    		'item'				=>	'required',
    		'are_sticker'		=>	'required',
    		'prefindings'		=>	'required',
    		'prerecommendation'	=>	'required',
    		'inspector'			=>	'required',
    		'date_inspected'	=>	'required',
    	]);

    	$items	=	new Repair_and_Maintenance;
    		$items->item 				= $request->get('item');
    		$items->are_sticker			= $request->get('are_sticker');
    		$items->pre_findings		= $request->get('prefindings');
    		$items->pre_recommendation	= $request->get('prerecommendation');
    		$items->pre_inspector		= $request->get('inspector');
    		$items->pre_date_inspector 	= $request->get('date_inspected');

    		$items->save();
    		return redirect('/repair-and-maintenance/new-repair-entry')->with('alert','Pre-repair information was saved successfully');
    		
    }

    public function update_repair($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('repair_and__maintenances')
    					->where(['repair_and__maintenances.id'=>$id])
    					->get();

    	return view('repair.repair-and-maintenance',compact('lists','reorderdata'));
    }

    public function save_update_entry(Request $request, $id)
    {
    	$items = Repair_and_Maintenance::findOrFail($id);
		            $items->job_order       	= $request->get('jo_num');
		            $items->post_date_job      	= $request->get('jo_date');
		            $items->invoice 			= $request->get('invoice_num');
		            $items->post_date_invoice 	= $request->get('invoice_date');
		            $items->amount 				= $request->get('jo_amount');
		            $items->payable       		= $request->get('payable_amount');
		            $items->post_findings      	= $request->get('postrecommendation');
		            $items->post_inspector 		= $request->get('postinspector');
                    $items->repair_update       = 1;
		            $items->save();

		return redirect('/repair-and-maintenance/view-details/'.$items->id)->with('alert','Update successful');
    }

    public function view_details($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('repair_and__maintenances')
    					->where(['repair_and__maintenances.id'=>$id])
    					->get();

    	//dd($lists);
    	return view('repair.repair-view-details',compact('lists','reorderdata'));
    }

    public function delete_item($id)
    {
    	$lists = DB::table('repair_and__maintenances')
    					->where(['repair_and__maintenances.id'=>$id])
    					->delete();

    	//dd($lists);
    	return redirect('/repair-and-maintenance')->with('alert','Item was remove from the database');
    }
}
