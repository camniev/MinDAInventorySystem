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

    	<div  style="background-color: #fff; display: inline-block; width: 90%;">

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
							<tr>
								<td style="border: solid thin #fff;" align="center" colspan="7" class="p-1"><strong>ITEMS FOR DISPOSAL</strong></td>
							</tr>
							<tr>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Item</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
								<td rowspan="3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
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
								<td valign="top"><textarea style="font-size: 12px; width: 95%;" name="description" class="form-control p-1 m-1" cols="20" rows="3" required></textarea></td>
								<td valign="top"><input type="text" name="num" style="width: 95%; text-align: center;" class="form-control p-1 m-1"></td>
								<td valign="top"><input type="date" name="or_date" style="width: 95%; text-align: center;" value="<?php echo date("Y-m-d");?>" class="form-control p-1 m-1"></td>
								<td valign="top"><input type="text" name="amount" style="width: 95%; text-align: center;" class="form-control p-1 m-1"></td>
							</tr>
							<tr>
								<td colspan="7">

									<span class="d-flex float-left mb-2 mt-2 ml-2" style="margin-top: 10px;">
											<a href="javascript:void(0);" class="update_info btn btn-sm btn-warning" style="color: #0431B4"><span class="fa fa-user-circle-o" style="vertical-align: middle;"></span> Additional Info</a>
										</span>

									<a onclick="location = '{{ url('/waste-materials') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left"></span> Back</a>

									<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff"><span class="fa fa-save"></span> Save</button>
								</td>
							</tr>

							@foreach($lists as $i)
							<tr>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->item}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->quantity}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->unit}}</td>
								<td style="white-space: pre-wrap; font-weight: normal;" valign="top" align="left" class="p-3">{!!nl2br(str_replace(" ", " &nbsp;", $i->description))!!}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->receipt_num}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->receipt_date}}</td>
								<td style="font-weight: normal;" valign="top" align="center" class="p-3">{{$i->amount}}
									<a href="{{ url('/waste-materials/delete-details-waste-materials-entry')}}/{{$i->wm_id}}/{{$i->id}}" class="btn btn-sm btn-danger" style="float: right;" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o"></span> Delete</a>	
								</td>
							</tr>
							@endforeach
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
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/waste-materials/add-details-waste-materials-entry') }}/"+id;
</script>
@endif

<!--Content End-->
    </div>

</section>

</div>

</div>


<!-- Attachment Modal Update Request -->

<div class="modal fade" id="update-request-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="max-width: 35%"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Waste Materials Disposition Details&nbsp;<span id="item_name" name="item_name" style="color: #045FB4;"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
      	<table style="table-layout: fixed; width: 100%">
      		<tr>
      			<td class="p-2" width="260"><strong>Certified Correct:</strong></td>
      			<td class="p-2" width="260"><strong>Disposal Approved:</strong></td>
      			
      		</tr>
      		<tr>
      			<td width="300"><input type="text" class="form-control m-2" name="certifiedby_1" id="certifiedby_1" style="width: 180px;"></td>
      			<td><input type="text" class="form-control m-2" name="approveby" id="approveby" style="width: 180px;"></td>
      		</tr>
      		<tr>
      			<td class="p-2"><strong>Check the disposal types</strong></td>
      		</tr>
      		<tr>
      			<td colspan="2"><label class="mt-2 p-2"><input class="isdestroy ml-2 mt-1" type="checkbox" name="chkdistroy" id="chkdistroy" /> Item is Destroyed</label></td>
      		</tr>
      		<tr>
      			<td colspan="2"><label class="mt-2 p-2"><input class="isprivatesale ml-2 mt-1" type="checkbox" name="chkprivate_sale" id="chkprivate_sale" /> Item is Sold at private sale</label></td>
      		</tr>
      		<tr>
      			<td colspan="2"><label class="mt-2 p-2"><input class="ispublicauction ml-2 mt-1" type="checkbox" name="chkpublic_auction" id="chkpublic_auction" /> Item is Sold at public auction</label></td>
      		</tr>
      		<tr>
      			<td><label class="mt-2 p-2"><input class="istransfered ml-2 mt-1" type="checkbox" name="chktransfered" id="chktransfered" onclick="var input = document.getElementById('transferto'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true; input.value=''}"/> Item is Transferred without cost to</label></td>
      			<td><label class="mt-2 p-2">Name of the Agency/Entity <input class="form-control ml-2 mt-1" type="text" name="transferto" id="transferto" disabled/></label></td>
       		<tr>
       			<td class="p-2" width="50"><strong>Certified Correct:</strong></td>
      			<td class="p-2" width="50"><strong>Witness to Disposal:</strong></td>
       		</tr>
      		<tr>
      			<td><input type="text" class="form-control m-2" name="certifiedby_2" id="certifiedby_2" style="width: 180px;"></td>
      			<td><input type="text" class="form-control m-2" name="witnessby" id="witnessby" style="width: 180px;"></td>
      		</tr>

      		<tr>
      			<td></td>
      				<td valign="bottom" colspan="3">
      				<button class="save_info btn btn-sm btn-primary btn-sm mr-3 mt-3 mb-3 float-right pl-3 pr-3" style="color: #fff;" data-id=""><span class="fa fa-floppy-o" style="vertical-align: middle;"></span> Save</button>
      			</td>
       		</tr>
      	</table>

      	<div class="modal-footer"></div>
    </div>
  </div>
