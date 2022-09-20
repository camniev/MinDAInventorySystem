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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>WASTE MATERIALS LIST</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<table>
						<tr>
							<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>WM NO.</Strong></td>
							<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>ENTITY NAME</Strong></td>
							<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>CLUSTER</Strong></td>
							<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>PLACE OF STORAGE</Strong></td>
							<td align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>DATE</Strong></td>
							<td  align="center" style="border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;" class="p-2"><Strong>ACTION</Strong></td>
						</tr>

						@if($items->count()>0)
						@foreach($items as $i)
						<tr>
							@if($i->isok==0)
								<td valign="center" align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->wm_num}}</strong></td>
								<td valign="center" align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->entity_name}}</strong></td>
								<td valign="center" align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->cluster}}</strong></td>
								<td valign="center" align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->storage}}</strong></td>
								<td valign="center" align="center" class="p-3" style="color: #045FB4;"><strong>{{$i->wm_date}}</strong></td>

							@else
								<td style="font-weight: normal;" valign="center" align="center" class="p-3">{{$i->wm_num}}</td>
								<td style="font-weight: normal;" valign="center" align="center" class="p-3">{{$i->entity_name}}</td>
								<td style="font-weight: normal;" valign="center" align="center" class="p-3">{{$i->cluster}}</td>
								<td style="font-weight: normal;" valign="center" align="center" class="p-3">{{$i->storage}}</td>
								<td style="font-weight: normal;" valign="center" align="center" class="p-3">{{$i->wm_date}}</td>
							@endif

							<td class="pl-2" style="text-align: center;">

								<a href="{{ url('/waste-materials/append-details-waste-materials-entry') }}/{{$i->id}}" class="btn btn-sm btn-primary mt-1 mb-1 ml-2" style="color: #fff"><span class="fa fa-pencil-square-o" style="vertical-align: middle;"></span><br/>Update</a>

								<a href="{{ url('/waste-materials/view-details-waste-materials-entry') }}/{{$i->id}}" class="btn btn-sm btn-success  mt-1 mb-1 mr-1" style="color: #fff"><span class="fa fa-eye" style="vertical-align: middle;"></span><br/>View</a>

								<a href="{{url('/waste-materials/delete-waste-materials-list')}}/{{$i->id}}" class="btn btn-sm btn-danger  mt-1 mb-1 mr-1" style="color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o" style="vertical-align: middle;"></span><br/>Delete</a></td>
							</td>
						</tr>

						@endforeach
						@endif
					</table>
						@if($items->count() > 0)
							<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $items->links() }}</div>
						@endif
					<span class="d-flex float-right mb-2" style="margin-top: 10px;">
						<a onclick="location = '{{url('/waste-materials/add-new-waste-materials-entry')}}';" class="btn btn-sm btn-success mr-3" style="color: #fff"><span class="fa fa-plus-square-o" style="vertical-align: middle;"></span> New Entry</a>
					</span>	


<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection