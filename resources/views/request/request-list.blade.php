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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Requisition and Issue Slip (RIS)</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;" >

<!--Content-->
<table border="1px #fff solid;">
	<tr>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 100px;  width: 150px; padding-top: 10px; padding-bottom: 10px;"><Strong>CLUSTER</Strong></td>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 100px;  width: 150px; padding-top: 10px; padding-bottom: 10px;"><Strong>PAP CODE</Strong></td>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 50px;  width: 150px; padding-top: 10px; padding-bottom: 10px;"><Strong>DIVISION</Strong></td>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 50px;  width: 150px; padding-top: 10px; padding-bottom: 10px;"><Strong>RIS NUMBER</Strong></td>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 50px;  width: 150px; padding-top: 10px; padding-bottom: 10px;"><Strong>STATUS</Strong></td>
		<td align="center" style="font-size: 11px; padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 50px;  width: 300px; padding-top: 10px; padding-bottom: 10px;"><Strong>ACTION</Strong></td>
	</tr>
		@if($lists->count()>0)
		@foreach($lists as $i)
								
	<tr>
									
	@if($i->complete==0)
		<td class="p-3" align="center" style="color: #045FB4;font-size: 11px; "><strong>{{$i->division}}</strong></td>
		<td class="p-3" align="center" style="color: #045FB4;font-size: 11px; "><strong>{{$i->papcode}}</strong></td>
		<td class="p-3" align="center" style="color: #045FB4;font-size: 11px; "><strong>{{$i->division}}</strong></td>
		<td class="p-3" align="center" style="color: #045FB4;font-size: 11px; "><strong>{{$i->ris_num}}</strong></td>
		<td class="p-3" align="center" style="color: #045FB4;font-size: 11px; "><strong>Pending</strong></td>
	@else
		<td class="p-3" align="center" style="font-size: 11px; font-weight: normal;">{{$i->division}}</td>
		<td class="p-3" align="center" style="font-size: 11px; font-weight: normal;">{{$i->papcode}}</td>
		<td class="p-3" align="center" style="font-size: 11px; font-weight: normal;">{{$i->division}}</td>
		<td class="p-3" align="center" style="font-size: 11px; font-weight: normal;">{{$i->ris_num}}</td>
		<td class="p-3" align="center" style="font-size: 11px; font-weight: normal;">Responded</td>
	@endif

		<td class="p-3 mb-5" width="200">
			<div class="row justify-content-center d-flex">

				<a href="{{ url('/request/respond-request/') }}/{{$i->division}}/{{$i->id}}" style="font-size: 11px; text-decoration: none; color: #fff;" class="btn btn-sm btn-primary mt-1 mb-1 mr-2"><span class="fa fa-pencil-square-o" title="Respond"></span><br/>Respond</a>

				<a href="{{ url('/request/view-detail') }}/{{$i->division}}/{{$i->id}}" style="font-size: 11px; text-decoration: none;  color: #fff;" class="btn btn-sm btn-success mt-1 mb-1"><span class="fa fa-eye"></span><br/>View</a>

				<form method="POST" onSubmit="return confirm('Do you want to delete this item/record?')" action="{{ url('/request/delete-request') }}/{{$i->division}}/{{$i->id}}" enctype="multipart/form-data" class="delete_form" style="display: inline-flex; margin-left: 5px;">
					@csrf
						<button class="btn btn-sm btn-danger" width="15px" height="15px" style="font-size: 11px; margin-left: 5px; margin-right: 10px; margin-top: 2px; color: #fff;" title="Delete"><span class="fa fa-trash-o" title="Delete"></span><br/>Delete</button>
				</form>
			</div>
		</td>
	</tr>
								
		@endforeach
		@endif
</table>

		@if($lists->count() > 0)
		<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $lists->links() }}</div>
		@endif
		<span class="d-flex float-right" style="margin-top: 10px;">
			<a onclick="location = '{{ url('/request/new-request') }}';" class="btn btn-sm btn-success mr-3 mb-3" style="
						color: #fff"><span class="fa fa-plus-square-o" style="color: #fff; vertical-align: middle;"></span> New Request</a>
		</span>


<!--Content End-->
    </div>

</section>

</div>

</div>

@endsection