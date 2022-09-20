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

<div class="content-wrapper" style="margin-left: 20px;" style="width: 100%;">
    <section class="content-header">
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Inspection and Acceptance Details</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->

@if($lists->count()>0)

@foreach($lists as $l)
@endforeach

	<table style="table-layout: inherit; width: 100%">
		<tr>
			<td colspan="5" style="font-style: italic; font-size: 30px; font-family: Comic-Sans; color: #0404B4;" class="pr-3" align="right" ><Strong>Appendix 62</Strong></td>
		</tr>
		<tr>
			<td colspan="5" align="center" class="pt-3 pb-3 pl-5 pr-5" style="font-size: 20px; font-family: Comic-Sans"><strong>INSPECTION AND ACCEPTANCE REPORT</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="left" class="p-2" style="font-size: 12px; padding-right: 190px;border: 1px solid #A9D0F5;"><strong>Entity Name : {{ $l->entity_name}}</strong></td>
			<td colspan="2" align="left" class="pt-1 pb-1 pl-1" style="font-size: 12px;border: 1px solid #A9D0F5;"><strong>Fund Cluster : {{ $l->cluster}}</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>Supplier :</strong> {{ $l->supplier}}</div></td>
			<td colspan="2" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>IAR No. :</strong> {{ $l->iar_no}}</div></td>
		</tr>
		<tr>
			<td colspan="3" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>PO No./Date :</strong> {{ $l->po_number}}</div></td>
			<td colspan="2" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>Date : </strong>{{ $l->iar_date}}</div></td>
		</tr>
		<tr>
			<td colspan="3" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>Requisitioning Office/Dept. : </strong> {{ $l->division}}</div></td>
			<td colspan="2" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><div class="pl-1"><strong>Invoice No. : </strong>{{ $l->invoice_no}}</div></td>
		</tr>
		<tr>
			<td colspan="3" align="left" class="p-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><strong>Respo Center Code : </strong>{{ $l->papcode}}</td>
			<td colspan="2" align="left" class="p-2 mb-2" style="font-size: 12px;border: 1px solid #A9D0F5;"><strong>Date. : </strong>{{ $l->invoice_date}}</td>
		</tr>
		<tr>
			<table border="1px #fff solid;" style="table-layout: inherit; width: 100%">
				<tr>
					<td align="center" class="p-2" style="font-size: 12px; width: 25%;border: 1px solid #A9D0F5;  background: #3b5998 ; color: #fff"><strong>Stock/<br>Property No.</strong></td>
					<td align="center" class="p-2" style="font-size: 12px; width: 60%;border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff;"><strong>Description</strong></div></td>
					<td align="center" class="p-2" style="font-size: 12px; width: 25%;border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit/Cost</strong></td>
					<td align="center" class="p-2" style="font-size: 12px; width: 25%;border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
				</tr>
								
				@foreach($lists as $l)
				<tr>
					<td style="font-weight: normal;" align="center" class="p-3">{{ $l->stock_number}}</td>
					<td style="font-weight: normal;" align="left" class="p-3">{!!nl2br(str_replace(" ", " &nbsp;", $l->description))!!}</td>
					<td style="font-weight: normal;" align="center" class="p-3">{{ $l->cost}}</td>
					<td style="font-weight: normal;" align="center" class="p-3">{{ $l->quantity}}</td>
				</tr>
				@endforeach
			</table>
				</tr>
		</table>

		<div class="justify-content-center" style="margin-top: 10px;">
			<span class="d-flex float-left" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success mb-2 ml-2" style="color: #fff;  font-size: 12px;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>

			<span class="d-flex float-right mr-2 mb-5" style="margin-top: 3px;">
				<a href="javascript:history.back()" class="btn btn-sm btn-primary" style="color: #fff; font-size: 12px;"><span class="fa fa-chevron-left" style="color: #fff; vertical-align: middle;"></span> Back</a>
			</span>
		</div>


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
		var id = url.substring(url.lastIndexOf('/') + 1);

		window.location = "{{ url('/export-pdf-report/iar') }}/"+id;
	}
</script>
@endsection