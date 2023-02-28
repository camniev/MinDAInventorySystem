@extends('layouts.master')

@section('content')

<script>
		$(document).ready(function() {
		    var msg = '{{ Session::get("alert") }}';
		    var exist = '{{ Session::has("alert") }}';
		    if(exist){
		    	setTimeout(function () { alert(msg); }, 100);
		    }
		});

		$(function() {
			$(".preload").fadeOut(100, function() {
				$(".content").fadeIn(100);        
			});
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
</script>

<style>

	
</style>

<div class="content-wrapper" style="padding: 0px 24px 0px 24px;">

<!-- <div class="content-wrapper" style="margin-left: 20px;"> -->
    	<!-- <div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>STOCKS LIBRARY</Strong></div> -->
		<section class="content-header">
			<div class="newbreadcrumb">
				<h5 class="mr-3">Library</h5>
				<span class="mr-3">&#11044;</span>
				<h1>Stocks Library</h1>
			</div>
			<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#addStocksModal" onclick="addStocksModal();" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Add New Stocks</button>
		</section>
		<section class="content">
			<!-- <span class="d-flex float-right mr-5 mb-2" style="margin-top: -3px; display: none;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span> -->

			<div  style="background-color: #fff; display: inline-block; width: 100%;">

		<!--Content-->
		@if($data->count()>0)
		<table style="width: 100%;">
			<tr>
				<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>STOCK CODE</strong></td>
				<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>DESCRIPTION</strong></td>
				<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>UNIT</strong></td>
				<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>EXPENSE CATEGORY</strong></td>
				<td width="120" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>RE-ORDER POINT</strong></td>
				<td width="170" class="p-2" colspan="2" style="font-family: cambria; font-size: 12px;"><strong>ACTION</strong></td>
			</tr>
			@foreach($data as $s)
			<tr>
				<td id="stock_code_{{$s->id}}" class="p-2" style="font-family: cambria; font-size: 12px;">{{$s->stock_code}}</td>
				<td id="description_{{$s->id}}" class="p-2" style="font-family: cambria; font-size: 12px;">{{$s->description}}</td>
				<td id="unit_{{$s->id}}" class="p-2" style="font-family: cambria; font-size: 12px;">{{$s->unit}}</td>
				<td id="category_{{$s->id}}" class="p-2" style="font-family: cambria; font-size: 12px;">{{$s->expense_category}}</td>
				<td id="reorder_{{$s->id}}" class="p-2" style="font-family: cambria; font-size: 12px; text-align: center;">{{$s->reorderpoint}}</td>
				<td class="p-2" style="font-family: cambria; font-size: 12px;"><button id="{{$s->id}}" class="edit_stock btn btn-sm btn-primary" style="color: #fff"><span class="fa fa-pencil"></span> Edit</button></td>
				<td class="p-2" style="font-family: cambria; font-size: 12px;">

					<form method="POST" onSubmit="return confirm('Are you sure you want to remove/delete this stock item?')" action="{{ url('/library/remove-stock') }}/{{$s->id}}" enctype="multipart/form-data" class="delete_form"  style="display: inline-flex; margin-left: 5px;">
						@csrf
					<button class="btn btn-sm btn-danger" style="text-decoration: none; font-size: 11px; "><span class="fa fa-trash-o" title="Delete"></span> Delete</button></form>

				</td>
			</tr>
			@endforeach

			@if($data->count() > 0)
			<tr>
				<td colspan="5" style="border-bottom:  1px solid #fff;">
					<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $data->links() }}</div>
									
				</td>

			</tr>
			@endif
			<tr id="showreorder" style="display: none;">
				<td colspan="6" style="border-top: 1px solid #fff;">

					<a href="#" onclick="'javascript:void(0)'" class="btn_list btn-sm btn-success mt-1 mb-1 mr-1" style="color: #fff; float: right;"><span class="fa fa-book"></span> Show Lists</a>

				</td>
			</tr>
			<tr>
								
			</tr>
		</table>
		@endif
		<!-- <div class="addstockbtn"><button class="btn-add btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-plus-square-o"></span> Add New Stock Codes</button></div> -->
	<!--Content End-->
		</div>

	</section>

</div>

<!-- New Item Modal -->
<div class="modal fade" id="new-item-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto; max-width: auto"  role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #0B4D5E;">
      	<div style="color: #fff;font-size: 18px;">ADD NEW STOCK DETAILS</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>

				<table  style="table-layout: fixed; width:auto;">
					<tr>
						<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>STOCK CODE</strong></td>
						<td width="230" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>DESCRIPTION</strong></td>
						<td class="p-2" style="font-family: cambria; font-size: 12px; text-align: center;"><strong>UNIT</strong></td>
						<td width="200" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>EXPENSE CATEGORY</strong></td>
						<td colspan="2" width="120" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>RE-ORDER POINT</strong></td>

					</tr>
					<tr>
						<td valign="top" class=" p-1"><input style="text-align: center; width: 120px;" type="text" id="a_stockcode" name="a_stockcode" class="form-control" width="1px" maxlength="255"required></td>
						<td  class="p-1"  valign="top"><textarea style="font-size: 14px; width: 220px;" id="a_stock_description" name="a_stock_description" class="form-control" width="1px" required cols="3" rows="2"></textarea></td>
						<td  class="p-1"  valign="top"><input style="text-align: center; width: 80px;" type="text" id="a_unit" name="a_unit" class="form-control" width="1px" maxlength="255"required></td>
						<td  class="p-1"  valign="top"><textarea style="font-size: 14px; width: 160px;" id="a_category" name="a_category" class="form-control" width="1px" required cols="3" rows="2"></textarea></td></td>
						<td colspan="2"  class="p-1"  valign="top"><input style="text-align: center; width: 60px;" type="text" id="a_reorder" name="a_reorder" class="form-control" width="1px" maxlength="255"required></td>
						<input type="hidden" id="a_st_id" name="a_st_id" value="">
					</tr>
					<tr>
						<td colspan="6">
							<div class="d-flex float-right">
								<div class="justify-content-center p-3">
								     <button type="button" class="add_stock btn btn-sm btn-success" style="color: #ffffff"><span class="fa fa-save"></span> Save</button>
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


<!-- new modal for adding stocks -->
<div id="addStocksModal" class="modal fade modal-default" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Stocks</h4>
          </div>
          <form>
          <div class="modal-body">
              <div class="form-group">
                <label for="firstName">STOCK CODE</label>
                <input type="text" class="form-control" name="stock_code" id="stock_code">
              </div>
			  <!-- textarea -->
			  <div class="form-group">
                  <label>DESCRIPTION</label>
                  <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Unit</label>
							<select class="form-control select2" style="width: 100%;">
								<option selected="selected">Select a unit</option>
								<option>ream</option>
								<option>piece</option>
								<option>set</option>
								<option>cart</option>
								<option>roll</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Expense Category</label>
							<select class="form-control select2" style="width: 100%;">
								<option selected="selected">Select an expense category</option>
								<option>Office Supplies</option>
								<option>ICT Supplies</option>
								<option>Other Supplies Inventory</option>
								<option>Semi-expendable ICT Equipment</option>
							</select>
						</div>
					</div>
				</div>
				

              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
          </div>
		</form>
        </div>
      </div>
    </div>


