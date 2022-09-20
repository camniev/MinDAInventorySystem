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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>RE-ORDER STOCK LISTS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->

<table width="100%">
						<th colspan="6" style="font-family: cambria;text-align:center;"><strong>LIST OF SUPPLIES NEED TO RE-ORDER</strong></th>
						<tr>
							<td class="p-2" style="font-family: cambria; font-size: 12px;"align="left"><strong>STOCK CODE</strong></td>
							<td class="p-2" style="font-family: cambria; font-size: 12px;"align="left"><strong>DESCRIPTION</strong></td>
							<td class="p-2" style="font-family: cambria; font-size: 12px;"align="left"><strong>UNIT</strong></td>
							<td class="p-2" style="font-family: cambria; font-size: 12px;"align="left"><strong>EXPENSE CATEGORY</strong></td>
							<td width="120" class="p-2" style="font-family: cambria; font-size: 12px;"align="center"><strong>RE-ORDER POINT</strong></td>
							<td width="120" class="p-2" style="font-family: cambria; font-size: 12px;"align="center"><strong>AVAILABLE</strong></td>
						</tr>
						@foreach($data as $s)
						@if($s->available <= $s->reorderpoint)
						<tr>
							<td style="font-weight: normal;" id="stock_code_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;">{{$s->stock_code}}</td>
							<td style="font-weight: normal;" id="description_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;">{{$s->description}}</td>
							<td style="font-weight: normal;" id="unit_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;">{{$s->unit}}</td>
							<td style="font-weight: normal;" id="category_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;">{{$s->expense_category}}</td>
							<td style="font-weight: normal;" id="reorder_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;" align="center">{{$s->reorderpoint}}</td>
							<td style="font-weight: normal;" id="available_{{$s->id}}" class="p-3" style="font-family: cambria; font-size: 12px;" align="center">{{$s->available}}</td>
							
						</tr>
						@endif
						@endforeach
						@if($data->count() > 0)
						<tr>
							<td colspan="7" style="border-bottom:  1px solid #fff;">
									<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $data->links() }}</div>
								
							</td>
						</tr>
						@endif
						<tr>
							<td colspan="10">
								<span class="d-flex float-left ml-2 mb-2" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
							</td>
						</tr>
					</table>



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

		window.location = "{{ url('/export-excel-re-order-point') }}";
	}
</script>
@endsection