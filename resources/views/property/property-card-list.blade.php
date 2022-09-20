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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">PROPERTY CARD</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
@if($data->count() > 0)
	<table style="table-layout: fixed;">
			<tr style="border-bottom: 1px #fff solid;">
				<td align="center" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 100px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>Stock Number</Strong></td>
				<td align="center" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 100px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>RIS Number</Strong></td>
				<td align="left" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 200px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>Supplier</Strong></td>
				<td align="left" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 350px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>Description/Name</Strong></td>
				<td align="center" style="padding-right: 10px; padding-left: 10px; padding-right: 10px; border-bottom: 1px #fff solid; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C;  padding-top: 10px; padding-bottom: 10px; width: 100px;"><Strong>Unit Price</Strong></td>
				<td align="center" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 100px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>Quantity</Strong></td>
				<td colspan="3" align="center" style="padding-right: 10px; padding-left: 10px; background-color: #BDBDBD; color: #1C1C1C; width: 170px;  padding-top: 10px; padding-bottom: 10px; border-bottom: 1px #fff solid;"><Strong>Action</Strong></td>
			</tr>
			@foreach ($data as $i)
			<tr>
									
				@if(empty($i->ris_num))
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px; color: #045FB4;"><strong>{{ $i->stock_number }}</strong></td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px; color: #045FB4;"><strong>{{ $i->ris_num }}</strong></td>
					<td align= "left" valign= "center" style="padding-left: 10px; padding-right: 10px;  color: #045FB4;"><strong>{{ $i->supplier }}</strong></td>
					<td align= "left" valign= "center" style="padding-left: 10px; padding-right: 10px; width: 350px; color: #045FB4;"><strong>{{ $i->description }}</strong></td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px; color: #045FB4;"><strong>{{ number_format($i->cost, 0, '.', ',') }}</strong></td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px; color: #045FB4;"><strong>{{ $i->quantity }}</strong></td>
				@else
				
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px;">{{ $i->stock_number }}</td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px;">{{ $i->ris_num }}</td>
					<td align= "left" valign= "center" style="padding-left: 10px; padding-right: 10px;">{{ $i->supplier }}</td>
					<td align= "left" valign= "center" style="padding-left: 10px; padding-right: 10px; width: 350px;">{{ $i->description }}</td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px;">{{ number_format($i->cost, 2, '.', ',') }}</td>
					<td align= "center" valign= "center" style="padding-left: 10px; padding-right: 10px;">{{ $i->quantity }}</td>
				@endif

					<td style="width: 50px;">
						<div class="row justify-content-center d-flex">
						{{--
							<a href="{{ url('/property-card-lists/tag-accepted-item') }}/{{ $i->requesting_department }}/{{ $i->stock_id }}/{{ $i->inspection_id }}" style="text-decoration: none; margin-right: 10%;"><img src="{{ url('/images/new_button_uijk787hkjnkjhb6t5r7yugsd87f859346_960_7202.png') }}" width="45px" height="20px" style="margin-left: 5px;" title="New"></a>
										
							<a href="{{ url('/property-card-lists/tagging-update-entry') }}/{{ $i->description }}/{{$i->id}}" style="text-decoration: none; margin-right: 10%;"><span class="fa fa-pencil-square-o"  style="margin-left: 5px; vertical-align: middle;" title="Update"></span> Update</a>
						</div>

										
							<a href="{{ url('/property-card-lists/tagging-update-entry-details') }}/{{$i->item}}" class="btn btn-sm btn-primary mt-2 mb-2" style="text-decoration: none; margin-right: 10%; color: #fff"><span class="fa fa-pencil-square-o"  style="margin-left: 5px; vertical-align: middle;" title="Update"></span><br/>Update</a>
						--}}
						</div>

					<td colspan="2">
						<div class="row justify-content-center d-flex">
							{{--<a href = "{{ url('/property-code/view-stock-lists') }}/{{$i->stock_number}}" class="btn btn-sm btn-success ml-2 mr-2 mt-2 mb-2" style="text-decoration: none; margin-right: 10%; color: #fff" title="View Details"><span class="fa fa-eye" ></span><br/>View</a>--}}

							<button id="{{ $i->stock_number }}" class="date_range btn btn-sm btn-success ml-2 mr-2 mt-2 mb-2" style="text-decoration: none; margin-right: 10%; color: #fff" title="View Details"><span class="fa fa-eye" ></span><br/>View</button>

							<a href="{{ url('/uploads') }}/{{ $i->image }}" data-lightbox="{{ $i->image }}" data-title="{{ $i->description }}" style="text-decoration: none; margin-right: 10px; color: #fff;" class="btn btn-sm btn-info  mt-2 mb-2"><span class="fa fa-picture-o"  style="margin-right: 5px;" title="View Image"></span><br/>Image</a>
						</div>
					</td>
				</tr>
				@endforeach

			</table>

				@else
					<div class="container" style="position: relative;">
						<span style="color: #DF0101;"><strong>No record found on the database </strong></span>
					</div>
				@endif

				@if($data->count() > 0)
					<div class="justify-content-center ml-2" style="font-size: 10px; margin-top: 70px;">{{ $data->links() }}</div>
				@endif



