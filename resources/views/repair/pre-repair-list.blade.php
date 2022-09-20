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

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<table>
	<tr>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>ITEM</Strong></td>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>ARE STICKER</Strong></td>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>FINDINGS</Strong></td>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>RECOMMENDATIONS</Strong></td>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>DATE</Strong></td>
		<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>ACTION</Strong></td>
	</tr>

	@if($items->count()>0)
	@foreach($items as $i)
	<tr>
		@if($i->repair_update==0)
			<td class="p-3" style="width: 150px;color: #045FB4;"><strong>{{$i->item}}</strong></td>
			<td class="p-3" style="width: 200px;color: #045FB4;"><strong>{{$i->are_sticker}}</strong></td>
			<td class="p-3" style="width: 150px;color: #045FB4;"><strong>{{$i->pre_findings}}</strong></td>
			<td class="p-3" style="width: 200px;color: #045FB4;white-space: pre-wrap;"><strong>{!!nl2br(str_replace(" ", " &nbsp;", $i->pre_recommendation))!!}</strong></td>
			<td class="p-3" style="width: 100px;" style="color: #045FB4;"><strong>{{$i->pre_date_inspector}}</strong></td>
		@else
			<td class="p-3" style="width: 150px;">{{$i->item}}</td>
			<td class="p-3" style="width: 200px;">{{$i->are_sticker}}</td>
			<td class="p-3" style="width: 150px;">{{$i->pre_findings}}</td>
			<td class="p-3" style="width: 200px;">{!!nl2br(str_replace(" ", " &nbsp;", $i->pre_recommendation))!!}</td>
			<td class="p-3" style="width: 130px;">{{$i->pre_date_inspector}}</td>
		@endif
			<td class="pl-2"><a href="{{ url('/repair-and-maintenance/update-repair-item') }}/{{$i->id}}" class="btn btn-sm btn-primary mt-1 mb-1 ml-2" style="color: #fff"><span class="fa fa-wrench" style="vertical-align: middle;"></span><br/>Post Repair</a>
				<a href="{{ url('/repair-and-maintenance/view-details') }}/{{$i->id}}" class="btn btn-sm btn-success  mt-1 mb-1 mr-1" style="color: #fff"><span class="fa fa-eye" style="vertical-align: middle;"></span><br/>View</a>
				<a href="{{ url('/repair-and-maintenance/delete-repair-item-list') }}/{{$i->id}}" class="btn btn-sm btn-danger  mt-1 mb-1 mr-1" style="color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o" style="vertical-align: middle;"></span><br/>Delete</a>
			</td>
		</tr>
		@endforeach
		@endif
						
	</table>

		@if($items->count() > 0)
			<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $items->links() }}</div>
		@endif
		<span class="d-flex float-right mb-3 mr-2" style="margin-top: 10px;">
			<a onclick="location = '{{ url('/repair-and-maintenance/new-repair-entry') }}';" class="btn btn-sm btn-success mr-3" style="color: #fff; vertical-align: middle;"><span class="fa fa-plus-square-o" style="vertical-align: middle;"></span> New Repair</a>
		</span>

<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection