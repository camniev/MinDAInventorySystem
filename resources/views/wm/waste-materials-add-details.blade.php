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

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
@if($lists->count()>0)
@foreach($lists as $l)
@endforeach

<form method="POST" action="{{ url('/waste-materials/save-waste-materials-details-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
						@csrf
						<table style="table-layout: fixed;">
							<tr>
								<td style="border: solid thin #fff;" class="pt-3 pl-2"><strong>WM NO.</strong></td>
								<td colspan="6" style="border: solid thin #fff" class="pt-3">{{$l->wm_num}}</td>
							</tr>
							<tr>
								<td align="center" colspan="7" class="p-3" style="border: solid thin #fff"><strong>WASTE MATERIAL REPORTS</strong></td>
							</tr>
							<tr>
								<td class="mt-5 pl-2" style="border: solid thin #fff"><strong>Entity Name:</strong></td>
								<td colspan="4" style="border: solid thin #fff">{{$l->entity_name}}</td>
								<td class="mt-5" style="border: solid thin #fff"><strong>Cluster:</strong></td>
								<td style="border: solid thin #fff">{{$l->cluster}}</td>
							</tr>
							<tr>
								<td class="mt-5 pl-2" style="border: solid thin #fff"><strong>Place of Storage:</strong></td>
								<td colspan="4" style="border: solid thin #fff">{{$l->storage}}</td>
								<td class="mt-5" style="border: solid thin #fff"><strong>Date:</strong></td>
								<td style="border: solid thin #fff">{{$l->wm_date}}</td>
							</tr>
								<td style="border: solid thin #fff;"  align="center" colspan="7" class="p-1"><strong>ITEMS FOR DISPOSAL</strong></td>
							</tr>
							<tr>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Item</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff;"><strong>Description</strong></td>
								<td align="center" colspan="3" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Records of Sale</strong></strong></td>
							</tr>
							<tr>
								<td colspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Official Receipt</strong></td>
							</tr>
							<tr>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>No</strong></td>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Date</strong></td>
								<td align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Amount</strong></td>
							</tr>
							<tr>
								<td valign="top"><input type="text" name="item" class="form-control p-1 m-1" style="width: 95%; text-align: center;" required></td>
								<td valign="top"><input type="text" name="quantity" class="form-control p-1 m-1" style="width: 95%; text-align: center;" required></td>
								<td valign="top"><input type="text" name="unit" class="form-control p-1 m-1" style="width: 95%; text-align: center;" required></td>
								<td valign="top"><textarea style="font-size: 14px; width: 95%;" name="description" class="form-control p-1 m-1" cols="20" rows="3" required></textarea></td>
								<td valign="top"><input type="text" name="num" style="width: 95%; text-align: center;" class="form-control p-1 m-1"></td>
								<td valign="top"><input type="date" name="or_date" style="width: 95%; text-align: center;" value="<?php echo date("Y-m-d");?>" class="form-control p-1 m-1"></td>
								<td valign="top"><input type="text" name="amount" style="width: 95%; text-align: center;" class="form-control p-1 m-1"></td>
							</tr>
							<tr>
								<td colspan="7">
									<a onclick="location = '{{url('/waste-materials')}}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>

									<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff"><span class="fa fa-floppy-o"></span> Save</button>
								</td>
							</tr>
						</table>

							<input type="hidden" id="wm_id" name="wm_id" value="">

							<script type="text/javascript">
						        var arr = (window.location.pathname).split("/");
								var val = (arr[arr.length-1]);
								//alert(val);
								document.getElementById("wm_id").value = val;
					         </script>

					</form>

@else
<script>
	//alert('No items that was inspected and accepted\n\nYou are redirected to Inspection and Acceptance');
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/waste-materials/add-new-waste-materials-entry') }}";
</script>


@endif



<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection