@extends('layouts.master')

@section('content')

<script>
		$(document).ready(function() {
		    var msg = '{{Session::get('alert')}}';
		    var exist = '{{Session::has('alert')}}';
		    if(exist){
		    	setTimeout(function () { alert(msg); }, 100);
		    }
		});
	 </script>


	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

<script>
$(document).ready(function(e){
	    $(function() {
	    $(".preload").fadeOut(100, function() {
	        $(".content").fadeIn(100);        
	    });
	});

});
</script>

<div class="content-wrapper">

<div class="content-wrapper" style="margin-left: 20px;">
    <section class="content-header">
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>REPAIR AND MAINTENANCE</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 60%;">

<!--Content-->
	@if($lists->count()>0)
	@foreach($lists as $l)

	<div class="card-header"><Strong>Repair and Maintenance</Strong></div>

					<table style="table-layout: fixed; border: none">
						<tr>
							<td colspan="4" style="width: 650px; border: 1px solid #fff" align="center">Republic of the Philippines</td>
						</tr>
						<tr>
							<td colspan="4" align="center" style="border: 1px solid #fff"><strong>MINDANAO DEVELOPMENT AUTHORITY</strong></td>
						</tr>
						<tr>
							<td colspan="4" style="font-style: italic; border: 1px solid #fff" align="center">Regions IX, X, XI, XII, XII, CARAGA and ARMM</td>
						</tr>
						<tr>
							<td colspan="4" class="p-4" style="font-style: italic; border: 1px solid #fff;"></td>
						</tr>
						<tr>
							<td colspan="4" class="p-2" style="font-style: italic; border: 1px solid #fff;"><strong>PRE-REPAIR</strong></td>
						</tr>
						<tr>
							<td class="p-2" style="border: 1px solid #fff;"><strong>Item:</strong></td>
							<td colspan="3" style="border: 1px solid #fff;">{{$l->item}}</td>
						</tr>
						<tr>
							<td class="p-2" style="border:  1px solid #fff;"><strong>ARE Sticker:</strong></td>
							<td colspan="3" style="border:  1px solid #fff;">{{$l->are_sticker}}</td>
						</tr>
						<tr>
							<td class="p-2" style="border:  1px solid #fff;"><strong>Findings:</strong></td>
							<td colspan="3" style="border:  1px solid #fff;">{{$l->pre_findings}}</td>
						</tr>

						<tr>
							<td  colspan="4" class="p-2" style="border: 1px solid #fff;"><strong>Recommendation:</strong></td>
							
						</tr>
						<tr>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td valign="top" colspan="3" style="border: 1px solid #fff;">{!!nl2br(str_replace(" ", " &nbsp;", $l->pre_recommendation))!!}</td>
						</tr>
						<tr>
							<td  colspan="4" class="p-3" style="border: 1px solid #fff;"></td>
						</tr>
						<tr>
							<td style="border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td align="center" class="pt-2 pb-2" style="border: 1px solid #fff;"><strong>PRE-INSPECTED BY:</strong></td>
						</tr>
						<tr>
							<td style="border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td align="center" class="pt-2" style="border: 1px solid #fff;">{{$l->pre_inspector}}</td>
						</tr>
						<tr>
							<td style="border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td align="center" class="pt-1 pb-2" style="border: 1px solid #fff;">{{$l->pre_date_inspector}}</td>
						</tr>


						<tr>
							<td colspan="4" class="p-2" style="font-style: italic; border: 1px solid #fff;"><strong>POST-REPAIR</strong></td>
						</tr>
						<tr>
							<td class="p-2" style="border: 1px solid #fff;"><strong>Job Order No.:</strong></td>
							<td colspan="3" style="border: 1px solid #fff;">{{$l->job_order}}</td>
						</tr>
						<tr>
							<td class="p-2" style="border:  1px solid #fff;"><strong>Date:</strong></td>
							<td colspan="3" style="border:  1px solid #fff;">{{$l->post_date_job}}</td>
						</tr>
						<tr>
							<td class="p-2" style="border:  1px solid #fff;"><strong>Invoice No.:</strong></td>
							<td colspan="3" style="border:  1px solid #fff;">{{$l->invoice}}</td>
						</tr>

						<tr>
							<td class="p-2" style="border: 1px solid #fff;"><strong>Date:</strong></td>
							<td colspan="3" style="border: 1px solid #fff;">{{$l->post_date_invoice}}</td>
							
						</tr>
						<tr>
							<td class="p-2" style="border: 1px solid #fff;"><strong>Amount per Job Order P </strong></td>
							<td style="border: 1px solid #fff;">{{ number_format($l->amount, 2, '.', ',') }}</td>
							<td class="p-2" style="border: 1px solid #fff;" align="right"><strong>Payable Amount P </strong></td>
							<td style="border: 1px solid #fff;">{{ number_format($l->payable, 2, '.', ',') }}</td>
						</tr>
						<tr>
							<td class="p-2" style="border:  1px solid #fff;"><strong>Findings:</strong></td>
							<td  colspan="3" style="border:  1px solid #fff;"></td>
						</tr>

						<tr>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td valign="top" colspan="3" style="border: 1px solid #fff;">{!!nl2br(str_replace(" ", " &nbsp;", $l->post_findings))!!}</td>
						</tr>
						<tr>
							<td  colspan="4" class="p-3" style="border: 1px solid #fff;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td style="font-style: italic; border: 1px solid #fff;"></td>
							<td align="center" class="pt-2 pb-2" style="border: 1px solid #fff;"><strong>INSPECTED BY:</strong></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td align="center" class="pt-2 pb-5">{{$l->post_inspector}}</td>
						</tr>
						<tr>
							<td colspan="4">
								<span class="d-flex float-left mt-2 mb-2" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>

								<a onclick="location = '{{ url('/repair-and-maintenance') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>
							</td>
						</tr>
					</table>
@endforeach
@endif


<!--Content End-->
    </div>

</section>

</div>

</div>

<script>
	
	function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-1]);

		window.location = "{{ url('/export-excel-repair-and-maintenance/excel-output') }}/"+id;
	}
</script>
@endsection