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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>SETTINGS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block;">

<!--Content-->
@if($data->count()>0)
@foreach($data as $l)
@endforeach
<div class="card">
				<div class="card-header">
					<div class="card-header"><Strong>Primary Signatures</Strong></div>
					<table style="width: 100%; table-layout: fixed;">
						<tr>
							<td style="width: 200px;"><input type="hidden" name="rcount" id="rcount" value="{{$rcnt}}"></td>
							<td></td>
						</tr>
						<tr class="pl-2">
							<td class="pl-2">Supply Officer Name</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_name" id="supply_name" style="width: 250px;" value="{{$l->IARSupplyOfficer}}"></td>
							
						</tr>
						<tr>
							<td class="pl-2">Designation</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_pos" id="supply_pos" style="width: 250px;" value="{{$l->IARSupplyOfficerPos}}"></td>
						</tr>
						<tr>
							<td class="pl-2">Responsibility Started Date</td>
							<td><input type="date" class="form-control mt-1 mb-1 mr-2" name="supply_res_date" id="supply_res_date" style="width: 250px;" value="{{$l->assume_date}}"></td>
						</tr>
						<tr class="m-5">
							<td class="pl-2">Inspector</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_name_inspector" id="supply_name_inspector"  style="width: 250px;"value="{{$l->IARInpector}}"></td>
							
						</tr>
						<tr>
							<td class="pl-2">Designation</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_pos_inspector" id="supply_pos_inspector" style="width: 250px;" value="{{$l->IARInpectorPos}}"></td>
						</tr>

						<tr>
							<td class="pl-2">Accounting Clerk</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="acc_clerk" id="acc_clerk" style="width: 250px;" value="{{$l->RSMIAccClerk}}"></td>
						</tr>
						<tr>
							<td class="m-3"><span style="float: right"><button class="btn_supply btn btn-sm btn-success pl-4 pr-4 pr-2 m-3"><span class="fa fa-save"></span> Save</button></span></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>

<div class="card mt-4 mb-4">
				<div class="card-header">
					<div class="card-header"><Strong>Physical Count of Inventories Signatures</Strong></div>
						<table style="width: 100%; table-layout: fixed;">

						<tr class="m-5">
							<td class="pl-2" style="width: 200px;">Inventory Committee, Chair</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_chair" id="inv_name_chair" style="width: 250px;" value="{{$l->RPCIInvCommitteeChair}}"></td>
							
						</tr>
						<tr>
							<td class="pl-2">Inventory Committee, member</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_member" id="inv_name_member" style="width: 250px;" value="{{$l->RPCIInvCommitteeMember}}"></td>
						</tr>
						<tr>
							<td class="pl-2">MinDA, OIC Chairman</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_oic" id="inv_name_oic" style="width: 250px;" value="{{$l->RPCIOICChair}}"></td>
						</tr>
						<tr>
							<td class="pl-2">COA Representative</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_coa" id="inv_name_coa" style="width: 250px;" value="{{$l->RPCICOARep}}"></td>
						</tr>
						<tr>
							<td class="pl-2">Finance Division Representative</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_fin" id="inv_name_fin"  style="width: 250px;" value="{{$l->RPCIFinDivRep}}"></td>
						</tr>
						<tr>
							<td class="m-3"><span style="float: right"><button class="btn_rpci btn btn-sm btn-success pl-4 pr-4 pr-2 m-3 "><span class="fa fa-save"></span> Save</button></span></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>

@else
<div class="card">
				<div class="card-header">
					<div class="card-header"><Strong>Primary Signatures</Strong></div>
					<table style="width: 100%; table-layout: fixed;">
						<tr>
							<td style="width: 200px;"><input type="hidden" name="rcount" id="rcount" value="{{$rcnt}}"></td>
							<td></td>
						</tr>
						<tr class="m-5">
							<td class="pl-2">Supply Officer Name</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_name" id="supply_name" style="width: 250px;" value=""></td>
							
						</tr>
						<tr>
							<td class="pl-2">Designation</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_pos" id="supply_pos" style="width: 250px;" value=""></td>
						</tr>
						<tr>
							<td class="pl-2">Responsibility Started Date</td>
							<td><input type="date" class="form-control mt-1 mb-1 mr-2" name="supply_res_date" id="supply_res_date" style="width: 250px;" value=""></td>
						</tr>
						<tr class="m-5">
							<td class="pl-2">Inspector</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_name_inspector" id="supply_name_inspector" style="width: 250px;" value=""></td>
							
						</tr>
						<tr>
							<td class="pl-2">Designation</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="supply_pos_inspector" id="supply_pos_inspector" style="width: 250px;" value=""></td>
						</tr>

						<tr>
							<td class="pl-2">Accounting Clerk</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="acc_clerk" style="width: 250px;" id="acc_clerk"></td>
						</tr>
						<tr>
							<td class="m-3"><span style="float: right"><button class="btn_supply btn btn-sm btn-success pl-4 pr-4 pr-2 m-3"><span class="fa fa-save"></span> Save</button></span></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>


