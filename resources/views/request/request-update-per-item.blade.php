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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Requisition and Issue Slip (RIS)sss</div>

    	<div  style="background-color: #fff; display: inline-block;  width: 100%;">

<!--Content-->
@if($lists->count()>0)
@foreach($lists as $l)
@endforeach
			<div align="center">Republic of the Philippines</div>
						<div align="center">Office of the President</div>
						<div align="center" style="font-size: 18px; font-family: Copperplate Gothic Bold"><strong>MINDANAO DEVELOPMENT AUTHORITY</strong></div>
						{{--<form method="POST" action="{{ url('/requesition-and-issue-slip/save-update-request-detail-form') }}" accept-charset="utf-8" enctype="multipart/form-data">
	                		@csrf--}}
							<table border="1px #fff solid;" style="table-layout: fixed; width: 100%">
								<tr>
									<td class="p-3 pr-3" style="border-left: solid thin #A9D0F5;"><strong>ENTITY NAME</strong></td>
									<td colspan="5" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">MINDANAO DEVELOPMENT AUTHORITY</td>
									<td colspan="2" class="p-3 pr-3"><strong>FUND CLUSTER</strong></td>
				                	<td colspan="2" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">101</td>
								</tr>
								<tr>
									<td class="p-3 pr-3" style="border-left: solid thin #A9D0F5;"><strong>DIVISION</strong></td>
				                	<td colspan="5" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">{{$l->division}}</td>
									<td colspan="2" class="p-3 pr-3"><strong>RESPONSIBILITY CENTER CODE</strong></td>
				                	<td colspan="2" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">{{$l->respo_center}}</td>
				                	<input type="hidden" name="division" value="{{$l->division}}">
				                	<input type="hidden" id="req_series" name="req_series" value="">
										<script type="text/javascript">
											var arr = (window.location.pathname).split("/");
											var val = (arr[arr.length-1]);
											//alert(val);
											document.getElementById("req_series").value = val;
										</script>
				                </tr>
								<tr>
									<td class="p-3 pr-3" style="border-left: solid thin #A9D0F5;"><strong>OFFICE</strong></td>
				                	<td colspan="5" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">{{$l->office}}</td>
									<td colspan="2" class="p-3 pr-3"><strong>RIS NO.</strong></td>
				                	
									<td colspan="2" class="p-3 pr-3" style="border-right: solid thin #A9D0F5;">{{$l->ris_num}}</td>
				                		
								</tr>
								<input type="hidden" name="entity_name" value="MINDANAO DEVELOPMENT AUTHORITY">
								<input type="hidden" name="division" value="{{$l->division}}">
								<input type="hidden" name="office" value="{{$l->office}}">
								<input type="hidden" name="responsibility" value="{{$l->respo_center}}">
								<input type="hidden" name="papcode" value="{{$l->papcode}}">

								
								@if($lists->count()>0)
				                	@foreach($lists as $r)
				                	@endforeach
									<input type="hidden" name="ris_num" value="{{$r->ris_num}}">
								@else
									<input type="hidden" name="ris_num" value="">
								@endif

								


								<input type="hidden" id="req_num" name="req_num" value="">

								<script type="text/javascript">
				         				var arr = (window.location.pathname).split("/");
										var val = (arr[arr.length-1]);
										//alert(val);
										document.getElementById("req_num").value = val;
			         			</script>
								<tr>
									<td colspan="4" class="p-3 pr-3 justify-content-center" align="center" style="border-left: solid thin #A9D0F5; border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Requisition</strong></td>
									<td class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock Available?</strong></td>
									<td colspan="2" class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Issue</strong></td>
									<td colspan="3" class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Status</strong></td>
								</tr>
								<tr>
									<td class="p-3 pr-3" align="center" style="border-left: solid thin #A9D0F5; border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock Number</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Yes</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Remarks</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Partially Serve</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Fully Serve</strong></td>
									<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Action</strong></td>
								</tr>
								

								@if($data->count()>0)
								@foreach($data as $i)
								<tr id="item{{$i->id}}">
									<td class="p-3">{{$i->stock_number}}</td>
									<td class="p-3">{{$i->unit}}</td>
									<td class="p-3" style="white-space: pre-wrap;">{!!nl2br(str_replace(" ", " &nbsp;", $i->item))!!}</td>
									<td class="p-3" align="center"><span id="quantity_{{$i->id}}"></span></td>
									<td class="p-3 pr-3" align="center"><input style="text-align: center;" type="checkbox" class="pref mt-3 mb-3" id="isavailable" name="isavailable" {{ $i->isavail==1 ? 'checked' : '' }} onclick="return false;"></td>

									<td class="p-3" align="center"><span id="bal_{{$i->id}}"></span></td>
									<td class="p-3" align="center">{{$i->remarks}}</td>
									<td class="p-3 pr-3" align="center"><input style="text-align: center;" type="checkbox" id="ispartiallyserve" name="ispartiallyserve" value="" class="mt-3 mb-3" {{ $i->partialy_serve==1 ? 'checked' : '' }} onclick="return false;"></td>
									<td class="p-3 pr-3" align="center"><input style="text-align: center;" type="checkbox" id="isfullyserve" name="isfullyserve" value="" class="mt-3 mb-3" {{ $i->serve==1 ? 'checked' : '' }} onclick="return false;"></td>
									<td align="center">
										<a onclick="location = '{{ url('/requesition-and-issue-slip/update-per-request-detail-form' ) }}/{{$i->division}}/{{$i->id}}/'+val;"></a>

							<button type="button" class="btn btn-sm btn-success" id="edit-item" data-item-id="1" value="{{$i->id}}" style="color: #fff; font-family: 'Calibri';"><span class="fa fa-pencil-square-o"></span> Update</button>

							<input type="hidden" name="editid" id="editid" data-item-id="1" value="{{$i->id}}" >
										
										<script>
											var it = {!! json_encode($i->stock_number) !!};
											var di = {!! json_encode($i->id) !!};
											url = "{{url('/request/details-get-stock-balance')}}/"+it;
											$.get(url, function (data) {
       											console.log(data);
       											var q='quantity_'+{!! json_encode($i->id) !!};
       											var b='bal_'+{!! json_encode($i->id) !!};
       											
       											document.getElementById(q).innerHTML=data.data[0].quantity;
		       									document.getElementById(b).innerHTML=data.req[0].available;

		       									//alert(data.data[1].quantity);
		       									
       										});
									</script>

									</td>
								</tr>
								@endforeach
								@endif
									
								<tr>
									<td colspan="10" class="mb-5">
										<span class="d-flex float-left mb-2 mt-2" style="margin-top: 10px;">
											<a href="javascript:void(0);" class="update_info btn btn-sm btn-warning ml-3" style="color: #0431B4"><span class="fa fa-user-circle-o"></span> Additional Info</a>
										</span>
										<span class="d-flex float-right mb-2 mt-2" style="margin-top: 10px;">										
											{{--<a onclick="location = '{{ url('/requisitions-and-issue-slip') }}';" class="btn btn-sm btn-primary pl-4 pr-4" style="color: #fff"><span class="fa fa-chevron-left"></span> Back</a>--}}

											<a onclick="location = '{{ url('/request') }}';" class="btn btn-sm btn-primary pl-4 pr-4 mr-3" style="color: #fff"><span class="fa fa-chevron-left"></span> Back</a>
										</span>
									</td>
								</tr>
						</table>