</div>


<script>
	$(document).ready(function() {
	$(document).on("click", ".update_info" , function(e) {
		var arr = (window.location.pathname).split("/");
		var val_id = (arr[arr.length-1]);


		url="{{ url('/waste-materials/signature-waste-materials-details') }}/"+val_id;
		
		$.get(url, function (data) {
			console.log(data);
        		$('input#certifiedby_1').val(data.data[0].custodian);
        		$('input#approveby').val(data.data[0].agency_head);
	            $('input#certifiedby_2').val(data.data[0].inspection_officer);
	            $('input#witnessby').val(data.data[0].witness);

	            if(data.data[0].is_destroyed==1){
	            	document.getElementById('chkdistroy').checked=true;
	            }else{
	            	document.getElementById('chkdistroy').checked=false;
	            }

	            if(data.data[0].private_sale==1){
	            	document.getElementById('chkprivate_sale').checked=true;
	            }else{
	            	document.getElementById('chkprivate_sale').checked=false;
	            }

	            if(data.data[0].public_auction==1){
	            	document.getElementById('chkpublic_auction').checked=true;
	            }else{
	            	document.getElementById('chkpublic_auction').checked=false;
	            }

	            if(data.data[0].transferred==1){
	            	document.getElementById('chktransfered').checked=true;
	            	$('input#transferto').val(data.data[0].agency_name);
	            	document.getElementById('transferto').disabled=false;
	            }else{
	            	document.getElementById('chkpublic_auction').checked=false;
	            	$('input#transferto').val('');
	            }


		
	            $('#update-request-modal').modal('show');
	    })


$('#update-request-modal').modal('show');
	});
});


$(document).on("click", ".save_info" , function(e) {

	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
  	var edit_id 	=  $('input#detail_id').val();
  	var request_id 	=  $('input#request_id').val();
  	var val 		= (arr[arr.length-1]);

 	var certby1				= $('input#certifiedby_1').val();
 	var apprvby				= $('input#approveby').val();
 	var transfered			= $('input#transferto').val();
 	var certby2				= $('input#certifiedby_2').val();
 	var witness				= $('input#witnessby').val();

 	if (document.getElementById('chkdistroy').checked) {
  		var destroyed 				= 1;
    } else {
        var destroyed 				= 0;
    }

    if (document.getElementById('chkprivate_sale').checked) {
  		var saleprivate				= 1;
    } else {
        var saleprivate 			= 0;
    }

    if (document.getElementById('chkpublic_auction').checked) {
  		var salepublic			= 1;
    } else {
        var salepublic 			= 0;
    }

    if (document.getElementById('chktransfered').checked) {
  		var transfer			= 1;
    } else {
        var transfer 			= 0;
    }
 	
 	
 	$.ajax({
      url: "{{ url('/waste-materials/save-signature-waste-materials-details') }}/"+val,
      type: "POST",
      data: {_token: CSRF_TOKEN,certifiedby_1: certby1,approveby: apprvby,transferto: transfered,certifiedby_2: certby2,witnessby: witness,chkdistroy: destroyed,chkprivate_sale:saleprivate,chkpublic_auction:salepublic,chktransfered:transfer},

      success: function(response){
  
      	response = JSON.parse(JSON.stringify(response))

       	tempAlert("Information successfully save.",2000);

        $('#update-request-modal').modal('hide');

      },
      error: function(){
      	alert("Error processing request, please try again");
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
</script>
@endsection