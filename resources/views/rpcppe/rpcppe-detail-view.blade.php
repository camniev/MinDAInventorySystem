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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Physical Count of Property, Plant and Equipment</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
@if($data->count()>0)
@foreach($data as $d)
@endforeach
	<input type="hidden" id="rpcppe_num" name="rpcppe_num" value="">

		<script type="text/javascript">
				       var arr = (window.location.pathname).split("/");
				var val = (arr[arr.length-1]);
				//alert(val);
				document.getElementById("rpcppe_num").value = val;
		</script>

<table>
	<th align="center" colspan="10" style="text-align: center; border-bottom: 1px solid #fff;">REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</th>
		<tr>
			<td colspan="10" align="center" style="border-bottom: 1px solid #fff;">Office Equipment</td>
		</tr>
		<tr>
			<td colspan="10" align="center" style="border-bottom: 1px solid #fff;">(Type of Property, Plant and Equipment)</td>
		</tr>
		<tr>
			<td colspan="10" align="center" style="border-bottom: 1px solid #fff;">As at <span id="date"></span></td>
		</tr>
		<tr style="height: 40px;"><td colspan="10" style="border-bottom: 1px solid #fff;"></td></tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px solid #fff;">Fund Cluster: {{$d->cluster}}</td>
		</tr>
		<tr>
			<input type="hidden" name="drereive" id="drereive" value="{{$d->date_receive}}">
			<td colspan="10" style="border-bottom: 1px solid #fff;">For which &nbsp;&nbsp;&nbsp;&nbsp; <strong>{{$d->requested_by}}, &nbsp;&nbsp;&nbsp;&nbsp; {{$d->requested_by_pos}}, &nbsp;&nbsp;&nbsp;&nbsp; {{$d->entity_name}}</strong> &nbsp;&nbsp;&nbsp;&nbsp;  is accountable, having assumed such accountability on (&nbsp;&nbsp;&nbsp;&nbsp; <span id="assumed_date"></span> &nbsp;&nbsp;&nbsp;&nbsp; ).</td>
		</tr>

				{{--<script src="https://momentjs.com/downloads/moment.min.js"></script>--}}
				<script>
					/*
					var date = new Date('{{$d->report_date}}'); 
					var url = window.location.pathname;
					var arr = (window.location.pathname).split("/");
					var requestMonth = (arr[arr.length-2]);
					//alert((date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());

					y = date.getFullYear();
					m = date.getMonth()+1;
					d = date.getDate();

					var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

					var n = requestMonth;
				       var m = n.split("-");
				       var	mm=m[0]-1;
				       var y = m[1];

					var months = [];
						 months.push(moment().month(mm).format("MMMM"));

					//alert(months[date.getMonth()] + " " + d + ", " + y);
					document.getElementById("assumed_date").innerHTML = months+' '+y;*/
					//var dt = {!!json_encode($d->date_receive)!!};
										
					//if(dt!==null){

						var date = new Date('{{$d->date_receive}}'); // Or your date here
										
						//alert((date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());

						y = date.getFullYear();
						m = date.getMonth() + 1;
						d = date.getDate();

						var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

						//alert(months[date.getMonth()] + " " + d + ", " + y);
						document.getElementById("assumed_date").innerHTML = months[date.getMonth()] + " " + d + ", " + y;
						//}
				</script>

		<tr>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C; border: 1px solid #A9D0F5;"><strong>Article</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Description</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Property Number</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Unit Measure</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Unit Value</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Quantity<br/>per<br/>Property Card</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Quantity<br/>per<br/>Physical Count</strong></td>
			<td align="center" colspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Shortage/Overage</strong></td>
			<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Remarks</strong></td>
		</tr>
		<tr>
			<td style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;" align="center"><strong>Quantity</strong></td>
			<td style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;" align="center"><strong>Value</strong></td>
		</tr>

		@if($data->count()>0)
		@foreach($data as $i)
		<tr>
			{{--<td class="p-3 pr-2 mt-2 mb-2">{{$i->article}}</td>--}}
			<td class="p-3 pr-2 mt-2 mb-2"></td>
			<td class="p-3 pr-2 mt-2 mb-2">{!!nl2br(str_replace(" ", " &nbsp;", $i->description))!!}</td>
			<td class="p-3 pr-2 mt-2 mb-2">{{$i->prop_num}}</td>
			<td class="p-3 pr-2 mt-2 mb-2">{{$i->quantity}} {{$i->unit}}</td>
			<td class="p-3 pr-2 mt-2 mb-2" align="right">{{number_format($i->cost, 2, '.', ',')}}</td>
			<td align="center" class="p-3 pr-2 mt-2 mb-2">{{$i->available}}</td>
			{{--<td class="p-3 pr-2 mt-2 mb-2">{{$i->physical_qty}}</td>--}}
			<td align="center" class="p-3 pr-2 mt-2 mb-2">{{$i->physical_count}}</td>
			{{--<td class="p-3 pr-2 mt-2 mb-2">{{$i->short_qty}}</td>--}}
			<td align="center" class="p-3 pr-2 mt-2 mb-2">{{$i->available - $i->physical_count}}</td>
			{{--<td class="p-3 pr-2 mt-2 mb-2">{{$i->short_value}}</td>--}}
			<td class="p-3 pr-2 mt-2 mb-2"></td>
			<td class="p-3 pr-2 mt-2 mb-2">{!!nl2br(str_replace(" ", " &nbsp;", $i->remarks))!!}</td>
		</tr>

		@endforeach
		@endif

		<tr>
		<td colspan="10" class="mb-5">
			<span class="d-flex float-left" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success ml-2 mb-2" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
			{{--			
			<a href="{{ url('/home') }}" class="btn btn-sm btn-primary mt-1 mb-2 mr-2" style="color: #fff; float: right;"><span class="fa fa-home"></span> Home</a>
			--}}

			<a href="{{ url('/report-on-the-physical-count-of-property-plant-and-equipment') }}" class="btn btn-sm btn-primary mt-1 mb-2 mr-2" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>

		</td>
	</tr>
							
</table>

@else
<div align="center">
	<div class="card row justify-content-center" style="width: 100%;">
		<div class="card-header">No records found on your search query.
			<div class="d-flex float-right">
				<div class="justify-content-center p-3">
					<a onclick="window.history.go(-1); return false;" class="btn btn-sm btn-danger pl-4 pr-4" style="color: #fff"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endif



<!--Content End-->
    </div>

</section>

</div>

</div>

<script>
	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();

	var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	//document.getElementById("date").innerHTML = months[n.getMonth()] + " " + d + ", " + y;
	document.getElementById("date").innerHTML = months[n.getMonth()] + " " + y;

	function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-2]);
		var person = (arr[arr.length-1]);
		var dr = $('input#drereive').value;
		

		//alert(dr);
		window.location = "{{ url('/export-excel-rpcppe-details/excel-output') }}/"+id+"/"+person+"/"+dr;
	}
</script>
@endsection