<!--Content End-->
    </div>

</section>

</div>

</div>
@else
<!--
<div class="p-3 ml-3 pr-1 mr-1" style="margin-left: 10px; margin-right: 1px;">
	<div class="row justify-content-center">
		<div>
			<div class="card">
				<div class="card-header">
					<div class="card-header" style="color: #FF0000; font-size: 18px;"><Strong>No Items found!</Strong></div>
					<div class="mt-3 mb-3">No available items listed on your division so far</div>
					<div class="d-flex float-right"><a onclick="location = '{{ url('/requisitions-and-issue-slip') }}';" class="btn btn-sm btn-primary" style="color: #fff;"><span class="glyphicon glyphicon-menu-left"></span>Back</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<script>
	//alert('No items that was inspected and accepted\n\nYou are redirected to Inspection and Acceptance');
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/requesition-and-issue-slip/add-request-detail-form') }}/"+val+"/"+id;
</script>

@endif
@if($data->count()>0)
<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: 100%; max-width: auto;"  role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #0B4D5E;">
        <h5 class="modal-title" id="edit-modal-label">Update Item for&nbsp;<span id="item_name" name="item_name" style="color: #045FB4;"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>

				<table border="1px #fff solid;" style="table-layout: fixed; width:100%;">
								
					<input type="hidden" id="division_id" name="division_id" value="">
					<input type="hidden" id="detail_id" name="detail_id" value="">
					<input type="hidden" id="request_id" name="request_id" value="">

						<script type="text/javascript">
			         		var arr = (window.location.pathname).split("/");
							var val = (arr[arr.length-3]);
							var val2 = (arr[arr.length-2]);
							var val3 = (arr[arr.length-1]);
									//alert(val3);
							document.getElementById("division_id").value = val;
							document.getElementById("detail_id").value = val2;
							document.getElementById("request_id").value = val3;
			         	</script>

						<tr>
							<td colspan="4" class="p-3 pr-3 justify-content-center" align="center" style="border-left: solid thin #A9D0F5; border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Requisition</strong></td>
							<td class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock Available?</strong></td>
							<td colspan="2" class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Issue</strong></td>
							<td colspan="3" class="p-3 pr-3 justify-content-center" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Status</strong></td>
						</tr>
						<tr>
							<td class="p-3 pr-3" align="center" style="border-left: solid thin #A9D0F5; border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock Number</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Yes</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Remarks</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Partially Serve</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Fully Serve</strong></td>
							<td class="p-3 pr-3" align="center" style="border-right: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Action</strong></td>
						</tr>
								
						<tr>
							<td class="p-3"><span name="stock_num" id="stock_num"></td>
							<td class="p-3"><span name="unit" id="unit"></td>
							<td class="p-3" style="white-space: pre-wrap;"><span name="description" id="description"></span></td>
							<td class="p-3" align="center"><span name="quantity" id="quantity"></td>
							<td class="p-3 pr-3" align="center"><input style="text-align: center;" type="checkbox" class="mt-3 mb-3" id="isavailable_u" name="isavailable_u" class="mt-3 mb-3" value="1" {{ $i->isavail==1 ? 'checked' : '' }}>

									</td>
							<td class="p-3" align="center"><input type="number" id="quantity_update" name="quantity_update" class="form-control" style="width: 80px;"></td>
							<td class="p-3" align="center"><textarea id="remarked" name="remarked" class="form-control" rows="1" cols="1"></textarea></td>
							<td class="p-3 pr-3" align="center"><input style="text-align: center;" class="ischeck" type="checkbox" id="ispartiallyserve_u" name="ispartiallyserve_u" value="1" class="mt-3 mb-3" {{ $i->partialy_serve==1 ? 'checked' : '' }}>

							</td>
							
								<td class="p-3 pr-3" align="center"><input style="text-align: center;" class="ischeck" type="checkbox" id="isfullyserve_u" name="isfullyserve_u" onclick="checkFunction();" value="1" class="mt-3 mb-3" {{ $i->serve==1 ? 'checked' : '' }}>

								</td>
								<td align="center">
									<button class="update btn btn-sm btn-primary btn-sm mr-3 mt-3 mb-3" style="color: #fff;" data-id=""><span class="fa fa-floppy-o"></span> Save</button>
								</td>
									<input type="hidden" id="division" name="division" value="">
									<input type="hidden" id="detail_id" name="detail_id" value="">
									<input type="hidden" id="request_id" name="request_id" value="">
									<input type="hidden" id="qq" name="qq" value="">
							</tr>
				</table>

      		<div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<!-- Attachment Modal Update Request -->

