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
@if(empty($summ))
<script>
	//alert('Page cannot be loaded\n\nReason: No Request found on your search query');
	window.location = "{{ url('/stock-card/404') }}";
</script>

@else


@if($summ->count()>0)
@foreach($summ as $i)
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
		<td align="center" valign="top" class=" p-3">{{ \Carbon\Carbon::parse($i->created_at)->format('F j, Y') }}		</td>

			<td  class=" p-3" align="center"  valign="center">Physical Count</td>
			<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
			<td  class=" p-3" align="center"  valign="center"></td>
			<td  class=" p-3" align="center"  valign="center"></td>
			<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
			<td  class=" p-3" align="center"  valign="center"></td>
	</tr>
	@if($summ->count()>0)
	@foreach ($summ as $i)
		<tr>
				<td align="center" valign="top" class=" p-3">{{ \Carbon\Carbon::parse($i->created_at)->format('F j, Y') }}</td>

				@if($i->type=='iar')
					<td  class=" p-3" align="center"  valign="center">IAR{{ $i->ris_num }}</td>
					<td  class=" p-3" align="center"  valign="center">{{ number_format($i->quantity, 0, '.', ',') }}</td>
					<td></td>
					<td></td>

						<span style="display: none;">{{$pb = $i->quantity + $pb}}</span>
									
					<td  class=" p-3" align="center"  valign="center">{{ number_format($pb, 0, '.', ',') }}</td>
					<td></td>
				@else
					<span style="display: none;">{{$pb = $pb - $i->quantity}}</span>

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
							
	</table>
	<div>

		<span class="d-flex float-left mt-3" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success mb-2 ml-2" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
							
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
			{{--
						<div class="card-header" style="color: #FF0000; font-size: 18px;"><Strong>No Records found!</Strong></div>
					<div class="mt-3 mb-3">Stock card is not currently assigned on this item</div>
					<div class="d-flex float-right"><a onclick="location = '{{ url('/stock-card') }}';" class="btn btn-sm btn-success  pl-5 pr-5" style="color: #fff"><span class="glyphicon glyphicon-chevron-left">Back</a></div>
			--}}

						<script>
							window.location = "{{ url('/stock-card/404') }}";
						</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endif

<!--Content End-->
    	</div>

    </section>

</div>

</div>

<!--Modal-->
<div class="modal fade" id="date-range" tabindex="-1" role="dialog"aria-labelledby="date-range-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog  modal-lg" style="width: 200px; height: 600px;" role="document">
    <div class="modal-content">
    	<div align="center"><img src="{{ url('/images/dsgdfgs456tvw45466w45656esry5y4.gif') }}"></div>
    	<hr id="cpb" style="display: block; margin-before: 0.5em; margin-after: 0.5em; margin-start: auto; margin-end: auto; overflow: hidden; border-width: 2px; float: left; background: #FF0000">
    </div>
  </div>
</div>
<script>
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