<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Requests;
use App\Summary;
use App\User;
use App\ProjectCount;
use Carbon\Carbon;
use DB;

class RequestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$lists = DB::table('requests')
    				->orderBy('complete', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->onEachSide(2);

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	return view('request.request-list',compact('lists','reorderdata'));
    }

    public function new_request()
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

    	return view('request.request-new',compact('papcode','reorderdata'));
    }

    public function save_request(Request $request)
    {

        $user = Auth::user();

        $uname = $user->name;
        $udes = $user->designation;

        $data = new Requests();

        $data->division             =   $request->get('optselect');
        $data->papcode              =   $request->get('papcode');
        $data->respo_center         =   $request->get('respo_center');
        $data->office               =   $request->get('office');
        $data->purpose              =   $request->get('purpose');
        $data->requested_by         =   $uname;
        $data->requested_by_pos     =   $udes;
        $data->save();

        return redirect('/request/request-details/'.$data->division.'/'.$data->id);
    }

    public function new_details($id,$id2)
    {
        $data = DB::table('summaries')
                        ->where(['summaries.division'=>$id,'summaries.type'=>'iar'])
                        ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('request.request-details',compact('data','reorderdata'));
    }

    public function save_request_details(Request $request,$id)
    {
        $user = Auth::user();

        $uname = $user->name;
        $udes = $user->designation;

        $data = new Summary;

        $data->reference_id         =   $id;
        $data->entity_name          =   'MINDANAO DEVELOPMENT AUTHORITY';
        $data->cluster              =   '101';
        $data->series_id            =   $request->get('req_num');
        $data->division             =   $request->get('division');
        $data->papcode              =   $request->get('papcode');
        $data->respo_center         =   $request->get('responsibility');
        $data->stock_number         =   $request->get('stocknumber');
        $data->description          =   $request->get('description');
        $data->item                 =   $request->get('description');
        $data->unit                 =   $request->get('unit');
        $data->quantity             =   $request->get('quantity_1');
        $data->category             =   $request->get('category');
        $data->cost                 =   $request->get('cost');
        $data->type                 =   'ris';
        $data->consume_days         =   $request->get('consume');
        $data->requested_by         =   $uname;
        $data->requested_by_pos     =   $udes;
        $data->save();

        $sn = $request->get('stocknumber');
        $data_id = $request->get('req_num');

        $a = $request->get('bal');
        $b = $request->get('quantity_1');

        $c = $a-$b;

        $upd = DB::table('summaries')
                    //->where(['summaries.stock_number'=>$sn,'summaries.type'=>'iar'])
        ->where(['summaries.stock_number'=>$sn])
                    ->update(['available' => $c]);

        return redirect('/request/request-details-append/'.$data->division.'/'.$data_id.'/'.$sn);
    }

    public function add_details($id,$id2,$id3)
    {


        $data = DB::table('summaries')
                        ->where(['summaries.division'=>$id,'summaries.type'=>'iar'])
                        ->get();

        $lists = DB::table('summaries')
                        ->where(['summaries.series_id'=>$id2,'summaries.type'=>'ris'])
                        ->get();
        
        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('request.request-details-append',compact('data','lists','reorderdata'));
    }

    public function delete_item($division,$stocknum,$id,$request_quantity,$series_id)
    {

        $balance = DB::table('summaries')
                    ->where(['summaries.division'=>$division,'summaries.stock_number'=>$stocknum,'summaries.type'=>'iar'])
                    ->get();

        foreach ($balance as $i)
        {
            $tbalance = $i->available;
        }

        $update_balance = DB::table('summaries')
                    ->where(['summaries.division'=>$division,'summaries.stock_number'=>$stocknum,'summaries.type'=>'iar'])
                    ->update([
                        'available'=>(int)$tbalance+(int)$request_quantity,
                    ]);


        $delete = DB::table('summaries')
                    ->where(['summaries.id'=>$id])
                    ->delete();

                      
        return redirect('/request/request-details-append/'.$division.'/'.$series_id.'/'.$stocknum);
    }

    public function view_item($id,$id2)
    {

        $data = DB::table('summaries')
                        ->where(['summaries.division'=>$id,'summaries.series_id'=>$id2,'summaries.type'=>'ris'])
                        ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('request.request-view-details',compact('data','reorderdata'));
    }

    public function request_respond($division,$id)
    {
        $lists = DB::table('requests')
                        ->where(['requests.division'=>$division,'requests.id'=>$id])
                        ->get();

        $data = DB::table('requests')
                        ->join('summaries','summaries.series_id',"=",'requests.id')
                        ->where(['summaries.series_id'=>$id,'requests.id'=>$id])
                        ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        return view('request.request-update-per-item',compact('lists','data','reorderdata'));
    }


    public function update_item_data($id)
    {
        if(request()->ajax())
        {
            $items = DB::table('summaries')
                        ->where(['summaries.id'=>$id,'summaries.type'=>'ris'])
                        ->get();

            return response()->JSON(['data' => $items]);
        }
    }

    public function save_item_data(Request $request,$edit_id,$request_id)
    {
        if(request()->ajax())
        {

            $projectcounts = ProjectCount::firstOrCreate(
                    ['year' => Carbon::now()->format('Y')],
                    ['project_count' => 0]
                );
            $projectcounts->save();

            $countitem = ProjectCount::where('year', now()->year)->increment('project_count');

            $icscount = DB::table('project_counts')
                        ->where(['year' => Carbon::now()->format('Y')])
                        ->get(['project_count']);

            foreach ($icscount as $c) {
                $cc = $c->project_count;
            }

            $ics = Carbon::now()->format('Y').'-'.Carbon::now()->format('n').'-'.str_pad($cc, 5, '0', STR_PAD_LEFT);

            $items = DB::table('summaries')
                        ->where(['summaries.id'=>$edit_id,'summaries.series_id'=>$request_id,'summaries.type'=>'ris'])
                        ->update([
                                'available'         =>  $request->get('quantity_update'),
                                'isavail'           =>  $request->get('isavailable_u'),
                                'remarks'           =>  $request->get('remarked'),
                                'partialy_serve'    =>  $request->get('ispartiallyserve_u'),
                                'serve'             =>  $request->get('isfullyserve_u')
                                //'par_ics_series'    =>  'ICS-'.$ics
                        ]);

            $data = DB::table('summaries')
                        ->where(['summaries.id'=>$edit_id,'summaries.series_id'=>$request_id,'summaries.type'=>'ris'])
                        ->get();

            return response()->JSON(['data' => $data]);
        }

    }

    public function get_info_data($id)
    {
        if(request()->ajax())
        {
            $items = DB::table('requests')
                            ->where(['requests.id'=>$id])
                            ->get();

            return response()->JSON(['data' => $items]);
        }
    }

    public function update_info_data(Request $request,$id)
    {
       if(request()->ajax())
        {
            $data = DB::table('requests')
                            ->where(['requests.id'=>$id])
                            ->update([
                                    'requested_by'      =>  $request->get('requestby'),
                                    'requested_by_pos'  =>  $request->get('desigrequestby'),
                                    'date_request'      =>  $request->get('desigrequestbydate'),
                                    'approve_by'        =>  $request->get('approveby'),
                                    'approve_by_pos'    =>  $request->get('desigapproveby'),
                                    'date_approve'      =>  $request->get('desigapprovebydate'),
                                    'issued_by'         =>  $request->get('issuedby'),
                                    'issued_by_pos'     =>  $request->get('desigissuedby'),
                                    'date_issued'       =>  $request->get('desigissuedbydate'),
                                    'recieve_by'        =>  $request->get('receiveby'),
                                    'recieve_by_pos'    =>  $request->get('desigreceiveby'),
                                    'date_receive'      =>  $request->get('desigreceivebydate'),
                                    'purpose'           =>  $request->get('purpose')

                                    
                                ]);

            
            $co = $request->get('issuedby');
            $dissued = $request->get('desigissuedbydate');

            if(!empty($co)){

                $ris = Carbon::now()->format('Y').'-'.Carbon::now()->format('n').'-'.str_pad($id, 5, '0', STR_PAD_LEFT);

                $data = DB::table('requests')
                            ->where(['requests.id'=>$id])
                            ->update([
                                    'complete'      => '1',
                                    'ris_num'       => $ris 
                                    ]);

                $data = DB::table('summaries')
                            ->where(['summaries.reference_id'=>$id,'summaries.type'=>'iar'])
                            ->update([
                                    'ris_num'       => $ris, 
                                    'report_date'   =>   Carbon::parse($dissued)->format('n-Y')
                                    ]);
                $data = DB::table('summaries')
                            ->where(['summaries.series_id'=>$id,'summaries.type'=>'ris'])
                            ->update([
                                    'ris_num'       =>  $ris, 
                                    'report_date'   =>  Carbon::parse($dissued)->format('n-Y'),
                                    'date_receive'  =>  $request->get('desigreceivebydate'),
                                    'cy'            =>  Carbon::parse($dissued)->format('Y')
                                    ]);
            }

            $par_ics = DB::table('summaries')
                            ->where(['summaries.series_id'=>$id])
                            //->select(DB::raw('summaries.category as category'))
                            ->get();

            //$seriesnum = $par_ics->category;
            foreach ($par_ics as $num) {

                if($num->category == 'StockCard')
                {
                    $data = DB::table('summaries')
                                ->where(['summaries.series_id'=>$id])
                                ->update([
                                        'par_ics_series'       => 'ICS-'.$ris
                                        ]);
                }else{
                    $data = DB::table('summaries')
                                ->where(['summaries.series_id'=>$id])
                                ->update([
                                        'par_ics_series'       =>  'PPE-'.$ris
                                        ]);
                }
            }

            

            $items = DB::table('requests')
                            ->where(['requests.id'=>$id])
                            ->get();

            return response()->JSON(['data' => $items]);
        } 
    }

    public function delete_request($id,$id2)
    {

        $data = DB::table('summaries')
                    ->where(['summaries.division'=>$id,'summaries.series_id'=>$id2,'summaries.type'=>'ris'])
                    ->get();

            foreach ($data as $i) {
                $stocknumber    = $i->stock_number;
                $q              = $i->quantity;

                    $s = DB::table('summaries')
                                ->where(['summaries.stock_number'=>$stocknumber,'summaries.type'=>'iar'])
                                ->get();

                        foreach ($s as $k) {
                            $a  = $k->available;
                            $t = (int)$a+(int)$q;

                            $up = DB::table('summaries')
                                ->where(['summaries.stock_number'=>$stocknumber,'summaries.type'=>'iar'])
                                ->update([
                                    'available' => $t
                                ]);

                        }

            }

            $r = DB::table('requests')
                        ->where(['requests.id'=>$id2])
                        ->delete();

            $sd = DB::table('summaries')
                        ->where(['summaries.series_id'=>$id2,'summaries.type'=>'ris'])
                        ->delete();

            return redirect('/request');
    }

    public function get_stock($id,$id2)
    {

        if(request()->ajax())
        {
            $d = urldecode($id);
            $data = DB::table('summaries')
                        ->where(['summaries.division'=>$id2,'summaries.item'=>$id,'summaries.type'=>'iar'])
                        ->get();

            return response()->JSON(['data' => $data]);
        }
    }

    public function get_stock_balance($id)
    {
        if(request()->ajax())
        {

            $data = DB::table('summaries')
                        ->where(['summaries.id'=>$id])
                        ->get();

            return response()->JSON(['data' => $data]);
        }
    }

    public function details_get_stock_balance($stocknumber)
    {
        if(request()->ajax())
        {

            $data = DB::table('summaries')
                        ->where(['summaries.stock_number'=>$stocknumber,'summaries.type'=>'ris'])
                        ->get();

            $req = DB::table('summaries')
                        ->where(['summaries.stock_number'=>$stocknumber,'summaries.type'=>'ris'])
                        ->get();

            return response()->JSON(['data' => $data, 'req' => $req]);
        }
    }

    public function get_stock_par_ics_type($series)
    {
        if(request()->ajax())
        {

            $data = DB::table('summaries')
                        ->where(['summaries.series_id'=>$series])
                        ->get();

            return response()->JSON(['data' => $data]);
        }
    }
}
