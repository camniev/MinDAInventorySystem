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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>DISPOSALS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
@if($lists->count()>0)
@foreach($lists as $l)
@endforeach

<table>
						<tr>
							<td colspan="3" class="p-2"><strong>{{$l->cy_date}} Disposal Plan</strong></td>
						</tr>
						<tr>
							<td colspan="3" class="p-2"><strong>{{$l->item}}</strong></td>
						</tr>
						<tr>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 400px;">Activity</td>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;"> Start Date</td>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;"> End Date</td>
						</tr>

						@if($lists->count()>0)
						@foreach($lists as $i)
						<tr>
							<td class="p-3" style="width: 400px;">{!!nl2br(str_replace(" ", " &nbsp;", $i->activity))!!}</td>
							<td class="p-3">{{$i->activity_date}}</td>
							<td class="p-3">{{$i->activity_date_end}}</td>
						</tr>

						@endforeach
						@endif

						<tr>
							<td>
								<span class="d-flex float-left mt-2 mb-2 ml-2" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff; vertical-align: middle;"></span> Export to Excel</button></span>
							</td>
							<td colspan="2">

								<a onclick="location = '{{ url('/disposals') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>
							</td>
						</tr>
						
					</table>
@else
<script>
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/disposals/add-disposal-activity-plan') }}/"+id;
</script>
@endif

<script>
	
	function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-1]);

		window.location = "{{ url('/export-excel-disposals/excel-output') }}/"+id;
	}
</script>


<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection