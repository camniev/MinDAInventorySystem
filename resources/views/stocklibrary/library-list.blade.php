@extends('layouts.master')

@section('content')
<div class="content-wrapper" style="padding: 0px 24px 0px 24px;">
	
	<div id="update-snackbar"><i class="fa fa-check"></i> <p id="notif-message"></p></div>
	<section class="content-header">
		<div class="newbreadcrumb">
			<h5 class="mr-3">Library</h5>
			<span class="mr-3">&#11044;</span>
			<h1>Stocks Library</h1>
		</div>
		<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#addStocksModal" onclick="addStocksModal();" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Add New Stocks</button>
	</section>
	<section class="content">
		<!-- <div style="background-color: #fff; display: inline-block; width: 100%; padding: 30px;"> -->
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<!-- Stocks Library DataTable -->
						<table id="stocksTable" class="table table-bordered table-striped ">
						
							<thead class="thead-light">
								<tr>
									<th scope="col">STOCK CODE</th>
									<th scope="col">DESCRIPTION</th>
									<th scope="col">UNIT</th>
									<th scope="col">EXPENSE CATEGORY</th>
									<th scope="col">ACTION</th>
								</tr>
							</thead>
						</table>
						<!-- DataTable End-->
					</div>
				</div>
				<!-- </div> -->
			</div>
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
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mt-4">Add New Stocks</h4>
			</div>
			<div class="modal-body px-5">
				<ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav"> <!-- Rounded tabs -->
					<li class="nav-item flex-sm-fill">
					<a id="encode_ind_stocks_tab" data-toggle="tab" href="#encode_ind_stocks" role="tab" aria-controls="encode_ind_stocks" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active"> Input Individual Stock</a>
					</li>
					<li class="nav-item flex-sm-fill">
					<a id="upload_excel_stocks_tab" data-toggle="tab" href="#upload_excel_stocks" role="tab" aria-controls="upload_excel_stocks" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Upload List of Stocks</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div id="encode_ind_stocks" role="tabpanel" aria-labelledby="encode_ind_stocks_tab" class="tab-pane fade px-4 py-5 show active">
						<form action="#">
						@csrf
							<div class="form-group">
								<label for="firstName">STOCK CODE</label>
								<input type="text" class="form-control" name="stock_code" id="stock_code">
							</div>

							<div class="form-group"> <!-- textarea -->
								<label>DESCRIPTION</label>
								<textarea class="form-control" rows="3" name="description" id="description"></textarea>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>UNIT</label>
									<select class="form-control select2" name="unit" id="unit" style="width: 100%;">
									<option value="" selected disabled>Select a unit</option>
									@foreach($distinct_unit as $data) 
										<option value="{{ $data->unit }}">{{ $data->unit }}</option>
									@endforeach
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>EXPENSE CATEGORY</label>
									<select class="form-control select2" name="expense_category" id="expense_category" style="width: 100%;">
										<option value="" selected disabled>Select an expense category</option>
										@foreach($distinct_expense_category as $data) 
										<option value="{{ $data->expense_category }}">{{ $data->expense_category }}</option>
										@endforeach
									</select>
									</div>
								</div>
							</div>
						
							<div class="mt-3 mb-5 pull-right"> <!-- form buttons -->
								<button type="button" class="btn btn-blank mr-1" data-dismiss="modal"> Close</button>
								<button type="submit" class="btn btn-primary add-ind-stock"> Save</button>
							</div> <!-- end form buttons -->
						
						</form> <!-- end form -->
					</div>

					<div id="upload_excel_stocks" role="tabpanel" aria-labelledby="upload_excel_stocks_tab" class="tab-pane fade px-4 pt-4">
						<div class="fu-wrapper">
							<form action="#" class="fu-form">
							<!-- @ csrf -->
								<div class="div-fu-form"> <!-- browse file div -->
									<input class="file-input" type="file" id="input-excel-file" name="file" hidden>
									<i class="fas fa-cloud-upload-alt"></i>
									<p>Browse the Excel File to Upload</p>
								</div> <!-- end browse file div -->
								<section class="progress-area"></section>
								<section class="uploaded-area"></section>

								<div class="mt-3 mb-5 pull-right"> <!-- form buttons -->
									<button type="button" class="btn btn-blank mr-1" data-dismiss="modal"> Close</button>
									<button type="submit" class="btn btn-primary upload-excel-file"> Upload</button>
								</div> <!-- end form buttons -->
							
							<!-- button submit and close -->
							</form> <!-- end form -->
						</div>
					</div> <!-- End excel upload tab -->
				</div>
				<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button> -->
				</div>
			</div>
			
		</div>
	</div>
