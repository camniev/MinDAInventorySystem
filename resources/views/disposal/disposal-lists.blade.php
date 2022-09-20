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
<table style="table-layout: fixed;">
							<tr>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 120px;"><div class="p-4">Disposal Plan for the Year</div></td>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 260px;"><div class="p-4">Items for Disposal</div></td>
								<td colspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 160px;"><div class="p-4">Action</div></td>
							</tr>

						@if($items->count()>0)
						@foreach($items as $i)
						<tr>
							@if($i->isok==0)
								<td align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->cy_date}}</strong></td>
								<td align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->item}}</strong></td>
							@else
								<td align="center" class="p-3">{{$i->cy_date}}</td>
								<td align="center" class="p-3">{{$i->item}}</td>
							@endif
							@if($i->isok==0)
								<td align="center" colspan="3" class="pl-2"><a href="{{ url('/disposals/update-disposal-activity-plan') }}/{{$i->id}}" class="btn btn-sm btn-primary mt-1 mb-1 ml-2" style="color: #fff"><span class="fa fa-pencil-square-o" style="vertical-align: middle;"></span><br/>Update</a>
							@else
								<td align="center" colspan="3" class="pl-2"><a href="JavaScript:Void(0)" onclick="alert('This transaction is already complete, editing is not possible!');" class="btn btn-sm btn-primary mt-1 mb-1 ml-2" style="color: #fff"><span class="fa fa-check-square-o" style="vertical-align: middle;"></span><br/>Completed</a>
							@endif

							<a href="{{ url('/disposals/remove-disposal-from-list-plan') }}/{{$i->id}}" class="btn btn-sm btn-danger  mt-1 mb-1 mr-2 ml-2" style="color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o" style="vertical-align: middle;"></span><br/>Delete</a>

							<a href="{{ url('/disposals/view-disposal-activity-plan') }}/{{$i->id}}" class="btn btn-sm btn-success  mt-1 mb-1 mr-2 ml-1" style="color: #fff"><span class="fa fa-eye" style="vertical-align: middle;"></span><br/>View</a>
							</td>

							</td>
						</tr>

						@endforeach
						@endif
						</table>
						@if($items->count() > 0)
							<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $items->links() }}</div>
						@endif
					<span class="d-flex float-right mb-2" style="margin-top: 5px;">
						<a onclick="location = '{{ url('/disposals/new-disposal-plan-entry') }}';" class="btn btn-sm btn-success mr-3" style="color: #fff"><span class="fa fa-plus-square-o" style="vertical-align: middle;"></span> New Entry</a>
					</span>	

<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection