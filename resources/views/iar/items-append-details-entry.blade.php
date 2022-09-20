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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Inspected and Accepted Items/Property New Entry</div>

    	<div  style="background-color: #fff; display: inline-block; width: auto;">

<!--Content-->
@if($items->isEmpty())
<script>
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	window.location = "{{ url('/inspection-and-acceptance/inspection-details') }}/"+id;
</script>

@else

@foreach($items as $item)
@endforeach
<form id="form" method="POST" action="{{ url('/inspection-form/save-item') }}/{{$item->reference_id}}" accept-charset="utf-8" enctype="multipart/form-data">
		@csrf
	<input type="hidden" name="iid" id="iid" value="{{$item->reference_id}}">
							
		<table border="1px #fff solid;" style="table-layout: fixed;">
			<tr>
				<td align="center" style="padding-right: 10px; width: 50px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px; border: 1px solid #A9D0F5;"><Strong>Entity Name:</Strong></td>
				<td colspan="5" class="pl-3" style="border: 1px solid #A9D0F5;width: 200px;">{{ $item->entity_name }}</td>
				<td align="center" style="width: 50px; padding-right: 10px; padding-left: 10px; color: #1C1C1C;; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;width: 50px;"><Strong>Fund Cluster:</Strong></td>
				<td class="pl-3" style="width: 50px; border: 1px solid #A9D0F5;">{{ $item->cluster }}</td>
			</tr>
			<tr>
				<td  align="center" style="padding-right: 10px; padding-left: 10px;color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Supplier:</strong></td>
				<td colspan="5" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->supplier }}</td>
					<input name="supplier" id="supplier"  type="hidden" value="{{ $item->supplier }}">
					<input name="papcode" id="papcode"  type="hidden" value="{{ $item->papcode }}">
					<input type="hidden" id="invoice_number" name="invoice_number" value="{{ $item->invoice_no }}">
					<input type="hidden" id="invoice_date" name="invoice_date" value="{{ $item->invoice_date }}">
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>IAR No.:</strong></td>
				<td class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->iar_no }}</td>
			</tr>
			<tr>
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>PO No./Date:</strong></td>
				<td colspan="5" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->po_number }}</td>
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Date:</strong></td>
				<td class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->iar_date }}</td>
			</tr>
			<tr>
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Requisitioning Office/Dept.:</strong></td>
				<td colspan="5" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->department }}</td>
					<input name="department" id="department" type="hidden" value="{{ $item->department}}">
					<input name="respo_center_code" id="respo_center_code" type="hidden" value="{{ $item->responsibility_code}}">
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C;padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Invoice No.:</strong></td>
				<td class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->invoice_no}}</td>
			</tr>
			<tr>
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C;padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Respo Center Code:</strong></strong></td>
				<td colspan="5" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->responsibility_code}}</td>
				<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Date:</strong></td>
				<td class="pl-3" style="border: 1px solid #A9D0F5;">{{ $item->invoice_date}}</td>
			</tr>
			
			<tr>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock/<br>Property No.</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 300px;"><strong>Description</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Unit</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Cost</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Quantity</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Category</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Consume Days</strong></td>
				<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff; width: 30px;"><strong>Expense Category</strong></td>
			</tr>

			<tr>
				<td align="center" valign="top" class=" p-1"><input style="text-align: center;" list="data_proplist" name="propno" id="propno" class="form-control" onblur="getdesctiption(document.getElementById('propno'), document.getElementById('data_proplist'));" width="1px" maxlength="255"required>
					<datalist id="data_proplist">
			            @if($library->count()>0)
			            @foreach($library as $l)
							<option value="{{ $l->stock_code }}">
						@endforeach
						@endif
					</datalist>
						<input type="hidden" id="optselect" name="optselect">
				</td>
				<td class=" p-1" align="center" valign="top"><textarea style="font-size: 12px;" name="description" id="description" class="form-control" width="1px" required cols="3" rows="2" style="width: 200px;"></textarea></td>
				<td class=" p-1" align="center"  valign="top"><input style="text-align: center; width: 70px;" type="text" name="unit" id="unit" class="form-control" width="1px" maxlength="255"required></td>
				<td  class=" p-1" align="center"  valign="top"><input style="text-align: center; width: 100px;" type="text" name="cost" id="cost" class="form-control" width="1px" maxlength="255"required></td>
				<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;width: 80px;" type="text" name="quantity" id="quantity" class="form-control" width="1px" maxlength="255"required></td>
				<td class=" p-1" align="center"  valign="top">
					<select id="category" name="category" class="form-control" >
						<option value="StockCard" selected>ICS</option>
						<option value="PropertyCard">PAR</option>
					</select>
				</td>
				<td valign="top" align="center"><input class="form-control m-1 mr-3 pr-3" style="text-align: center; width: 100px;" type="number" id="consume" name="consume" value="0"></td>
				<td class=" p-1" align="center"  valign="top"><input type="text" class="form-control" name="ex_cat" id="ex_cat" readonly></td>
			</tr>
					
			<tr>
				<td colspan="7">
					<div class="form-group row mt-2" style="float: left;">
					    <label for="image" class="col-md-4 col-form-label text-md-right">Upload Image</label>
					    	<div class="col-md-6">
					        	<input type="file" name="img_file" id="img_file" class="form-control" style="padding-bottom: 35px;" accept="image/x-png,image/gif,image/jpeg,image/bmp,image/jpg,application/pdf" onchange="PreviewImage();">
					        </div>

					</div>
				</td>
				<td>
					<div class="photo-container" style="float: right"><img id="image" class="photo-info ml-5 mt-1" src="" style="height: 105px; border: 1px solid #08298A; margin: 5px;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;"/></div><br>
					    <div id="err"></div>
				</td>
			</tr>

			<tr>
				<td colspan="8">
					<div class="d-flex float-right">
						<div class="justify-content-center p-3">
							<button type="submit" class="btn btn-sm btn-primary" style="color: #ffffff; font-size: 11px;"><span class="fa fa-plus-square-o" style="vertical-align: middle;"></span> Add Stock/Item</button>


								<a onclick="location = '{{ url('/inspection-and-acceptance') }}';"  class="btn btn-sm btn-success pl-4 pr-4" style="color: #fff; font-size: 11px; font-family: 'Calibri';"><span class="fa fa-check-square-o"></span> Done</a>
						</div>
					</div>


					<div class="d-flex float-left">
						<div class="justify-content-center p-3">
							<a href="javascript:void(0);" class="update_date btn btn-sm btn-warning" style="color: #0431B4; font-size: 11px;"><span class="fa fa-user-circle-o" style="vertical-align: middle;"></span> Update Inspector and Receiver</a>
						</div>
					</div>
				</td>
			</tr>

			@if($items->count() > 0)
			@foreach ($items as $item)
			<tr>
				<td align="center" valign="top" class=" p-3">{{$item->stock_number}}</td>
				<td class=" p-3" valign="top" style="word-wrap:break-word;">{!!nl2br(str_replace(" ", " &nbsp;", $item->description))!!}</td>
				<td align="center" valign="top" class=" p-3">{{$item->unit}}</td>
				<td  class="p-3" align="center"  valign="top">{{ number_format($item->cost, 2, '.', ',') }}</td>
				<td  class="p-3" align="center"  valign="top">
					{{ number_format($item->quantity, 0, '.', ',') }}</td>

				@if(str_contains($item->stock_number,'165'))
					<td  class="p-3" align="center"  valign="top">
					{{ $item->category }} <br/> SEMI EXPENDABLE</td>
				@else
					<td  class="p-3" align="center"  valign="top">
					{{ $item->category }} <br/> OTHER SUPPLIES</td>
				@endif
				<td  class="p-3" align="center"  valign="top">
					{{ $item->consume_days }}</td>
				<td>
					<span class="d-flex float-right mb-5">
						<button id="{{$item->id}}" class="edit_stock btn btn-sm btn-primary mr-2 mt-3 mb-2" style="color: #fff; font-size: 11px;"><span class="fa fa-pencil-square-o" style="vertical-align: middle;"></span> Edit</button>

							<a href="{{ url('/inspection-and-acceptance/delete-inspection-details') }}/{{$item->stock_number}}/{{$item->reference_id}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger mr-3 mb-2 mt-3" style="margin-right: 50%; margin-top: 5%; color: #fff; float: right; right: 5px;";  font-size: 11px; title="Delete"><span class="fa fa-trash-o" style="vertical-align: middle;"></span> Delete</a>
					</span>
				</td>
			</tr>
			@endforeach
			@endif

		</table>
	</form>

@endif
<!--Content End-->
    	</div>

    </section>

</div>

</div>


<!-- Attachment Modal -->
<style>
	.check td{
	   display:none;
	}
</style>
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog  modal-lg" style="min-width: 20%; max-width: 20%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Inspection and Acceptance&nbsp;<span id="item_name" name="item_name" style="color: #045FB4;"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
      			<table id="my_update_table">
      				
      				<tr>
      					<td class="p-2">Inspected by:</td>
      					<td class="p-2"><input class="form-control" type="text" id="inspector" name="inspector" value=""></td>
      				</tr>
      				
      				<tr>
      					<td class="p-2">Date Inspected:</td>
      					<td class="p-2"><input class="form-control" type="date" style="width: 170px;" id="dateinspected" name="dateinspected" value="<?php echo date("Y-m-d");?>"></td>
      				</tr>
      				{{--
      				<tr>
      					<td class="p-2">Receive by:</td>
      					<td class="p-2"><input class="form-control" type="text" id="receiver" name="receiver" value=""></td>
      				</tr>
      				--}}
      				<tr>
      					<td class="p-2">Date Received:</td>
      					<td class="p-2"><input class="form-control" type="date" style="width: 170px;" id="datereceive" name="datereceive" value="<?php echo date("Y-m-d");?>"></td>
      				</tr>
      				<tr>
      					<td class="p-2 ml-2 checkboxes" style="border-bottom: 1px thin #fff;">
      						<label><input class="ischeck pt-5 mb-1 mr-1" type="checkbox" id="complete" name="complete" value=""/> Complete </label>
      					</td>
      					<td  class="p-2 ml-2 checkboxes" style="border-bottom: 1px thin #fff;">
      						<label><input class="ischeck pcheck pt-5 mb-1 mr-1" type="checkbox" id="partial" name="partial" value="check"/> Partial (pls. specify quantity)</label>
      					</td>
      				
      				</tr>
      				<tr class="show-quantity">
	      	      		<td class="p-2">Quantity:</td>
		      			<td class="p-2"><input class="form-control" type="text" id="p_quantity" name="p_quantity" style="width: 60px;" value="0"></td>
      				</tr>
      				<tr class="show-quantity">
      					<td class="p-2">Remarks</td>
      					<td class="p-2"><textarea class="form-control" name="remarks" id="remarks"></textarea></td>
      				</tr>
      				<tr>
      					<td colspan="2"><button class="update_ins btn btn-sm btn-success float-right m-2"><span class="fa fa-check-square-o"></span> Update</button></td>
      				</tr>
      			</table>

      		<div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<!--Modal Working-->

<div class="modal fade" id="working-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog  modal-lg" style="width: 200px; height: 600px;" role="document">
    <div class="modal-content">
    	<div align="center"><img src="{{ url('/images/dsgdfgs456tvw45466w45656esry5y4.gif') }}"></div>
    	<hr id="cpb" style="display: block; margin-before: 0.5em; margin-after: 0.5em; margin-start: auto; margin-end: auto; overflow: hidden; border-width: 2px; float: left; background: #FF0000">
    </div>
  </div>
</div>


<!-- Item Edit Modal -->
<div class="modal fade" id="item-edit-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>

				<table border="1px #fff solid;" style="table-layout: fixed; width:auto;">
					<tr>
						<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock/<br>Property No.</strong></td>
						<td colspan="4" align="center" style="width: 50%;border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
						<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
						<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Cost</strong></td>
						<td align="center" style="border-bottom: 1px solid #A9D0F5; border-left: 1px solid #A9D0F5; border-top: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
						<td style="background: #3b5998 ; color: #fff"></td>

					</tr>
					<tr>
						<td align="center" valign="top" class=" p-1"><input style="text-align: center;" type="text" id="propno2" name="propno2" class="form-control" width="1px" maxlength="255"required></td>
						<td  class=" p-1" colspan="4" align="center"  valign="top"><textarea style="font-size: 14px;" id="description2" name="description2" class="form-control" width="1px" required cols="3" rows="2"></textarea></td>
						<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" id="unit2"  name="unit2" class="form-control" width="1px" maxlength="255"required></td>
						<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" id="cost2"  name="cost2" class="form-control" width="1px" maxlength="255"required></td>
						<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" id="quantity2" name="quantity2" class="form-control" width="1px" maxlength="255"required></td>
						<input type="hidden" id="st_id" name="st_id" value="">
						<td></td>
					</tr>
					<tr>
						<td colspan="8">
							<div class="d-flex float-right">
								<div class="justify-content-center p-3">
								     <button type="button" class="update_item btn btn-sm btn-success" style="color: #ffffff"><span class="fa fa-check-square-o" style="vertical-align: middle;"></span> Save</button>
								</div>
							</div>
						</td>
					</tr>							
					
				</table>

      		<div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

	$(document).on("click", ".update_date", function() {
		  	var id = $(this).val(); 
		  	var arr = (window.location.pathname).split("/");
			var val = (arr[arr.length-1]);
			//alert(val);
		  	url = "{{ url('/inspection-and-acceptance/inspector') }}/"+val;


        	$.get(url, function (data) {
        		console.log(data);
        		//console.log(data.data[0].date_inspected);
        		/*
        		if(!data.data[0].inspector=='null')
        		{
        			document.getElementById("inspector").setAttribute('value',data.data[0].inspector);
        		}else{
        			document.getElementById("inspector").setAttribute('value','');
        		}
        		if(!data.data[0].receiver=='null')
        		{
        			document.getElementById("receiver").setAttribute('value',data.data[0].receiver);
        		}else{
        			document.getElementById("receiver").setAttribute('value','');
        		}
        		
				*/
				if(data.data[0].inspector != null)
        		{
        			document.getElementById("inspector").setAttribute('value',data.data[0].inspector);
        		}else{
        			document.getElementById("inspector").setAttribute('value','');
        		}
        		document.getElementById("dateinspected").setAttribute('value',data.data[0].date_inspected);
        		document.getElementById("datereceive").setAttribute('value',data.data[0].date_receive);
        		document.getElementById("remarks").setAttribute('value',data.data[0].remarks);

        		
        		document.getElementById("p_quantity").setAttribute('value',data.data[0].partial_quantity);

        		//$('input#datereceive').setAttribute(data.data[0].date_receive);

        		if(data.data[0].iscomplete==1){
	            	document.getElementById('complete').checked=true;
	            	document.getElementById('partial').checked=false;
	            }else{
	            	document.getElementById('complete').checked=false;
	            	document.getElementById('partial').checked=true;
	            	$(".show-quantity").show({duration: 400});
	            }

	           $('#edit-modal').modal('show');
	    	}) 
        	 

	});

});


$(document).on("click", ".update_ins" , function(e) {

	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
  	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-1]);

	if (document.getElementById('complete').checked) {
  		var iscomplete 			= 1;
    } else {
        var iscomplete 			= 0;
    }

    if (document.getElementById('partial').checked) {
  		var ispartial			= 1;
  		var pquantity 			= $('input#p_quantity').val();
    } else {
        var ispartial			= 0;
        var pquantity 			= 0;
    }
  	
 	var dateinspect  	= $('input#dateinspected').val();
 	var dateaccept 		= $('input#datereceive').val();
 	var remark 			= $('textarea#remarks').val();
 	var inspector  		= $('input#inspector').val();
 	//var receiver 		= $('input#receiver').val();
 	
 	$.ajax({
      url: "{{ url('/inspection-and-acceptance/update-inspector') }}/"+val,
      type: "POST",
      data: {_token: CSRF_TOKEN,inspector: inspector, dateinspected: dateinspect,datereceive: dateaccept,complete: iscomplete,partial: ispartial,p_quantity: pquantity, remarks: remark},
      success: function(response){
  
      	response = JSON.parse(JSON.stringify(response))

      	tempAlert("Changes successfully save.",2000);

        $('#edit-modal').modal('hide');

      },
      error: function(e){
      	alert("Error processing request, please try again");
      }
    });
 	e.preventDefault();


});


$(document).on("click", ".edit_stock" , function(e) {
 	var id = $(this).attr("id"); 

 	url = "{{ url('/inspection-and-acceptance/edit-inspection-details') }}/"+id;

 	$.get(url, function (data) {
       console.log(data);

       document.getElementById("propno2").setAttribute('value',data.data[0].stock_number);
       document.getElementById("description2").value = data.data[0].description;
       document.getElementById("unit2").setAttribute('value',data.data[0].unit);
       document.getElementById("cost2").setAttribute('value',data.data[0].cost);
       document.getElementById("quantity2").setAttribute('value',data.data[0].quantity);
       document.getElementById("st_id").setAttribute('value',id);

       $('#item-edit-modal').modal('show');
     });

 });

$(document).on("click",".update_item",function(e){
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	var id  	= $('input#st_id').val();

	var propno 			= $('input#propno2').val();
	var description 	= $('textarea#description2').val();
	var unit 			= $('input#unit2').val();
	var cost 			= $('input#cost2').val();
	var quantity 		= $('input#quantity2').val();

	$.ajax({
      url: "{{ url('/inspection-and-acceptance/update-inspection-details') }}/"+id,
      type: "POST",
      data: {_token: CSRF_TOKEN,propno2: propno,description2: description,unit2: unit, cost2:cost, quantity2: quantity},
      success: function(response){
  
      	response = JSON.parse(JSON.stringify(response))

      	tempAlert("Changes successfully save.",2000);

        $('#item-edit-modal').modal('hide');
        window.location.reload();

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

$(document).ready(function(){
	$(".show-quantity").hide();
    $('.ischeck').click(function() {
        $('.ischeck').not(this).prop('checked', false);
	    if($('.pcheck').is(':checked')) {
			$(".show-quantity").show({duration: 500});
			
	    } else {
	        $(".show-quantity").hide({duration: 500});
	    }
    });
});

</script>

<script>
	
	$(document).ready(function (e) {

 		$("#form").on('submit',(function(e) {
  			e.preventDefault();

  			var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
		  	var arr = (window.location.pathname).split("/");
			var val = (arr[arr.length-1]);

			var id  	= $('input#iid').val();
	        var percentVal;

  		$.ajax({
        	url: "{{ url('/inspection-and-acceptance/save-inspection-details') }}/"+id,
   			type: "POST",
   			data:  new FormData(this),
   			dataType: 'json',
   			contentType: false,
         	cache: false,
   			processData:false,
   			beforeSend: function() {
	            $('#working-modal').modal('show');
	            var i = 1;

				var interval = setInterval( increment, 20);

				function increment(){
				    i = i % 100 + 1;
				    console.log(i+'%');
				    document.getElementById("cpb").style.width = i+'%';
				}
	        },

	        xhrFields: {
            onprogress: function (evt) {
               		if (evt.lengthComputable) {
                 		var percentComplete = Math.floor(evt.loaded / evt.total) * 100 + '%';
                 		$('#progress').css({width : percentComplete});
               		}
            	}
         	},

   			success: function(data)
   			{
    			if(data=='invalid')
	   			{
	     			$("#err").html("Invalid File !").fadeIn();
	   			}
	    		else
	    		{
	     			alert(percentVal);
	     			$(".photo-container").html(data).fadeIn();
	     			//$("#form")[0].reset(); 
	     			
	    		}
    		console.log(data);
	      	},
	      	complete: function(e)
	      	{
	      		$('#working-modal').modal('show');
	      		window.location.href="{{ url('/inspection-and-acceptance/add-inspection-details') }}/"+id;
	      	},
	     	error: function(e) 
	      	{
	    		$("#err").html(e).fadeIn();
	      	}          
    	});
 	}));
});


</script>

<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_file").files[0]);

        oFReader.onload = function (oFREvent) {
            //document.getElementById("image").src = oFREvent.target.result;

        $(".photo-container").animate({
            opacity: 0.10,
        }, 200, function () {
            $(".photo-info").attr("src", oFREvent.target.result);
        }).animate({ opacity: 1 }, 800);
        };
    };

</script>

<script>

function getdesctiption(el, dl){
		if(el.value.trim() != ''){
		    var opSelected = dl.querySelector(`[value="${el.value}"]`);
		    var option = document.createElement("option");
		    option.value = opSelected.value;
		    option.text = opSelected.getAttribute('value');

		    var x = opSelected.getAttribute('value');

		    url="{{ url('/stock-code/') }}/"+x;

		    //alert(x);
		    
		    document.getElementById('optselect').value=x;

		    $.ajax({
			    url: "{{ url('/stock-code/') }}/"+x,
			    context: document.body,
			    success: function(data){
			      console.log(data);
			      $('input#unit').val(data.data[0].unit);
			      $('textarea#description').val(data.data[0].description);
			      if(x.indexOf("165") >-1){
			      	//$('span#ex_cat').html("<b>SEMI EXPENDABLE</b>");
			      	$('input#ex_cat').val('SEMI EXPENDABLE');
			  	  }else{
			  	  	//$('span#ex_cat').html("<b>OTHER SUPPLIES</b>");
			  	  	$('input#ex_cat').val('OTHER SUPPLIES');
			  	  }
			    }
});

  		}
}


</script>


@endsection