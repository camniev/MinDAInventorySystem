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
<form method="POST" action="{{ url('/disposals/save-disposal-activity-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
						@csrf
						<table>
							<tr>
							<td colspan="3" class="p-2"><strong>{{$l->cy_date}} Disposal Plan</strong></td>
							</tr>
							<tr>
								<td colspan="3" class="p-2"><strong>{{$l->item}}</strong></td>
							</tr>
							<tr>
								<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 400px;">Activity</td>
								<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;">Start Date</td>
								<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;">End Date</td>
							</tr>
							<tr>
								<td valign="top" class="p-3" align="center"><textarea style="font-size: 14px;" name="activity" class="form-control p-3" rows="3" cols="10"></textarea></td>
								<td valign="top" class="p-3" align="center"><input type="date" name="activity_date" class="form-control" style="width: 190px;" value="<?php echo date('M-d-Y') ?>"></td>
								<td valign="top" class="p-3" align="center"><input type="date" name="activity_date_end" class="form-control" style="width: 190px;" value="<?php echo date('M-d-Y') ?>"></td>
							</tr>
							<tr>
									<td colspan="3">
										<a onclick="location = '{{ url('/disposals') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>

										<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff"><span class="fa fa-save"></span> Save</button>
									</td>
								</tr>
						</table>

						<input type="hidden" id="d_id" name="d_id" value="">

							<script type="text/javascript">
						        var arr = (window.location.pathname).split("/");
								var val = (arr[arr.length-1]);
								//alert(val);
								document.getElementById("d_id").value = val;
					         </script>
					</form>

@else
<script>
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/disposals/new-disposal-plan-entry') }}";
</script>

@endif

<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection