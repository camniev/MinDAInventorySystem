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

    	<div  style="background-color: #fff; display: inline-block; width: 40%;">

<!--Content-->
<form method="POST" action="{{ url('/repair-and-maintenance/save-repair-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
	@csrf
	<table width="10%">
		<tr>
			<td colspan="2" class="p-2" style="font-style: italic; background: #D8D8D8"><strong>PRE-REPAIR</strong></td>
		</tr>
		<tr width="25">
			<td width="10%" class="p-2"><strong>Item:</strong></td>
			<td class="pr-2 mr-3"><input type="text" name="item" class="form-control mt-2 mb-2 pr-3" required></td>
		</tr>

		<tr>
			<td class="p-2"><strong>ARE Stricker:</strong></td>
			<td class="pr-2 mr-3"><input type="text" name="are_sticker" class="form-control mt-2 mb-2 pr-3" required></td>
		</tr>
		<tr>
			<td class="p-2"  valign="top"><strong>Findings:</strong></td>
			<td class="pr-2 mr-3"><textarea style="font-size: 14px;" name="prefindings" class="form-control mt-2 mb-2 pr-3" cols="15" rows="3" required></textarea></td>
		</tr>

		<tr>
			<td class="p-2"  valign="top"><strong>Recommendation:</strong></td>
			<td class="pr-2 mr-3"><textarea style="font-size: 14px;" name="prerecommendation" class="form-control mt-2 mb-2 pr-3" cols="15" rows="3" required></textarea></td>
		</tr>
			<tr>
				<td class="p-2"><strong>Inspected by:</strong></td>
				<td class="pr-2 mr-3"><input type="text" name="inspector" class="form-control mt-2 mb-2 pr-3" required></td>
			</tr>
			<tr>
				<td class="p-2"><strong>Date Inspected:</strong></td>
				<td class="pr-2 mr-3"><input type="date" name="date_inspected" class="form-control mt-2 mb-2 pr-3" value="<?php echo date("Y-m-d");?>" required></td>
			</tr>
			<tr>
				<td colspan="2">
					<a onclick="location = '{{ url('/repair-and-maintenance') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>

					<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff"><span class="fa fa-floppy-o"></span> Save</button>
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