<div class="card mt-4 mb-4">
				<div class="card-header">
					<div class="card-header"><Strong>Physical Count of Inventories Signatures</Strong></div>
						<table style="width: 100%; table-layout: fixed;">
						<tr class="m-5">
							<td class="pl-2" style="width: 200px;">Inventory Committee, Chair</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_chair" id="inv_name_chair" style="width: 250px;" value=""></td>
							
						</tr>
						<tr>
							<td class="pl-2">Inventory Committee, member</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_member" id="inv_name_member" style="width: 250px;" value=""></td>
						</tr>
						<tr>
							<td class="pl-2">MinDA, OIC Chairman</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_oic" id="inv_name_oic" style="width: 250px;" value=""></td>
						</tr>
						<tr>
							<td class="pl-2">COA Representative</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_coa" id="inv_name_coa" style="width: 250px;" value=""></td>
						</tr>
						<tr>
							<td class="pl-2">Finance Division Representative</td>
							<td><input type="text" class="form-control mt-1 mb-1 mr-2" name="inv_name_fin" id="inv_name_fin" style="width: 250px;" value=""></td>
						</tr>
						<tr>
							<td class="m-3"><span style="float: right"><button class="btn_rpci btn btn-sm btn-success pl-4 pr-4 pr-2 m-3">Save <span class="fa fa-save"></span></button></span></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>


@endif

<!--Content End-->
    </div>

</section>

</div>

</div>

<script  type="text/javascript">

	$(document).on("click", ".btn_supply" , function(e) {

		var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');

		var supplyofficer 		= 	$('input#supply_name').val();
		var supplyofficerpos 	= 	$('input#supply_pos').val();
		var supplyofficerrespo 	= 	$('input#supply_res_date').val();
		var inspectorname 		= 	$('input#supply_name_inspector').val();
		var inspectornamepos 	= 	$('input#supply_pos_inspector').val();
		var accclerk 			= 	$('input#acc_clerk').val();
		var recordcount 		=	$('input#rcount').val();

		$.ajax({
	      url: "{{ url('/signatures-primary-signature') }}",
	      type: "POST",
	      data: {_token: CSRF_TOKEN,supply_name: supplyofficer,supply_pos: supplyofficerpos,supply_res_date:supplyofficerrespo, supply_name_inspector: inspectorname, supply_pos_inspector: inspectornamepos,acc_clerk: accclerk,rcount:recordcount},
		      success: function(response){
		  
		      	response = JSON.parse(JSON.stringify(response))

		      	tempAlert("Changes successfully save.",2000);

		      },
		      error: function(e){
		      	console.log(e);
		      	alert("Error processing request, please try again");
		      }
		    });
	 	e.preventDefault();


	});

	$(document).on("click", ".btn_rpci" , function(e) {

		var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');

		var invchair 			= 	$('input#inv_name_chair').val();
		var invmember 			= 	$('input#inv_name_member').val();
		var invoic 				= 	$('input#inv_name_oic').val();
		var invcoa 				= 	$('input#inv_name_coa').val();
		var invfin 				= 	$('input#inv_name_fin').val();
		var recordcount 		=	$('input#rcount').val();

		$.ajax({
	      url: "{{ url('/signatures-rpci-signature') }}",
	      type: "POST",
	      data: {_token: CSRF_TOKEN,inv_name_chair: invchair,inv_name_member: invmember,inv_name_oic: invoic, inv_name_coa: invcoa,inv_name_fin: invfin,rcount:recordcount},
		      success: function(response){
		  
		      	response = JSON.parse(JSON.stringify(response))

		      	tempAlert("Changes successfully save.",2000);

		      },
		      error: function(e){
		      	console.log(e);
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

     document.getElementById("rcount").setAttribute('value',1);

     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
     $(el).hide().fadeIn('slow');
    }
</script>
@endsection