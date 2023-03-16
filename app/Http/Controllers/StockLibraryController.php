<?php

namespace App\Http\Controllers;

use App\Imports\ImportStock;
use App\Stock;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class StockLibraryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_code($id){
    	if(request()->ajax()) 
        {
	    	$items	= DB::table('stock_libs')
	    				->where(['stock_libs.stock_code'=>$id])
	    				->get();

	    	return response()->JSON(['data'=>$items]);

	    }
    }


    public function re_order_point()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('stock_libs')
                ->orderBy('stock_libs.stock_code','asc')
                ->paginate(10)
                ->onEachSide(2);

        return view('stocklibrary.stock-library-list',compact('data','reorderdata'));
    }

    // public function get_stock($id)
    // {
    //     if(request()->ajax())
    //     {
    //         $data = DB::table('stock_libs')
    //                 ->where(['stock_libs.id'=>$id])
    //                 ->get();

    //         $data = Stock::find($)

    //         return response()->JSON(['data'=>$data]);
    //     }
    // }

    //refactored get_stock() - getting details of a stock for edit
    public function get_stock($id)
    {
        if(request()->ajax())
        {
            $data = Stock::find($id);
            return response()->json($data);
        }
    }

    public function count_stock()
    {
        if(request()->ajax())
        {
            $data = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->get();


            $r=0;

            foreach ($data as $d) {
                if((int)$d->available <= (int)$d->reorderpoint)
                {
                    $r = $r+1;
                }
                
            } 

            return response()->JSON([$data]);
        }
    }

    public function update_stock(Request $request,$id)
    {
        if(request()->ajax())
        {
            $data = DB::table('stock_libs')
                    ->where(['stock_libs.id'=>$id])
                    ->update([
                        'stock_code'        => $request->get('stockcode'),
                        'description'       => $request->get('stock_description'),
                        'unit'              => $request->get('unit'),
                        'expense_category'  => $request->get('category'),
                        'reorderpoint'      => $request->get('reorder')
                    ]);

            return response()->JSON(['data'=>$data]);
        }

    }

    public function reorder_stock()
    {
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $data = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->paginate(10)
                ->onEachSide(2);
                
        return view('stocklibrary.re-order-list',compact('data','reorderdata'));
    }

    public function remove_stock(Request $request, $id)
    {
        $r_id = $request->get('d_id');

        $data = DB::table('stock_libs')
                ->where(['stock_libs.id'=>$id])
                ->delete();

        return redirect('/library')->with('alert','Stock deleted');
    }

    public function batchUploadStocks(Request $request) {
        Excel::import(new ImportStock, $request->file('file')->store('files'));
        return redirect()->back()->with(['message' => 'Uploaded successfully.']);
    }

    public function addIndividualStock(Request $request) {
        Stock::create($request->all());
        return redirect()->back()->with(['message' => 'Saved successfully']);
    }
}