</div>

<!-- new modal for EDITING stocks -->
<div id="editStocksModal" class="modal fade modal-default" role="dialog">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mt-4">Edit Stocks</h4>
			</div>
			<div class="modal-body px-5">
				<form action="#">
					@csrf
					<div class="form-group d-none">
						<label for="stock_id">ID</label>
						<input type="text" class="form-control" name="stock_id" id="edit_stock_id">
					</div>

					<div class="form-group">
						<label for="firstName">STOCK CODE</label>
						<input type="text" class="form-control" name="stock_code" id="edit_stock_code">
					</div>

					<!-- textarea -->
					<div class="form-group">
						<label>DESCRIPTION</label>
						<textarea class="form-control" rows="3" name="description" id="edit_description"></textarea>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>UNIT</label>
								<select class="form-control select2" id="edit_unit" name="edit_unit" style="width: 100%;">
									@foreach($distinct_unit as $data) 
									<option value="{{ $data->unit }}">{{ $data->unit }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>EXPENSE CATEGORY</label>
								<select class="form-control select2" id="edit_expense_category" name="edit_expense_category" style="width: 100%;">
									@foreach($distinct_expense_category as $data) 
									<option value="{{ $data->expense_category }}">{{ $data->expense_category }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
					<!-- form buttons -->
					<div class="mt-3 mb-5 pull-right">
							<button type="button" class="btn btn-blank mr-1" data-dismiss="modal"> Close</button>
							<button type="submit" class="btn btn-primary new_update_stock"> Save</button>
					</div>
					<!-- end form buttons -->
				</form>
				<!-- end form -->
			</div>
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
	</div>

<script type="text/javascript">
	//OPEN EDIT MODAL WITH DATA
	// $(document).on("click", ".edit-stock" , function(e) {
	// 	var id = $(this).attr("id"); 

	// 	url = "{{ url('/supplies-summary/get-stock') }}/"+id;

	// 	$.get(url, function (data) {
	// 	console.log(data);
	// 	document.getElementById("stockcode").setAttribute('value',data.data[0].stock_code);
	// 	document.getElementById("stockcode").value=data.data[0].stock_code;
	// 	document.getElementById("stock_description").value = data.data[0].description;
	// 	document.getElementById("unit").setAttribute('value',data.data[0].unit);
	// 	document.getElementById("category").value=data.data[0].expense_category;
	// 	document.getElementById("reorder").setAttribute('value',data.data[0].reorderpoint);
	// 	document.getElementById("reorder").value=data.data[0].reorderpoint;
	// 	document.getElementById("st_id").setAttribute('value',id);
	// 	document.getElementById("st_id").value=id;

	// 	$('#item-edit-modal').modal('show');
	// 	});
	// });
	
	//SAVE EDIT
	// $(document).on("click",".update_stock",function(e){
	// 	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	// 	var id  	= $('input#st_id').val();

	// 	var stcode 			= $('input#stockcode').val();
	// 	var stdescription 	= $('textarea#stock_description').val();
	// 	var stunit 			= $('input#unit').val();
	// 	var stcategory 		= $('textarea#category').val();
	// 	var streorder 		= $('input#reorder').val();

	// 	$.ajax({
	// 	url: "{{ url('/supplies-summary/update-stock') }}/"+id,
	// 	type: "POST",
	// 	data: {_token: CSRF_TOKEN,stockcode: stcode,stock_description: stdescription,unit: stunit, category:stcategory, reorder: streorder},
	// 	success: function(response){
	
	// 		response = JSON.parse(JSON.stringify(response))

	// 		tempAlert("Changes successfully save.",2000);
	// 		$('#item-edit-modal').modal('hide');
	// 		window.location.reload();

	// 	},
	// 	error: function(){
	// 		alert("Error processing request, please try again");
	// 	}
	// 	});
	// 	e.preventDefault();

	// });

	//OLD Add new Stocks
	// $(document).ready(function() {
	// 	$(document).on("click", ".btn-add" , function(e) {

	// 		$('#new-item-modal').modal('show');
	// 	});
	// });

	//SAVING NEW STOCK
	// $(document).on("click",".add_stock",function(e){
	// 	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	// 	var id  	= $('input#st_id').val();

	// 	var stcode 			= $('input#a_stockcode').val();
	// 	var stdescription 	= $('textarea#a_stock_description').val();
	// 	var stunit 			= $('input#a_unit').val();
	// 	var stcategory 		= $('textarea#a_category').val();
	// 	var streorder 		= $('input#a_reorder').val();

	// 	$.ajax({
	// 	url: "{{ url('/library/add-new-stock') }}/",
	// 	type: "POST",
	// 	data: {_token: CSRF_TOKEN,stockcode: stcode,stock_description: stdescription,unit: stunit, category:stcategory, reorder: streorder},
	// 	success: function(response){
	
	// 		response = JSON.parse(JSON.stringify(response))

	// 		tempAlert("Changes successfully save.",2000);
	// 		$('#new-item-modal').modal('hide');
	// 		window.location.reload();

	// 	},
	// 	error: function(){
	// 		alert("Error processing request, please try again");
	// 	}
	// 	});
	// 	e.preventDefault();

	// });


	//===========================================================
	//===========================================================
	//===========================================================
	//CAMERON
	var allStocksTable;
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');

	//snackbar/toast function
	function updateSnackbarFunction(m) {
		$("#notif-message").text(m);
		var x = document.getElementById("update-snackbar");
		x.className = "show-update";
		setTimeout(function(){ x.className = x.className.replace("show-update", ""); }, 3000);
	}

	//loading datatable
	$(document).ready(function() {
        allStocksTable = $('#stocksTable').DataTable({
			'ajax': '{{ url("library/fetch_all_stocks") }}',
      		"order": [[ 1, "asc" ]],
			"columns": [
			{ "data": "stock_code", "width": "15%" },
			{ "data": "description", "width": "30%" },
			{ "data": "unit", "width": "10%" },
			{ "data": "expense_category", "width": "30%" },
			{ 'data': null, 
				title: 'Action', 
				wrap: true, 
				"render": function (item) { 
					return '<a href="#" class="btn btn-warning edit-ind-stock" data-id="' + item.id + '"><i class="fa fa-pencil-square-o"></i></a>&nbsp;' 
					+ '<a href="#" class="btn btn-danger delete-ind-stock" data-id="' + item.id + '"><i class="fa fa-trash"></i></a>' 
				}, 
				"width": "6%" 
			},
			]
		});
    });

	//opening new stocks modal
	function addStocksModal() {
		$("#addStocksModal").modal('show');
	}

	//saving new stock
	$(document).on("click",".add-ind-stock",function(e){
		var stock_code = $('#stock_code').val();
		var stock_description = $('#description').val();
		var unit = $('#unit').find(":selected").val();
		var expense_category = $('#expense_category').find(":selected").val();

		$.ajax({
			url: "{{ route('upload_individual_stocks') }}",
			type: "POST",
			data: {
				_token: CSRF_TOKEN,
				stock_code: stock_code,
				description: stock_description,
				unit: unit, 
				expense_category: expense_category
			},
			success: function(response) {
				$("#addStocksModal").modal("hide");
				allStocksTable.ajax.reload(null, false);
				updateSnackbarFunction("Stock added successfully.");
			}, error: function() {
				alupdateSnackbarFunction("Error processing request, please try again");
			}
		});
		e.preventDefault();

	});

	//upload excel
	$(document).on("click", ".upload-excel-file", function(e) {
		var excel_file = $('#input-excel-file')[0].files;

		if(excel_file.length > 0) {
			var fd = new FormData();

			fd.append('file',excel_file[0]);
			fd.append('_token', CSRF_TOKEN);

			$.ajax({
				url: "{{ route('batch_upload_stocks') }}",
				type: "POST",
				data: fd,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(response) {
					$("#addStocksModal").modal("hide");
					allStocksTable.ajax.reload(null, false);
					console.log("success");
					updateSnackbarFunction("Stock added successfully.");
				},
				error: function(response) {
					$("#addStocksModal").modal("hide");
					updateSnackbarFunction("Error processing request, please try again.");
				}
			});
		}
	});

	//new edit 
	$(document).on("click", ".edit-ind-stock" , function(e) {
		var stock_id = $(this).attr("data-id"); 

		$.ajax({
			url: "{{ url('/supplies-summary/get-stock') }}/" + stock_id,
			type: 'get',
			dataType: 'json',
			success:function(response) {
				$("#editStocksModal").modal('show');
				$('#edit_stock_id').val(response.id);
				$('#edit_stock_code').val(response.stock_code);
				$('#edit_description').val(response.description);
				document.getElementById("select2-edit_unit-container").innerHTML = response.unit;
				$('#edit_unit option[value="'+response.unit+'"]').prop('selected', true);
				document.getElementById("select2-edit_expense_category-container").innerHTML = response.expense_category;
				$('#edit_expense_category option[value="'+response.expense_category+'"]').prop('selected', true);
			}
		});
	});

	//new update stock
	$(document).on("click",".new_update_stock",function(e){

		var id = $('#edit_stock_id').val();

		var edit_stock_code = $('#edit_stock_code').val();
		var edit_stock_description 	= $('#edit_description').val();
		var edit_unit = $('#edit_unit').find(":selected").val();
		var edit_expense_category = $('#edit_expense_category').find(":selected").val();

		$.ajax({
			url: "{{ url('/library/update_ind_stock') }}/" + id,
			type: "POST",
			data: { _token: CSRF_TOKEN, 
					stock_code: edit_stock_code,
					description: edit_stock_description, 
					unit: edit_unit, 
					expense_category: edit_expense_category
				},
			success: function(response) {
					$("#editStocksModal").modal('hide');
					allStocksTable.ajax.reload(null, false);
					updateSnackbarFunction("Item updated successfully.");
			}, error: function(response) {
				$("#editStocksModal").modal('hide');
				updateSnackbarFunction("Error processing request, please try again.");
			}
		});
		e.preventDefault();
	});

	//new delete stock
	$(document).ready(function() {
		$(document).on("click",".delete-ind-stock", function(e){
			var id = $(this).attr("data-id"); 
			if (confirm('Are you sure you want to remove/delete this stock item?')) {
				$.ajax({
					url: "{{ url('/library/remove_stock') }}/" + id,
					type: "POST",
					data: {_token: CSRF_TOKEN, id: id},
					success: function() {
						allStocksTable.ajax.reload(null, false);
						updateSnackbarFunction("Item deleted successfully.");
					},
					error: function(){
						updateSnackbarFunction("Error processing request, please try again.");
					}
				});
			}
			event.preventDefault();
		});
	});


</script>

@endsection