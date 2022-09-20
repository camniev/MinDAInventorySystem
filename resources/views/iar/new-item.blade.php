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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Inspection and Acceptance Form</div>

    	<div  style="background-color: #fff; display: inline-block;">

<!--Content-->
<form method="POST" action="{{ url('/inspection-and-acceptance/save-inspection-title') }}" accept-charset="utf-8" enctype="multipart/form-data">
	@csrf
	<div class="form-group row">
	   	<label for="EntityName" class="col-md-4 col-form-label text-md-right mt-3">Entity Name</label>

	    <div class="col-md-6 mt-3">
	        <input type="text" name="EntityName"  class="form-control" width="1px" maxlength="255" value="MINDANAO DEVELOPMENT AUTHORITY" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="FundCluster" class="col-md-4 col-form-label text-md-right">Fund Cluster</label>
	        <div class="col-md-6">
	            <input type="text" name="FundCluster" class="form-control" value="101" required>
	        </div>
	</div>
	<div class="form-group row">
	    <label for="Supplier" class="col-md-4 col-form-label text-md-right">Supplier</label>
			<div class="col-md-6">
	            <input type="text" name="Supplier" class="form-control" required cols="10" rows="10"></input>
	        </div>
	</div>
	<div class="form-group row">
	    <label for="PONumber" class="col-md-4 col-form-label text-md-right">P.O. Number</label>
	        <div class="col-md-6">
	            <input type="text" name="PONumber" class="form-control" required cols="10" rows="10"></input>
	        </div>
	</div>
	<div class="form-group row">
	    <label for="Department" class="col-md-4 col-form-label text-md-right">Requisitioning Office/Dept</label>
	        <div class="col-md-6">
	            <input list="risoffice_datalist" name="risoffice" id="risoffice" class="req_code form-control" onblur="getcode(document.getElementById('risoffice'), document.getElementById('risoffice_datalist'));" style="width:250px">
	                <datalist id="risoffice_datalist">
	                	@if($papcode->count()>0)
	                	@foreach($papcode as $l)
							<option value="{{ $l->division }}">
						@endforeach
						@endif
					</datalist>
				<input type="hidden" id="optselect" name="optselect">
			</div>
	</div>
	<div class="form-group row">
	    <label for="RespoCenter" class="col-md-4 col-form-label text-md-right">Respo Center Code</label>
	        <div class="col-md-6">
	            <input type="text" name="RespoCenter" id="RespoCenter" class="form-control" readonly></input>
			</div>
	</div>
	<div class="form-group row">
	    <label for="RespoCenter" class="col-md-4 col-form-label text-md-right">PAPCode</label>
	        <div class="col-md-6">
	            <input type="text" id="papcode" name="papcode" class="form-control" readonly style="width:250px"></input>
	    	</div>
	</div>

	<div class="form-group row">
	    <label for="InvoiceNo" class="col-md-4 col-form-label text-md-right">Invoice No</label>
	        <div class="col-md-6">
	            <input type="text" name="InvoiceNo" class="form-control" required cols="10" rows="10"></input>
	        </div>
	</div>
	<div class="form-group row">
	    <label for="InvoiceDate" class="col-md-4 col-form-label text-md-right">IAR Date</label>
	        <div class="col-md-6 datepicker">
	            <input type="date" name="InvoiceDate" class="form-control" value="<?php echo date("Y-m-d");?>" required>
	        </div>
	</div>

	<div class="form-group row mb-3 mr-5 pr-5" style="float: right;">
	    <div class="col-md-6 offset-md-4">
	        <button type="submit" class="btn btn-sm btn-primary pl-2 pr-2 d-flex" style="color: #fff;  font-family: Calibri;"><span class="fa fa-floppy-o" style="vertical-align: middle;"> Save</span></button>
	    </div>
    </div>
</form>


<!--Content End-->
    	</div>

    </section>

</div>

</div>

<script>

function getcode(el, dl){
		if(el.value.trim() != ''){
		    var opSelected = dl.querySelector(`[value="${el.value}"]`);
		    var option = document.createElement("option");
		    option.value = opSelected.value;
		    option.text = opSelected.getAttribute('value');

		    var x = opSelected.getAttribute('value');

		    url="{{ url('/papcode/get-codes') }}/"+x;

		    //alert(x);
		    
		    document.getElementById('optselect').value=x;

		    $.ajax({
			    url: "{{ url('/papcode/get-codes') }}/"+x,
			    context: document.body,
			    success: function(data){
			      console.log(data);
			      $('input#papcode').val(data.data[0].papcode);
			      $('input#RespoCenter').val(data.data[0].respocenter);
			    }
});

  		}
}


</script>
@endsection