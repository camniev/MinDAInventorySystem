<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use App\User;
use App\SignSetting;

class SettingsController extends Controller
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

    	$data = DB::table('sign_settings')->get();

    	$rcnt = $data->count();

    	return view('settings.settings',compact('data','rcnt','reorderdata'));
    }

    public function save_basic_info(Request $request)
    {
    	if(request()->ajax())
        {

        	$x = $request->get('rcount');

        	if($x==0){

	        	$data = new SignSetting;
	        	$data->IARSupplyOfficer 	=	$request->get('supply_name');
	        	$data->IARSupplyOfficerPos 	=	$request->get('supply_pos');
	        	$data->assume_date 			=	$request->get('supply_res_date');
	        	$data->IARInpector 			=	$request->get('supply_name_inspector');
	        	$data->IARInpectorPos 		=	$request->get('supply_pos_inspector');
	        	$data->RSMIAccClerk 		=	$request->get('acc_clerk');
				$data->save();

				return response()->JSON(['data' => $data]);
        	}else{
        		$data = DB::table('sign_settings')
                    ->update(['IARSupplyOfficer' 	=> $request->get('supply_name'),
                    		'IARSupplyOfficerPos' 	=> $request->get('supply_pos'),
                    		'assume_date' 			=> $request->get('supply_res_date'),
                    		'IARInpector' 			=> $request->get('supply_name_inspector'),
                    		'IARInpectorPos' 		=> $request->get('supply_pos_inspector'),
                    		'RSMIAccClerk' 			=> $request->get('acc_clerk')
                ]);

                return response()->JSON(['data' => $data]);
        	}
        	
        }
    }

    public function rpci_info(Request $request)
    {
    	if(request()->ajax())
    	{
    		$x = $request->get('rcount');

        	if($x==0){

        	$data = new SignSetting;
	        	$data->RPCIInvCommitteeChair 	=	$request->get('inv_name_chair');
	        	$data->RPCIInvCommitteeMember  	=	$request->get('inv_name_member');
	        	$data->RPCIOICChair 			=	$request->get('inv_name_oic');
	        	$data->RPCICOARep 				=	$request->get('inv_name_coa');
	        	$data->RPCIFinDivRep 			=	$request->get('inv_name_fin');
				$data->save();

				return response()->JSON(['data' => $data]);
        	}else{
        		$data = DB::table('sign_settings')
                    ->update(['RPCIInvCommitteeChair' 	=> $request->get('inv_name_chair'),
                    		'RPCIInvCommitteeMember' 	=> $request->get('inv_name_member'),
                    		'RPCIOICChair' 				=> $request->get('inv_name_oic'),
                    		'RPCICOARep' 				=> $request->get('inv_name_coa'),
                    		'RPCIFinDivRep' 			=> $request->get('inv_name_fin')
                ]);

                return response()->JSON(['data' => $data]);
        	}
    	}
    }

    public function error_signature()
    {

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('error-sign',compact('reorderdata'))->with('alert','Please fill up first the Signatures in Settings');

    }

    public function library_entry()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('stock_libs')
                ->orderBy('stock_libs.id','desc')
                ->paginate(50)
                ->onEachSide(2);


        return view('stocklibrary.library-list',compact('reorderdata','data'));
    }

    public function save_new_stock(Request $request)
    {
        $db = DB::insert('insert into stock_libs (stock_code, description, unit, expense_category, reorderpoint) values (?,?,?,?,?)',

        [
            strtoupper($request->get('stockcode')),
            $request->get('stock_description'),
            strtoupper($request->get('unit')),
            strtoupper($request->get('category')),
            $request->get('reorder'),

        ]);

        return redirect('/library')->with('alert','New Stock save');
    }
}