<!-- Edit Item Modal -->
<div class="modal fade" id="item-edit-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto; max-width: auto"  role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #0B4D5E;">
      	<div style="color: #fff;font-size: 18px;">UPDATE STOCK DETAILS</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
  
				<table  style="table-layout: fixed; width:auto;">
					<tr>
						<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>STOCK CODE</strong></td>
						<td width="230" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>DESCRIPTION</strong></td>
						<td class="p-2" style="font-family: cambria; font-size: 12px; text-align: center;"><strong>UNIT</strong></td>
						<td class="p-2" style="font-family: cambria; font-size: 12px;"><strong>EXPENSE CATEGORY</strong></td>
						<td colspan="2" width="120" class="p-2" style="font-family: cambria; font-size: 12px;"><strong>RE-ORDER POINT</strong></td>

					</tr>
					<tr>
						<td valign="top" class=" p-1"><input style="text-align: center; width: 120px;" type="text" id="stockcode" name="stockcode" class="form-control" width="1px" maxlength="255"required></td>
						<td  class="p-1"  valign="top"><textarea style="font-size: 14px; width: 200px;" id="stock_description" name="stock_description" class="form-control" width="1px" required cols="3" rows="2"></textarea></td>
						<td  class="p-1"  valign="top"><input style="text-align: center; width: 80px;" type="text" id="unit" name="unit" class="form-control" width="1px" maxlength="255"required></td>
						<td  class="p-1"  valign="top"><textarea style="font-size: 14px; width: 160px;" id="category" name="category" class="form-control" width="1px" required cols="3" rows="2"></textarea></td></td>
						<td colspan="2"  class="p-1"  valign="top"><input style="text-align: center; width: 60px;" type="text" id="reorder" name="reorder" class="form-control" width="1px" maxlength="255"required></td>
						<input type="hidden" id="st_id" name="st_id" value="">
					</tr>
					<tr>
						<td colspan="6">
							<div class="d-flex float-right">
								<div class="justify-content-center p-3">
								     <button type="button" class="update_stock btn btn-sm btn-success" style="color: #ffffff"><span class="fa fa-save"></span> Save</button>
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

$(document).on("click", ".edit_stock" , function(e) {
 	var id = $(this).attr("id"); 



 	url = "{{ url('/supplies-summary/get-stock') }}/"+id;

 	$.get(url, function (data) {
       console.log(data);
       document.getElementById("stockcode").setAttribute('value',data.data[0].stock_code);
       document.getElementById("stockcode").value=data.data[0].stock_code;
       document.getElementById("stock_description").value = data.data[0].description;
       document.getElementById("unit").setAttribute('value',data.data[0].unit);
       document.getElementById("category").value=data.data[0].expense_category;
       document.getElementById("reorder").setAttribute('value',data.data[0].reorderpoint);
       document.getElementById("reorder").value=data.data[0].reorderpoint;
       document.getElementById("st_id").setAttribute('value',id);
       document.getElementById("st_id").value=id;

       $('#item-edit-modal').modal('show');
     });

 });

$(document).on("click",".update_stock",function(e){
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	var id  	= $('input#st_id').val();

	var stcode 			= $('input#stockcode').val();
	var stdescription 	= $('textarea#stock_description').val();
	var stunit 			= $('input#unit').val();
	var stcategory 		= $('textarea#category').val();
	var streorder 		= $('input#reorder').val();

	$.ajax({
      url: "{{ url('/supplies-summary/update-stock') }}/"+id,
      type: "POST",
      data: {_token: CSRF_TOKEN,stockcode: stcode,stock_description: stdescription,unit: stunit, category:stcategory, reorder: streorder},
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



$(document).ready(function() {
    $(document).on("click", ".btn_list" , function(e) {
        document.location.href="{{ url('/re-order-lists') }}";
    });
});


//Add new Stocks
$(document).ready(function() {
    $(document).on("click", ".btn-add" , function(e) {

    	$('#new-item-modal').modal('show');
    });
});

$(document).on("click",".add_stock",function(e){
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	var id  	= $('input#st_id').val();

	var stcode 			= $('input#a_stockcode').val();
	var stdescription 	= $('textarea#a_stock_description').val();
	var stunit 			= $('input#a_unit').val();
	var stcategory 		= $('textarea#a_category').val();
	var streorder 		= $('input#a_reorder').val();

	$.ajax({
      url: "{{ url('/library/add-new-stock') }}/",
      type: "POST",
      data: {_token: CSRF_TOKEN,stockcode: stcode,stock_description: stdescription,unit: stunit, category:stcategory, reorder: streorder},
      success: function(response){
  
      	response = JSON.parse(JSON.stringify(response))

		tempAlert("Changes successfully save.",2000);
        $('#new-item-modal').modal('hide');
        window.location.reload();

      },
      error: function(){
      	alert("Error processing request, please try again");
      }
    });
 	e.preventDefault();

});


$(document).ready(function() {
	$(document).on("click",".delete_stock", function(e){
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	var deleteid  = $(this).attr("id"); 

	//var confirmation = confirm("Are you sure you want to remove/delete this stock item?");

		if (confirm('Are you sure you want to remove/delete this stock item?')) {
		        $.ajax({
		            url: "{{ url('/library/remove-stock') }}/'"+deleteid,
		            type: "POST",
		            data: {d_id: deleteid},
		            success: function () {
		                tempAlert("Stock information deleted.",2000);
		            },
				      error: function(){
				      	alert("Error processing request, please try again");
				    }
		        });
		    }

	event.preventDefault();
	});
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



$(document).ready(function() {
   // url = "{{url('/re-order-lists-count')}}";
      //$.get(url, function (response) {
       //     console.log(response);  
            
      //      var x = response[0]; 

      //      alert(x);
      //      if(x>0){
      //      	document.getElementById("showreorder").style.display = '';
      //      }
      //});
      var data = [];
      var x = 0;

		//commented feb 14 2023
        // @foreach($reorderdata as $d )
        //     data.push({ ro: '{{ $d->reorderpoint }}', av: '{{ $d->available }}' });
        // @endforeach

        for (i = 0; i < data.length; i++) {

                var a = JSON.stringify(parseInt(data[i]['ro']));
                var b = JSON.stringify(parseInt(data[i]['av']));

                if(parseInt(b)<=parseInt(a)){
                    isbelow=true;
                    x++;
                }
                

        }

        if(x>0){
              document.getElementById("showreorder").style.display = '';
            }
});

	function export_excel()
	{
		window.location = "{{ url('/export-excel-library-list') }}";
		
	}


	function addStocksModal() {

		$("#addStocksModal").modal('show');

    // //remove textdanger
    // $(".text-danger").remove();
    // //remove form-group
    // $(".form-group").removeClass('has-error').removeClass('has-success');

    // $("#addPatientsForm").unbind('submit').bind('submit', function() {
    //   var form = $(this);

    //   //remove the text-danger
    //   $(".text-danger").remove();

    //   $.ajax({
    //     url: form.attr('action'),
    //     type: form.attr('method'),
    //     data: form.serialize(), //converting form data into array and sending to server
    //     dataType: 'json',
    //     success:function(response) {
    //       if(response.success === true) {
    //         $(".messages").html('<div class="alert alert-success alert-dismissable">'+
    //           '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
    //           '<strong><span class="glyphicon glyphicon-ok-sign"> </strong> '+response.messages+
    //           '</div>');
    //         //hide modal
    //           $("#addStocksModal").modal('hide');

    //           //update manageMemberTable
    //         //   scheduledCheckupsTodayTable.ajax.reload(null, false);
    //         //   scheduledCheckupsTwoDaysTable.ajax.reload(null, false);
    //         //   scheduledCheckupsDaysFromNowTable.ajax.reload(null, false);
    //         //   newScheduledCheckupsTable.ajax.reload(null, false);
    //       } else {
    //         if(response.messages instanceof Object) {
    //           $.each(response.messages, function(index, value) {
    //             var id = $("#"+index);

    //             id
    //             .closest('.form-group')
    //             .removeClass('has-error')
    //             .removeClass('has-success')
    //             .addClass(value.length > 0 ? 'has-error' : 'has-success')
    //             .after(value);
    //           });
    //           $(".messages").html('<div class="alert alert-warning alert-dismissable">'+
    //           '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
    //           '<strong><span class="glyphicon glyphicon-exclamation-sign"> </strong> '+'Error while adding the data'+
    //           '</div>');
    //         }
    //       }
    //     }
    //   });
    //   return false;
    // });
  }
 </script>



@endsection