<div class="modal fade" id="update-request-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: 70%"  role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #0B4D5E;">
        <h5 class="modal-title" id="edit-modal-label" style="color: #fff; font-size: 18px;">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
      	<table>
      		<tr>
      			<td></td>
      			<td class="p-2"><strong>Requested by:</strong></td>
      			<td class="p-2"><strong>Approved by:</strong></td>
      			<td class="p-2"><strong>Issued by:</strong></td>
      			<td class="p-2"><strong>Received by:</strong></td>
      		</tr>
      		<tr>
      			<td class="pl-4">Name:</td>
      			<td><input type="text" class="form-control m-2" name="requestby" id="requestby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="approveby" id="approveby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="issuedby" id="issuedby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="receiveby" id="receiveby" style="width: 200px;"></td>
      		</tr>
      		<tr>
      			<td class="pl-4">Designation:</td>
      			<td><input type="text" class="form-control m-2" name="desigrequestby" id="desigrequestby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="desigapproveby" id="desigapproveby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="desigissuedby" id="desigissuedby" style="width: 200px;"></td>
      			<td><input type="text" class="form-control m-2" name="desigreceiveby" id="desigreceiveby" style="width: 200px;"></td>
      		</tr>
      		<tr>
      			<td class="pl-4">Date:</td>
      			<td><input type="date" class="form-control m-2" name="desigrequestbydate" id="desigrequestbydate" style="width: 200px;" value="<?php echo date("Y-m-d"); ?>"></td>
      			<td><input type="date" class="form-control m-2" name="desigapprovebydate" id="desigapprovebydate" style="width: 200px;" value="<?php echo date("Y-m-d"); ?>"></td>
      			<td><input type="date" class="form-control m-2" name="desigissuedbydate" id="desigissuedbydate" style="width: 200px;" value="<?php echo date("Y-m-d"); ?>"></td>
      			<td><input type="date" class="form-control m-2" name="desigreceivebydate" id="desigreceivebydate" style="width: 200px;" value="<?php echo date("Y-m-d"); ?>"></td>
      		</tr>
      		<tr>
      			<td valign="center" class="pl-4">Purpose:</td>
      			<td colspan="3"><textarea style="font-size: 14px;" class="form-control m-2" name="purpose" id="purpose" cols="10" rows="4"></textarea></td>
      			<td valign="bottom">
      				<button class="save_info btn btn-sm btn-primary btn-sm mr-3 mt-3 mb-3 float-right pl-3 pr-3" style="color: #fff;" data-id=""><span class="fa fa-floppy-o"></span> Save</button>
      			</td>
      		</tr>
      	</table>

      	<div class="modal-footer"></div>
    </div>
  </div>
</div>


@endif
<script type="text/javascript">

$(document).ready(function() {

	$(document).on("click", ".btn", function() {
		  	var id = $(this).val(); 
		  	var arr = (window.location.pathname).split("/");
			var val = (arr[arr.length-3]);
			var val2 = (arr[arr.length-2]);
			var val3 = (arr[arr.length-1]);

			//alert(id);
		  	url = "{{ url('/request/update-item-detail') }}/"+id;

        	$.get(url, function (data) {
        		console.log(data);


        		$('span#stock_num').html(data.data[0].stock_number);
        		$('span#unit').html(data.data[0].unit);
	            $('span#description').html(data.data[0].item);
	            $('span#item_name').html(data.data[0].item);
	            $('span#quantity').html(data.data[0].quantity);
	            $('textarea#remarked').val(data.data[0].remarks);
	            $('input#quantity_update').val(data.data[0].available);
	            $('span#division').html(val2);
	            $('input#detail_id').val(id);
	            $('input#request_id').val(val3);
	            $('input#qq').val(data.data[0].quantity);
	            //$('input#risnumb').val(data.data[0].ris_num);

	            if(data.data[0].quantity>=1){
	            	document.getElementById('isavailable_u').checked=true;
	            }else{
	            	document.getElementById('isavailable_u').checked=false;
	            }

	            if(data.data[0].partialy_serve==1){
	            	document.getElementById('ispartiallyserve_u').checked=true;
	            }else{
	            	document.getElementById('ispartiallyserve_u').checked=false;
	            }

	            if(data.data[0].serve==1){
	            	document.getElementById('isfullyserve_u').checked=true;
	            }else{
	            	document.getElementById('isfullyserve_u').checked=false;
	            }


	            //var empris = $('input#risnumb').val();

	            //if(!empris){
	            //	warnAlert("RIS Number is currently empty!",2000);
	            //}else{
	            	$('#edit-modal').modal('show');
	        	//}
	    }) 

	});

});

// 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
$(document).on("click", ".update" , function(e) {

	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
  	var edit_id 	=  $('input#detail_id').val();
  	var request_id 	=  $('input#request_id').val();
  	var val 		= (arr[arr.length-1]);
  	var risnumber	=  $('input#risnumb').val();
  	//var rq 			= document.getElementById('quantity').innerHTML;

 	

  	if (document.getElementById('isavailable_u').checked) {
  			var isavail_u 			= 1;
        } else {
        	var isavail_u 			= 0;
      	}

    if (document.getElementById('ispartiallyserve_u').checked) {
  			var partialy_serve_u 			= 1;
        } else {
        	var partialy_serve_u 			= 0;
      	}

    if (document.getElementById('isfullyserve_u').checked) {
  			var serve_u 			= 1;
  			//alert(rq);
        } else {
        	var serve_u 			= 0;
      	}

    var bqty				= $('input#qq').val();
 	var qty_u 				= $('input#quantity_update').val();
 	var remarks_u 			= $('textarea#remarked').val();

 	
 	var c = Math.abs(bqty) - Math.abs(qty_u);
	//alert(remarks_u);
 	
 	$.ajax({
      url: "{{ url('/request/save-respond-detail') }}/"+edit_id+"/"+request_id,
      type: "POST",
      data: {_token: CSRF_TOKEN,isavailable_u: isavail_u,quantity_update: qty_u,remarked: remarks_u,ispartiallyserve_u: partialy_serve_u,isfullyserve_u: serve_u},
      success: function(response){
  
  			console.log(response);

      	//response = JSON.parse(JSON.stringify(response))

      		if(response.data[0].isavail==1){
      			var inp_isavail ='<input style="text-align: center; margin-left: -15px;" type="checkbox" class="pref mt-3 mb-3" id="isavailable" name="isavailable" checked onclick="return false;">'
      		}else{
      			var inp_isavail = '<input style="text-align: center; margin-left: -15px;" type="checkbox" class="pref mt-3 mb-3" id="isavailable" name="isavailable" onclick="return false;">'
      		}

      		if(response.data[0].partialy_serve==1){
      			var inp_ispartial ='<input style="text-align: center; margin-left: -15px;" type="checkbox" id="ispartiallyserve" name="ispartiallyserve" class="mt-3 mb-3" checked onclick="return false;">'
      		}else{
      			var inp_ispartial = '<input style="text-align: center; margin-left: -15px;" type="checkbox" id="ispartiallyserve" name="ispartiallyserve" class="mt-3 mb-3" onclick="return false;">'
      		}

      		if(response.data[0].serve==1){
      			var inp_isfull = '<input style="text-align: center; margin-left: -15px;" type="checkbox" id="isfullyserve" name="isfullyserve" class="mt-3 mb-3" checked onclick="return false;">'
      		}else{
      			var inp_isfull = '<input style="text-align: center; margin-left: -15px;" type="checkbox" id="isfullyserve" name="isfullyserve" class="mt-3 mb-3" onclick="return false;">'
      		}

      		var items = '<tr id="item' + response.data[0].id + '"><td class="p-3">' + response.data[0].stock_number + '</td><td class="p-3">' + response.data[0].unit + '</td><td class="p-3" style="white-space: pre-wrap;">' + response.data[0].description + '</td><td  class="p-3" align="center">' + response.data[0].quantity + '</td><td align="center">'+inp_isavail+'</td><td class="p-3"  align="center">' + response.data[0].quantity + '</td><td class="p-3" align="center">' + response.data[0].remarks + '</td><td class="p-3" align="center">'+inp_ispartial+'</td><td class="p-3" align="center">'+inp_isfull+'</td><td align="center"><button type="button" class="btn btn-sm btn-success" id="edit-item" data-item-id="1" value="'+response.data[0].id+'" style="color: #fff;"><span class="fa fa-pencil-square-o"></span> Update</button></td>';

      		//document.getElementById("risnumb").value=risnumber;

      	$("#item" + edit_id).replaceWith( items );

      	//tempAlert("Changes successfully save.",2000);

      	swal("Saving information", "Changes successfully save.", "success");

        $('#edit-modal').modal('hide');

      },
      error: function(err){
      	//alert("Error processing request, please try again");
      	//alert(JSON.stringify(err));

      	swal("Oppppsss!", "Some needed information is empty. Unable to process your request!", "error");
      }
    });
 	e.preventDefault();
	
});


//Modal Info
$(document).ready(function() {
	$(document).on("click", ".update_info" , function(e) {
		var request_id 	=  $('input#request_id').val();

		//alert(request_id);

		url="{{ url('/request/update-personnel-detail') }}/"+request_id;
		
		$.get(url, function (data) {
			console.log(data);
        		$('input#requestby').val(data.data[0].requested_by);
        		$('input#approveby').val(data.data[0].approve_by);
	            $('input#issuedby').val(data.data[0].issued_by);
	            $('input#receiveby').val(data.data[0].recieve_by);
	            $('input#desigrequestby').val(data.data[0].requested_by_pos);
	            $('input#desigapproveby').val(data.data[0].approve_by_pos);
	            $('input#desigissuedby').val(data.data[0].issued_by_pos);
	            $('input#desigreceiveby').val(data.data[0].recieve_by_pos);
	            $('input#desigrequestbydate').val(data.data[0].date_request);
	            $('input#desigapprovebydate').val(data.data[0].date_approve);
	            $('input#desigissuedbydate').val(data.data[0].date_issued);
	            $('input#desigreceivebydate').val(data.data[0].date_receive);
	            $('textarea#purpose').val(data.data[0].purpose);
		
	            $('#update-request-modal').modal('show');
	    }) 

	});
});