<!--Content End-->
    	</div>

    </section>

</div>

</div>


<!--Modal-->

<div class="modal fade" id="date-range" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto; max-width: 50%"  role="document">
    <div class="modal-content">
      <div class="modal-header"><span style="font-size: 24px; color: #FF4000;"><strong>Property Card View</strong></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
      		<table width="100%">
      			<th colspan="2" style="font-size: 20px; color: #0B3861;" align="center" class="text-center">Select Start Date and End Date for Physical Counting</th>
      			<tr>
      				<td align="center" class="p-3" style="font-size: 14px; color: #0B3861;"><strong>Start Date</strong></td>
      				<td align="center" class="p-3" style="font-size: 14px; color: #0B3861;"><strong>End Date</strong></td>
      			</tr>
      			<tr>
      				<td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2"><input type="date" name="start_date" id="start_date" class="form-control" style="width: 200px;"></td>
      				<td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2"><input type="date" name="end_date" id="end_date" class="form-control" style="width: 200px;" onblur="checkDate();"></td>
      				<input type="hidden" id="stock_id" name="stock_id" value="">
      			</tr>
      			<tr>
      				<td colspan="2" class="p-3" style="border-top: solid thin #fff;"><span style="float: right;" class="mr-3"><a href="javascript:void(0);" class="go_btn btn btn-small btn-success"><span class="fa fa-search"></span> View</a></td>
      			</tr>

      		</table>
				
      		<div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	var o = false;

	$(document).ready(function() {

		$(document).on("click", ".date_range", function() {
			var stock 	= $(this).attr("id"); 

			var d = new Date(); 
	      	var m = d.getMonth()+1;
			o=true;
	      	if(m > 6){
	      		document.getElementById("start_date").value =new Date().getFullYear()+'-01-01';
	      		document.getElementById("end_date").value =new Date().getFullYear()+'-06-30';
	      		
	      	}else{
	      		document.getElementById("start_date").value =new Date().getFullYear()-1+'-07-01';
	      		document.getElementById("end_date").value =new Date().getFullYear()-1+'-12-31';
	      	}

			document.getElementById("stock_id").setAttribute('value',stock);
			
			$('#date-range').modal('show');
		});

	});

	function checkDate(){
		var d1 = $('input#start_date').val();
		var d2 = $('input#end_date').val();
		

		if(d2 <= d1){

			alert("End date should greater than Start Date");

			//$("input#start_date").val("");
			//$("input#end_date").val("");
			o=false;

			var d = new Date(); 
			var m = d.getMonth()+1;
	      	if(m > 6){
	      		document.getElementById("start_date").value =new Date().getFullYear()+'-01-01';
	      		document.getElementById("end_date").value =new Date().getFullYear()+'-06-30';
	      		
	      	}else{
	      		document.getElementById("start_date").value =new Date().getFullYear()-1+'-07-01';
	      		document.getElementById("end_date").value =new Date().getFullYear()-1+'-12-31';
	      	}
		}else{
			o=true;
		}

		
	}

	$(document).ready(function() {
		$(document).on("click", ".go_btn", function() {

			if(o){
				var stock 	= $('input#stock_id').val();
				var begin 	= $('input#start_date').val();
				var end 	= $('input#end_date').val();


				//alert(begin);
				url="{{ url('/property-card/view-stock-lists') }}/"+stock+"/"+begin+"/"+end;
				document.location.href=url;
				//alert(url);
				//$.get(url, function (data) {
        		//	console.log(data);

        		//});
			}else{
				alert('Please select a valid date range.');
			}
		});
	});

	function warnAlert(msg,duration)
    {
     var el = document.createElement("div");
     el.setAttribute("style","position:fixed;top:60%;left:45%;margin: 0 auto;background-color:#FF0000; border: solid thin #DF0101; border-radius: 3px; padding-left: 25px; padding-right: 25px; padding-top: 12px; padding-bottom: 12px; color: #ffffff;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;");
     el.innerHTML = msg;

     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
     $(el).hide().fadeIn('slow');
    }
</script>
@endsection