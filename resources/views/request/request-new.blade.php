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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Requisition and Issue Slip (RIS)</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<form id="form" method="POST" action="{{ url('/request/save-request') }}"  accept-charset="utf-8" enctype="multipart/form-data">
	@csrf
	<table>
		<tr>
			<td width="100" class="p-2"><strong>ENTRIY NAME: </strong></td>
			<td class="p-2">MINDANAO DEVELOPMENT AUTHORITY</td>
		</tr>
		<tr>
			<td class="p-2"><strong>DIVISION</strong></td>
			<td class="p-2"><input list="papcode_datalist" name="division" id="division" class="req_code form-control p-2" style="width: 300px;" onblur="getcode(document.getElementById('division'), document.getElementById('papcode_datalist'));"></td>
					<datalist id="papcode_datalist">
			            @if($papcode->count()>0)
			            @foreach($papcode as $l)
							<option value="{{ $l->division }}">
						@endforeach
						@endif
					</datalist>
					<input type="hidden" id="optselect" name="optselect">
		</tr>
		<tr>
			<td class="p-2"><strong>PAP CODE</strong></td>
			<td class="p-2"><input type="text" name="papcode" id="papcode" class="form-control p-2" style="width: 200px;" readonly></td>
		</tr>
		<tr>
			<td class="p-2"><strong>RESPONSIBILITY CENTER CODE</strong></td>
			<td class="p-2"><input type="text" name="respo_center" id="respo_center" class="form-control p-2" style="width: 300px;" readonly></td>
		</tr>
		<tr>
			<td class="p-2"><strong>OFFICE</strong></td>
			<td class="p-2"><input type="text" name="office" id="office" class="form-control p-2" style="width: 300px;"></td>
		</tr>
		<tr>
			<td class="p-2"><strong>PURPOSE</strong></td>
			<td class="p-2"><textarea name="purpose" id="purpose" class="form-control p-2" cols="3" rows="4" style="width: 300px;"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td class="p-2 mb-5"><button class="btn btn-sm btn-primary" style="float: left; margin-left: 220px;">Proceed <span class="fa fa-chevron-right"></span></button></td>
		</tr>
	</table>
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
			      $('input#respo_center').val(data.data[0].respocenter);
				}
		});
			

  	}
}


</script>
@endsection