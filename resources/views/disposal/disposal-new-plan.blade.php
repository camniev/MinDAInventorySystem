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

    	<div  style="background-color: #fff; display: inline-block;">

<!--Content-->
<form method="POST" action="{{ url('/disposals/save-disposal-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
						@csrf
						<table style="table-layout: fixed;">
							<tr>
								<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 30%;">Disposal Plan for the Year</td>
								<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; width: 100%;">Item to be Disposed</td>
							</tr>
							<tr>
								<td align="center" class="p-2"><input class="form-control" type="text" name="cy" style="width: 80px; text-align: center" value="<?php echo date('Y') ?>"></td>
								<td align="center" class="p-2"><input class="form-control" type="text" name="item"></td>
							</tr>
							<tr>
								<td colspan="7">
									<a onclick="location = '{{ url('/disposals') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>

									<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff">Proceed <span class="fa fa-chevron-right" style="vertical-align: middle;"></span></button>
								</td>
							</tr>
						</table>
					</form>


<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection