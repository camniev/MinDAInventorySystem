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

    	<div  style="background-color: #fff; display: inline-block;  width: 100%;">

<!--Content-->
@if($data->count()>0)
@foreach($data as $l)
@endforeach

<div align="center">Republic of the Philippines</div>
<div align="center">Office of the President</div>
<div align="center" style="font-size: 18px; font-family: Copperplate Gothic Bold"><strong>MINDANAO DEVELOPMENT AUTHORITY</strong></div>
<form method="POST" action="{{ url('/request/save-request-detail') }}/{{$l->id}}"  accept-charset="utf-8" enctype="multipart/form-data">
	@csrf
	<table border="1px #fff solid;" style="table-layout: fixed;">
		<tr>
			<td colspan="6" class="p-3 pr-3"><strong>ENTITY NAME: </strong>MINDANAO DEVELOPMENT AUTHORITY</td>
			<td colspan="3" class="p-3 pr-3"><strong>FUND CLUSTER: </strong>{{$l->cluster}}</td>
		</tr>
		<tr>
			<td colspan="6" class="p-3 pr-3"><strong>DIVISION: </strong>{{$l->division}}</td>
			<td colspan="3" class="p-3 pr-3"><strong>RESPONSIBILITY CENTER CODE: </strong>{{$l->respo_center}}</td>
		</tr>
		<tr>
			<td colspan="6" class="p-3 pr-3"><strong>PAPCODE: </strong>{{$l->papcode}}</td>
			<td colspan="3" class="p-3 pr-3"><strong>RIS NO.: </strong>{{$l->ris_num}}</td>
		</tr>
			<input type="hidden" name="entity_name" value="MINDANAO DEVELOPMENT AUTHORITY">
			<input type="hidden" name="division" value="{{$l->division}}">
			<input type="hidden" name="papcode" value="{{$l->papcode}}">
			<input type="hidden" name="responsibility" value="{{$l->respo_center}}">
			<input type="hidden" name="cluster" value="{{$l->cluster}}">
			<input type="hidden" name="ris_num" value="{{$l->ris_num}}">
			<input type="hidden" id="req_num" name="req_num" value="">

				<script type="text/javascript">
				       	var arr = (window.location.pathname).split("/");
						var val = (arr[arr.length-2]);
						//alert(val);
						document.getElementById("req_num").value = val;
			        </script>
		<tr>
			<td colspan="7" class="p-3 pr-3 justify-content-center" align="center"><strong>Lists of Stocks</strong></td>
		</tr>
		<tr>
			<td colspan="4" class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff;">Stock Lists</td>
			<td class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Unit</td>
			<td colspan="2" class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Quantity</td>
			<td colspan="2" class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Balance</td>
		</tr>
		<tr>
			<td colspan="4" class="p-2">
				<select id="itemname" name="itemname" class="items form-control" style="width:380px; overflow: hidden;" onclick="filterList()">
					@foreach ($data as $list)
						<option value="{{$list->stock_number}}">{{$list->description}}</option>
			        @endforeach
		        </select>
		        <input type="hidden" name="optselect" id="optselect" value="">
			</td>
				<input type="hidden" id="description" name="description" value="">
				<input type="hidden" id="cost" name="cost" value="">
				<input type="hidden" id="stocknumber" name="stocknumber" value="">

						<script>
							function filterList() {
							  	var text=document.getElementById('itemname').options[document.getElementById('itemname').selectedIndex].text;
						  		document.getElementById('description').value=text;

						  		var arr = (window.location.pathname).split("/");
								var val = (arr[arr.length-3]);

											//alert(text);

						  		url = "{{ url('/request/get-stock-info') }}/"+text+"/"+val;

						  		$.get(url, function (data) {
       								console.log(data);

       												//alert(data.data[0].id);
       									url2 = "{{ url('/request/get-stock-balance') }}/"+data.data[0].id;

       									$.get(url2, function (data2) {
		       								console.log(data2);
		       								document.getElementById("stocknumber").value=data2.data[0].stock_number;
		       								document.getElementById("unit").value=data2.data[0].unit;
		       								document.getElementById("bal").value=data2.data[0].available;
		       								document.getElementById("optselect").value=data2.data[0].stock_number;
		       								document.getElementById("cost").value=data2.data[0].cost;
		       								document.getElementById("category").value=data2.data[0].category;
		       								document.getElementById("consume").value=data2.data[0].consume_days;
		       							});

       							});
							}
     					</script>
									
			<td align="center"><input style="text-align: center; width: 120px;" type="text" name="unit" id="unit" class="form-control"></td>
			<td colspan="2" align="center"><input style="text-align: center; width: 100px;" type="number" id="quantity_1" name="quantity_1" class="form-control m-2" maxlength="25"required onkeyup="doMath();">
			</td>
			<td colspan="2" align="center">
				<input class="form-control m-2" style="text-align: center; width: 100px;" type="number" id="bal" name="bal" value="{{$l->available}}" readonly>
				<input type="hidden" id="balance" name="balance" value="">
				<input type="hidden" name="category" id="category" value="">
				<input type="hidden" name="consume" id="consume" value="">
			</td>
		</tr>
		<tr>
			<td colspan="9">
				<span class="d-flex float-right mb-2 mt-2 mr-2" style="margin-top: 10px;">
					<button type="submit" class="btn btn-sm btn-primary mr-3" style="color: #fff"><span class="fa fa-floppy-o"></span> Save Request</button>
						<a onclick="location = '{{ url('/request') }}';"  class="btn btn-sm btn-success pl-4 pr-4" style="color: #fff"><span class="fa fa-check-square-o" style=""></span> Done</a>
				</span>
			</td>
		</tr>
		@foreach($lists as $i)
		<tr>
									
			<td colspan="4" class="p-3" align="left">{!!nl2br(str_replace(" ", " &nbsp;", $i->item))!!}</td>
			<td class="p-4" align="center">{{$i->unit}}</td>
			<td class="p-3" align="center">{{$i->quantity}}</td>
			<td colspan="2" class="p-3" align="right"><span id="bal_{{$i->id}}"></span></td>
									
			<td class="mb-5"><a href="{{ url('/request/detete-detail')}}/{{$i->division}}/{{$i->stock_number}}/{{$i->id}}/{{$i->quantity}}/{{$i->series_id}}" class="btn btn-sm btn-danger mr-2 mt-1 mb-1 pr-3" style="float: right; color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o" style=""></span> Delete</a></td>
			<input type="hidden" name="total_bal_{{$i->id}}" id="total_bal_{{$i->id}}">

				<script>
						var it = {!! json_encode($i->stock_number) !!};
						var di = {!! json_encode($i->id) !!};
						url = "{{url('/request/details-get-stock-balance')}}/"+it;
						$.get(url, function (data) {
       											//console.log(data);
       						var b='bal_'+{!! json_encode($i->id) !!};
       						var tb='total_bal_'+{!! json_encode($i->id) !!};
       						var c='cons_'+{!! json_encode($i->id) !!};
       						var ct='cat_'+{!! json_encode($i->id) !!};
       						var parics='par_ics_'+{!! json_encode($i->id) !!};

		       				document.getElementById(b).innerHTML=data.data[0].available;
		       				document.getElementById(tb).value=data.data[0].available;
		       				document.getElementById(ct).innerHTML=data.data[0].category;
		       		
       					});

				</script>

		</tr>
		@endforeach
	</table>
</form>

@else

<div class="p-3 ml-3 pr-1 mr-1" style="margin-left: 10px; margin-right: 1px;">
	<div class="row justify-content-center">
		<div>
			<div class="card">
				<div class="card-header">
					<div class="card-header" style="color: #FF0000; font-size: 18px;"><Strong>No Items found!</Strong></div>
					<div class="mt-3 mb-3">No available items listed on your division so far</div>
					<div class="d-flex float-right"><a onclick="location = '{{ url('/requisitions-and-issue-slip') }}';"><button class="btn btn-sm btn-primary">Back</button></a></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endif


<!--Content End-->
    	</div>

    </section>

</div>

</div>

<script>
	
	function doMath()
    {
        var my_input1 = document.getElementById('quantity_1').value;
        var my_input2 = document.getElementById('bal').value;

        //alert(my_input2);

        if (parseInt(my_input1) > parseInt(my_input2)) 
        {
        	sendAlert("Requested quantity is greater than stock available",5000);
        	//alert('Requested quantity is greater than stock available');
        	document.getElementById("quantity_1").value=0;
        }else{
	        var sum = parseInt(my_input1) - parseInt(my_input2);
	        if (!isNaN(sum)) {
	        	document.getElementById("balance").value=sum;
	    	}
	    }
    }

	function sendAlert(msg,duration)
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

</script>
@endsection