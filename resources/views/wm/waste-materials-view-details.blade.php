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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>WASTE MATERIALS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
@if($lists->count()>0)
@foreach($lists as $l)
@endforeach

<table style="table-layout: fixed;">
							<tr>
								<td style="border: solid thin #fff;" class="pt-3 pl-2"><strong>WM NO.</strong></td>
								<td colspan="6" style="border: solid thin #fff" class="pt-3">{{$l->wm_num}}</td>
							</tr>
							<tr>
								<td align="center" colspan="6" class="p-3" style="border: solid thin #fff"><strong>WASTE MATERIAL REPORTS</strong></td>
							</tr>
							<tr>
								<td class="mt-5 pl-2" style="border: solid thin #fff"><strong>Entity Name:</strong></td>
								<td colspan="4" style="border: solid thin #fff">{{$l->entity_name}}</td>
								<td class="mt-5" style="border: solid thin #fff"><strong>Cluster:</strong></td>
								<td colspan="1" style="border: solid thin #fff">{{$l->cluster}}</td>
							</tr>
							<tr>
								<td class="mt-5 pl-2" style="border: solid thin #fff"><strong>Place of Storage:</strong></td>
								<td colspan="4" style="border: solid thin #fff">{{$l->storage}}</td>
								<td class="mt-5" style="border: solid thin #fff"><strong>Date:</strong></td>
								<td colspan="1" style="border: solid thin #fff">{{$l->wm_date}}</td>
							</tr>
							<tr>
								<td align="center" colspan="7" class="p-1"><strong>ITEMS FOR DISPOSAL</strong></td>
							</tr>
							<tr>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Item</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
								<td align="center" colspan="3" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Records of Sale</strong></strong></td>
							</tr>
							<tr>
								<td colspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Official Receipt</strong></td>
							</tr>
							<tr>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>No</strong></td>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Date</strong></td>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Amount</strong></td>
							</tr>

							@foreach($lists as $i)
							<tr>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->item}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->quantity}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->unit}}</td>
								<td style="font-weight: normal; white-space: pre-wrap;" valign="top" align="left" class="p-3">{!!nl2br(str_replace(" ", " &nbsp;", $i->description))!!}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->receipt_num}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->receipt_date}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->amount}}</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="7">
										<span class="d-flex float-left mb-2 mt-2 ml-2" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>

										<a onclick="location = '{{ url('/waste-materials') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>
								</td>
							</tr>
						</table>

							<input type="hidden" id="wm_id" name="wm_id" value="">

							<script type="text/javascript">
						        var arr = (window.location.pathname).split("/");
								var val = (arr[arr.length-1]);
								//alert(val);
								document.getElementById("wm_id").value = val;
					         </script>
@else
<script>
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{url('/waste-materials/add-details-waste-materials-entry')}}/"+id;
</script>
@endif

<script>
	 function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-1]);

		window.location = "{{ url('/export-excel-waste-materials/excel-output') }}/"+id;
	}
	
</script>

<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection