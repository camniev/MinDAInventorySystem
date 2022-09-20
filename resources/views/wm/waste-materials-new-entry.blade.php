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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>WASTE MATERIALS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 50%;">

<!--Content-->
<form method="POST" action="{{ url('/waste-materials/save-waste-materials-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
						@csrf
						<table style="table-layout: fixed;">
							<tr>
								<td colspan="2" class="p-2" style="font-style: italic; background: #D8D8D8;"><strong>WASTE MATERIALS NEW ENTRY</strong></td>
							</tr>
							<tr>
								<td class="p-2"><strong>WM No:</strong></td>
								<td class="pr-2 mr-3"><input type="text" name="wm_num" style="width: 120px;" class="form-control mt-2 mb-2 pr-3" required></td>
							</tr>
							<tr>
								<td class="p-2"><strong>Entity Name:</strong></td>
								<td class="pr-2 mr-3"><input type="text" name="entity_name" style="width: 300px;" class="form-control mt-2 mb-2 pr-3" value="MINDANAO DEVELOPMENT AUTHORITY" required></td>
							</tr>
							<tr>
								<td class="p-2"  valign="center"><strong>Cluster:</strong></td>
								<td class="pr-2 mr-3"><input name="cluster" class="form-control mt-2 mb-2 pr-3" style="width: 160px;" value="101" required></td>
							</tr>

							<tr>
								<td class="p-2"  valign="center"><strong>Place of Storage:</strong></td>
								<td class="pr-2 mr-3"><input name="storage" class="form-control mt-2 mb-2 pr-3" style="width: 220px;" required></td>
							</tr>
							<tr>
								<td class="p-2"><strong>Date:</strong></td>
								<td class="pr-2 mr-3"><input type="date" name="wm_date" style="width: 150px;" class="form-control mt-2 mb-2 pr-3" value="<?php echo date("Y-m-d");?>" required></td>
							</tr>
							<tr>
								<td colspan="2">
									<a onclick="location = '{{ url('/waste-materials') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>

									<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff">Proceed <span class="fa fa-chevron-right"></span></button>
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