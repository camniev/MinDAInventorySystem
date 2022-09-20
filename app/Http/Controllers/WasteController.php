<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Waste_Materials;
use App\Waste_Material_Details;
use DB;
use App\User;

class WasteController extends Controller
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

    	$items	= DB::table('waste__materials')
                    ->orderBy('waste__materials.isok','asc')
    				->orderBy('waste__materials.created_at','desc')
    				->paginate(10)
                    ->onEachSide(2);

    	return view('wm.waste-materials-list',compact('items','reorderdata'));
    }

    public function add_new_entry()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('wm.waste-materials-new-entry',compact('reorderdata'));
    }

    public function save_new_entry(Request $request)
    {
    	$validateData = $request->validate([
    		'wm_num'		=>	'required',
    		'entity_name'	=>	'required',
    		'cluster'		=>	'required',
    		'storage'		=>	'required',
    		'wm_date'		=>	'required',
    	]);

    	$items = new Waste_Materials;
    		$items->wm_num		=	$request->get('wm_num');
    		$items->entity_name	=	$request->get('entity_name');
    		$items->cluster		=	$request->get('cluster');
    		$items->storage		=	$request->get('storage');
    		$items->wm_date		=	$request->get('wm_date');

    		$items->save();

    	return redirect('/waste-materials/append-details-waste-materials-entry/'.$items->id);
    }

    public function append_detail_entry($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('waste__materials')
    					->join('waste__material__details','waste__material__details.wm_id','waste__materials.id')
    					->where(['waste__material__details.wm_id'=>$id,'waste__materials.id'=>$id])
    					->orderBy('waste__material__details.created_at','desc')
    					->get();

    	return view('wm.waste-materials-append-details', compact('lists','reorderdata'));
    }

    public function add_detail_entry($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('waste__materials')
    					->where(['waste__materials.id'=>$id])
    					->get();

    	return view('wm.waste-materials-add-details', compact('lists','reorderdata'));
    }

    public function save_detail(Request $request)
    {
    	$validateData = $request->validate([
    		'item'			=>	'required',
    		'quantity'		=>	'required',
    		'unit'			=>	'required',
    		'description'	=>	'required',
    		//'num'			=>	'required',
    		//'or_date'		=>	'required',
    		//'amount'		=>	'required',
    	]);

    	$wm_id =	$request->get('wm_id');
    	$items = new Waste_Material_Details;
    		$items->wm_id			=	$request->get('wm_id');
    		$items->item			=	$request->get('item');
    		$items->quantity		=	$request->get('quantity');
    		$items->unit			=	$request->get('unit');
    		$items->description		=	$request->get('description');
    		$items->receipt_num		=	$request->get('num');
    		$items->receipt_date	=	$request->get('or_date');
    		$items->amount			=	$request->get('amount');

    		$items->save();

    	return redirect('/waste-materials/append-details-waste-materials-entry/'.$wm_id);
    }

    public function signature_waste_materials($id)
    {
        if(request()->ajax()) 
        {

            $items = DB::table('waste__materials')
                                ->where(['waste__materials.id'=>$id])
                                ->get();

            return response()->JSON(['data' => $items]);

        }
    }

    public function save_signature_waste_materials(Request $request,$id)
    {
        if(request()->ajax()) 
        {

            $items = Waste_Materials::findOrFail($id);
                $items->custodian               = $request->get('certifiedby_1');
                $items->agency_head             = $request->get('approveby');
                $items->is_destroyed            = $request->get('chkdistroy');
                $items->private_sale            = $request->get('chkprivate_sale');
                $items->public_auction          = $request->get('chkpublic_auction');
                $items->transferred             = $request->get('chktransfered');
                $items->agency_name             = $request->get('transferto');
                $items->inspection_officer      = $request->get('certifiedby_2');
                $items->witness                 = $request->get('witnessby');

                if(!is_null($request->get('witnessby'))){
                    $items->isok         = 1;
                }else{
                    $items->isok         = 0;
                }

                $items->save();

            return response()->JSON(['data'=>$items]);
                              

        }
    }

    public function delete_waste_entry($id)
    {
    	$items = DB::table('waste__materials')
		    				->where(['waste__materials.id'=>$id])
		    				->delete();

		$items2 = DB::table('waste__material__details')
		    				->where(['waste__material__details.wm_id'=>$id])
		    				->delete();

    	return redirect('/waste-materials')->with('alert','Item remove from the database');	
    }

    public function delete_detail_entry($id,$id2)
    {
    	$items = DB::table('waste__material__details')
    				->where(['waste__material__details.id'=>$id2])
    				->delete();

    	return redirect('/waste-materials/append-details-waste-materials-entry/'.$id)->with('alert','Item remove from the database');		
    }

    public function view_detail_entry($id)
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$lists = DB::table('waste__materials')
    					->join('waste__material__details','waste__material__details.wm_id','waste__materials.id')
    					->where(['waste__material__details.wm_id'=>$id,'waste__materials.id'=>$id])
    					->orderBy('waste__material__details.created_at','desc')
    					->get();

    	return view('wm.waste-materials-view-details', compact('lists','reorderdata'));
    }
}