$(document).on("click", ".save_info" , function(e) {

	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
  	var edit_id 	=  $('input#detail_id').val();
  	var request_id 	=  $('input#request_id').val();
  	var val 		= (arr[arr.length-1]);

 	var reqby				= $('input#requestby').val();
 	var desigreq			= $('input#desigrequestby').val();
 	var datereq				= $('input#desigrequestbydate').val();
 	var apprby				= $('input#approveby').val();
 	var desigappryby 		= $('input#desigapproveby').val();
 	var dateappr			= $('input#desigapprovebydate').val();
 	var issby				= $('input#issuedby').val();
 	var desigissby			= $('input#desigissuedby').val();
 	var dateissby			= $('input#desigissuedbydate').val();
 	var recvby				= $('input#receiveby').val();
 	var desigrecv			= $('input#desigreceiveby').val();
 	var daterecv			= $('input#desigreceivebydate').val();
 	var purpse				= $('textarea#purpose').val();
 	
 	$.ajax({
      url: "{{ url('/request/save-personnel-detail') }}/"+val,
      type: "POST",
      data: {_token: CSRF_TOKEN,requestby: reqby,desigrequestby: desigreq,desigrequestbydate: datereq,approveby: apprby,desigapproveby: desigappryby,desigapprovebydate: dateappr,issuedby:issby,desigissuedby:desigissby,desigissuedbydate:dateissby,receiveby:recvby,desigreceiveby:desigrecv,desigreceivebydate:daterecv,purpose: purpse},

      success: function(response){
  
      	response = JSON.parse(JSON.stringify(response))

       	//tempAlert("Information successfully save.",2000);

       	swal("Saving information", "Data information entered was successfully save.", "success");

        $('#update-request-modal').modal('hide');

      },
      error: function(e){
      	//alert("Error processing request, please try again");
      	//alert(JSON.stringify(e));

      	//alert("Some needed information is empty. Unable to process your request");

      	swal("Oppppsss!", "Some needed information is empty. Unable to process your request!", "error");

      }
    });
 	e.preventDefault();
	
});

function tempAlert(msg,duration)

    {
     var el = document.createElement("div");
     el.setAttribute("style","position:fixed;top:50%;left:45%;margin: 0 auto;background-color:#F4FA58; border: solid thin #01A9DB; border-radius: 3px; padding-left: 15px; padding-right: 15px; padding-top: 6px; padding-bottom: 6px; color: #0B2161;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;");
     el.innerHTML = msg;

     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
     $(el).hide().fadeIn('slow');
    }

function warnAlert(msg,duration)

    {
     var el = document.createElement("div");
     el.setAttribute("style","position:fixed;top:50%;left:45%;margin: 0 auto;background-color:#FF0000; border: solid thin #DF0101; border-radius: 3px; padding-left: 25px; padding-right: 25px; padding-top: 12px; padding-bottom: 12px; color: #ffffff;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;");
     el.innerHTML = msg;

     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
     $(el).hide().fadeIn('slow');
    }

function goBack(){
	window.history.back();
	location.reload();
}

function checkFunction(value){

	var checkBox = document.getElementById("isfullyserve_u");

	if (checkBox.checked == true){
	    var id = $('input#detail_id').val();

		  	url = "{{ url('/request/update-item-detail') }}/"+id;

      	$.get(url, function (data) {
        		console.log(data);
	            $('input#quantity_update').val(data.data[0].quantity);
	            $('textarea#remarked').val("Fully Serve");
	            
		});

	} else {
	    $('input#quantity_update').val("0");

	}

}

$(document).ready(function(){
    $('.ischeck').click(function() {
        $('.ischeck').not(this).prop('checked', false);
	    if( $('.pcheck').is(':checked')) {
	        $(".check").show({duration: 400});

	    } else {
	        $(".check").hide({duration: 400});
	    }
    });
});
</script>

@endsection