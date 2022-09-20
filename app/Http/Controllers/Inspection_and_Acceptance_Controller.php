<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspection_and_Acceptance;
use App\Summary;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class Inspection_and_Acceptance_Controller extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lists = DB::table('inspection_and__acceptances')
                    ->orderBy('iscomplete', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->onEachSide(2);

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $viewtype="0";

        return view('iar.iar-list',compact('lists','reorderdata','viewtype'));
    }

    public function iar_number_filter($iarnumber)
    {
        $lists = DB::table('inspection_and__acceptances')
                    ->where(['inspection_and__acceptances.iar_no'=>$iarnumber])
                    ->orderBy('iscomplete', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->onEachSide(2);

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $viewtype="1";

        return view('iar.iar-list',compact('lists','reorderdata','viewtype'));
    }

    public function new_inspection()
    {
        $papcode = DB::table('pap_codes')
                    ->orderBy('division','asc')
                    ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('iar.new-item',compact('papcode','reorderdata'));
    }

    public function save_inspection_title(Request $request)
    {
        $validatedData = $request->validate([
            'EntityName'        =>  'required',
            'FundCluster'       =>  'required',
            'Supplier'          =>  'required',
            'PONumber'          =>  'required',
            'InvoiceNo'         =>  'required',
            'InvoiceDate'       =>  'required',
        ]);

        $userId = $request->user()->id;

        $items = new Inspection_and_Acceptance;
            $items->entity_name         =  $request->get('EntityName');
            $items->cluster             =  $request->get('FundCluster');
            $items->supplier            =  $request->get('Supplier');
            $items->po_number           =  $request->get('PONumber');
            $items->department          =  $request->get('risoffice');
            $items->papcode             =  $request->get('papcode');
            $items->responsibility_code =  $request->get('RespoCenter');
            $items->invoice_no          =  $request->get('InvoiceNo');
            $items->invoice_date        =  $request->get('InvoiceDate');
            $items->type                =  'iar';
            $items->save();

            return redirect('/inspection-and-acceptance/inspection-details/' . $items->id);
    }

    public function new_inspection_details($id)
    {
        $items = Inspection_and_Acceptance::findOrFail($id);

        $library = DB::table('stock_libs')->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('/iar.item-details-entry', compact('items','library','reorderdata'));
    }

    public function save_inspection_details(Request $request,$id)
    {

        $cost=str_replace(",", "", $request->get('cost'));

        $data = new Summary;

        if($request->hasFile('img_file')) {
            $filenameWithExt = $request->file('img_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('img_file')->getClientOriginalExtension();
            $fileNameToStore = time().'_'.$filename.'.'.$extension;                       

            $file = $request->file('img_file');
            $file->getClientOriginalName();
            $encryp = md5($file);
            $destinationPath = 'uploads';
            $file->move($destinationPath,$encryp.'.'.$extension);

        } else {
            $encryp='noimage';
            $extension='jpg';
        }

            $data->reference_id             =   $id;
            $data->entity_name              =   'MINDANAO DEVELOPMENT AUTHORITY';
            $data->cluster                  =   '101';
            $data->supplier                 =   $request->get('supplier');
            $data->papcode                  =   $request->get('papcode');
            $data->division                 =   $request->get('department');
            $data->respo_center             =   $request->get('respo_center_code');
            $data->invoice_no               =   $request->get('invoice_number');
            $data->invoice_date             =   $request->get('invoice_date');
            $data->stock_number             =   $request->get('optselect');
            $data->description              =   $request->get('description');
            $data->item                     =   $request->get('description');
            $data->unit                     =   $request->get('unit');
            $data->cost                     =   $cost;
            $data->quantity                 =   $request->get('quantity');
            $data->available                =   $request->get('quantity');
            $data->category                 =   $request->get('category');
            $data->image                    =   $encryp.'.'.$extension;
            $data->report_date              =   Carbon::now()->format('n-Y');
            $data->type                     =  'iar';
            $data->consume_days             =   $request->get('consume');
            
            $data->save();

            //return redirect('/inspection-and-acceptance/add-inspection-details/'.$id);
            

    }

    public function add_inspection_details($id)
    {

        $items = DB::table('inspection_and__acceptances')
                        ->join('summaries','summaries.reference_id',"=",'inspection_and__acceptances.id')
                        ->where(['inspection_and__acceptances.id'=>$id,'summaries.reference_id' => $id])
                        ->orderBy('inspection_and__acceptances.created_at', 'asc')
                        ->get();

        $library = DB::table('stock_libs')
                        ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

            //dd($items);
            return view('iar.items-append-details-entry', compact('items','library','reorderdata'));
    }

    public function edit_inspection_details($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('summaries')
                            ->where(['summaries.id'=>$id])
                            ->get();

            return response()->JSON(['data' => $data]);
        }
    }

    public function update_inspection_details(Request $request,$id)
    {
        if(request()->ajax())
        {

            $cost=str_replace(",", "", $request->get('cost2'));

            $data = Summary::findOrFail($id);

            $data->stock_number             =   $request->get('propno2');
            $data->description              =   $request->get('description2');
            $data->item                     =   $request->get('description2');
            $data->unit                     =   $request->get('unit2');
            $data->cost                     =   $cost;
            $data->quantity                 =   $request->get('quantity2');
            $data->save();

            return response()->JSON(['data' => $data]);
        }

    }

    public function view_inspection_details($id)
    {
        $lists = DB::table('summaries')
                        ->join('inspection_and__acceptances','summaries.reference_id',"=",'inspection_and__acceptances.id')
                        ->where(['inspection_and__acceptances.id'=>$id,'summaries.reference_id' => $id])
                        ->orderBy('summaries.created_at', 'asc')
                        ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('iar.item-detail-view',compact('lists','reorderdata'));


    }

    public function delete_inspection_details($id,$id2)
    {
        $data = DB::table('summaries')
                    ->where(['summaries.stock_number'=>$id])
                    ->delete();

        return redirect('/inspection-and-acceptance/add-inspection-details/'.$id2);
    }

    public function delete_inspection_data($id)
    {
        $data = DB::table('summaries')
                    ->where(['summaries.reference_id'=>$id])
                    ->delete();

        $iar_data = DB::table('inspection_and__acceptances')
                    ->where(['inspection_and__acceptances.id'=>$id])
                    ->delete();

        return redirect('/inspection-and-acceptance');
    }

    public function inspector($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('inspection_and__acceptances')
                        ->join('summaries','summaries.reference_id',"=",'inspection_and__acceptances.id')
                        ->where(['inspection_and__acceptances.id'=>$id,'summaries.reference_id'=>$id,'summaries.type'=>'iar'])
                        ->get();

            return response()->JSON(['data'=>$data]);
        }


    }

    public function update_inspector(Request $request,$id)
    {
        if(request()->ajax())
        {
            $items = Inspection_and_Acceptance::findOrFail($id);

            $items->inspector           = $request->get('inspector');
            //$items->receiver            = $request->get('receiver');
            $items->date_inspected      = $request->get('dateinspected');
            $items->date_receive        = $request->get('datereceive');
            $items->remarks             = $request->get('remarks');

            
            if(!is_null($request->get('receiver'))){
                $items->is_updated              = 1;
            }else{
                $items->is_updated              = 0;
            }

            if($request->get('complete')){
                $items->iscomplete = '1';
            }else{
                $items->iscomplete = '0';
            }

            if(!is_null($request->get('inspector'))){
                //$items->is_updated         = 1;


                $iargetdate = \Carbon\Carbon::now()->format('Y');
                $recCount = $items->count();
                $totalRec = (int)$recCount + 1;
                $items->iar_no            =  $iargetdate.'-'.str_pad($totalRec, 4, '0', STR_PAD_LEFT);
                $items->iar_date          =  $request->get('dateinspected');
            }
            

            $items->save();

            if($request->get('complete')){
                $data = DB::table('summaries')
                            ->where(['summaries.reference_id'=>$id,'summaries.type'=>'iar'])
                            ->update([
                                    'partial_quantity'      =>  '0'
                                ]);
            }else{
                $data = DB::table('summaries')
                            ->where(['summaries.reference_id'=>$id,'summaries.type'=>'iar'])
                            ->update([
                                    'partial_quantity'      =>  $request->get('p_quantity')
                                ]);
            }
            
            return response()->JSON(['data'=>$items]);
        }

    }
}
