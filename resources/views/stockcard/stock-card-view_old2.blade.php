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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">STOCK CARD</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
{{--
@if(empty($data))
<script>
	//alert('Page cannot be loaded\n\nReason: No Request found on your search query');
	//window.location = "{{ url('/stock-card/404') }}";
</script>

@else
--}}

@if($data->count()>0)
@foreach($data as $i)
@endforeach

<table border="1px #fff solid;" style="table-layout: fixed;">
	<tr>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><Strong>Entity Name:</Strong></td>
		<td colspan="3" class="pl-3">{{ $i->entity_name }}</td>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><Strong><strong>Fund Cluster:</strong></Strong></td>
		<td colspan="2"  class="pl-3">{{ $i->cluster }}</td>
		<input type="hidden" name="inspection_id" value="{{ $i->reference_id }}">
		{{--<input type="hidden" name="aid" value="{{ $i->acceptance_id }}">--}}
		<input type="hidden" name="stockcard_id" value="{{ $i->stock_number }}">

		<input type="hidden" name="h_entity" value="{{ $i->entity_name }}">
		<input type="hidden" name="cluster" value="{{ $i->cluster }}">
		<input type="hidden" name="opValue" value=" {{$i->description}}">
		<input type="hidden" name="requesting_department" value=" {{$i->division}}">
		<input type="hidden" name="respo_code" value=" {{$i->respo_center}}">
	</tr>
	<tr>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><strong>Item:</strong></td>
		<td colspan="3" class="pl-3">{{ $i->item }}</td>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><strong>Stock No.:</strong></td>
		<td colspan="2" class="pl-3">{{ $i->stock_number }}</td>
	</tr>
	<tr>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><strong>Description:</strong></td>
		<td colspan="3" class="pl-3">{{ $i->description }}</td>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><strong>Re-order Point:</strong></td>
		<td colspan="2" class="pl-3"></td>
	</tr>
	<tr>
		<td align="center" style="padding-right: 10px; padding-left: 10px; width: 100px;  padding-top: 10px; padding-bottom: 10px;"><strong>Unit of Measurement:</strong></td>
		<td colspan="6" class="pl-3">{{ $i->unit }}</td>
	</tr>
	<tr>
		<td rowspan="2" align="center" style="width: 150px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Date</strong></td>
		<td rowspan="2" align="center" style="width: 150px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Reference</strong></td>
		<td align="center" style="width: 80px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Receipt</strong></td>
		<td colspan="2" align="center" style="width: 150px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Issue</strong></td>
		<td align="center" style="width: 100px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Balance</strong></td>
		<td rowspan="2" align="center" class="pr-1" style="width: 150px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>No. of Days to Consume</strong></td>
	</tr>

	<tr>
		<td align="center" style="width: 80px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Quantity</strong></td>
		<td align="center" style="width: 80px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Quantity</strong></td>
		<td align="center" style="width: 80px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Office</strong></td>
		<td align="center" style="width: 80px; border: 1px solid #A9D0F5; background: #3b5998; color: #fff"><strong>Quantity</strong></td>
	</tr>
	<tr>
		<td align="center" valign="top" class=" p-3">{{ \Carbon\Carbon::parse($pdate)->format('F j, Y') }}</td>

			<td  class=" p-3" align="center"  valign="center">Physical Count</td>
			<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
			<td  class=" p-3" align="center"  valign="center"></td>
			<td  class=" p-3" align="center"  valign="center"></td>
			<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
			<td  class=" p-3" align="center"  valign="center"></td>
	</tr>
{{--
	@if($data->count()>0)
	@foreach ($data as $i)
		<tr>
				

				@if($i->type=='iar')
					<td align="center" valign="top" class=" p-3">{{ \Carbon\Carbon::parse($i->created_at)->format('F j, Y') }}</td>
					<td  class=" p-3" align="center"  valign="center">IAR{{ $i->ris_num }}</td>
					<td  class=" p-3" align="center"  valign="center">{{ number_format($i->quantity, 0, '.', ',') }}</td>
					<td></td>
					<td></td>

						<span style="display: none;">{{$pb = $i->quantity + $pb}}</span>
									
					<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
					<td></td>
				@else
					<span style="display: none;">{{$pb = $pb - $i->quantity}}</span>
					<td align="center" valign="top" class=" p-3">{{ \Carbon\Carbon::parse($i->created_at)->format('F j, Y') }}</td>
					<td  class=" p-3" align="center"  valign="center">RIS{{ $i->ris_num }}</td>
					<td></td>
					<td  class=" p-3" align="center"  valign="center">{{ number_format($i->quantity, 0, '.', ',') }}</td>
					<td  class=" p-3" align="center"  valign="center">{{ $i->division }}</td>
					<td  class=" p-3" align="center"  valign="center" style="color: #FF0000;">{{ number_format($pb, 0, '.', ',') }}</td>
					<td  class=" p-3" align="center"  valign="center">{{ $i->consume_days }}</td>
				@endif
										
			</tr>
									

		@endforeach
	@endif
	--}}					
	</table>
	<div>

		{{--<span class="d-flex float-left mt-3" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success mb-2 ml-2" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>--}}

		<span class="d-flex float-left mt-3" style="margin-top: 3px;"><button class="reptype btn btn-sm btn-success mb-2 ml-2" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
							
	</div>
	<div class="d-flex float-right mt-3 mb-5">
		<a onclick="location = '{{ url('/stock-card') }}';" class="btn btn-sm btn-primary pl-3 pr-3 mr-2 mb-2" style="color: #fff"><span class="glyphicon glyphicon-arrow-left" ></span> Back</a></div>
</div>

@else
<div class="pl-3 ml-3 pr-1 mr-1" style="margin-left: 10px; margin-right: 1px;">
	<div class="row justify-content-center">
		<div>
			<div class="card">
				<div class="card-header">

						<script>
							alert('Page cannot be loaded\n\nReason: No Request found on your search query');
							//window.location = "{{ url('/stock-card/404') }}";
						</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

{{--@endif--}}

<!--Content End-->
    	</div>

    </section>

</div>

</div>

<!--Modal-->
<div class="modal fade" id="report-type" tabindex="-1" role="dialog"aria-labelledby="date-range-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog  modal-lg" style="width: 300px; height: 100px;" role="document">
    <div class="modal-content">
    	<div class="modal-header"><span style="font-size: 24px; color: #0B2161; text-align: center;"><strong>Select Report Type</strong></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<div align="center" style="text-align: center; height: 100px; vertical-align: middle;">
    		<a href="#" class="admin btn btn-sm btn-success mr-5 mt-5"> Admin Copy</a>
    		<a href="#" class="finance btn btn-sm btn-primary mt-5"> Finance Copy</a>
    	</div>

    </div>
  </div>
</div>
<script>
	$(document).ready(function() {

		$(document).on("click", ".reptype", function() {
			
			$('#report-type').modal('show');
		});

		$(document).on("click",".admin", function() {
			$('#report-type').modal('hide');

			var url = window.location.pathname;
			var arr = (window.location.pathname).split("/");
			var id = (arr[arr.length-2]);
			var id2 = (arr[arr.length-1]);
			var id3 = (arr[arr.length-3]);

			window.location = "{{ url('/export-pdf-report/stock-card') }}/"+id3+"/"+id+"/"+id2;
		});

		$(document).on("click",".finance", function() {
			$('#report-type').modal('hide');
			
			var url = window.location.pathname;
			var arr = (window.location.pathname).split("/");
			var id = (arr[arr.length-2]);
			var id2 = (arr[arr.length-1]);
			var id3 = (arr[arr.length-3]);

			window.location = "{{ url('/export-pdf-report/stock-card-finance') }}/"+id3+"/"+id+"/"+id2;
		});

	});

	function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-2]);
		var id2 = (arr[arr.length-1]);
		var id3 = (arr[arr.length-3]);

		window.location = "{{ url('/export-pdf-report/stock-card') }}/"+id3+"/"+id+"/"+id2;

	}
</script>
@endsection