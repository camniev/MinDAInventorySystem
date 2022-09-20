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
									<td colspan="5" class="p-3 pr-3"><strong>ENTITY NAME: </strong>MINDANAO DEVELOPMENT AUTHORITY</td>
									<td colspan="3" class="p-3 pr-3"><strong>FUND CLUSTER: </strong>{{$l->cluster}}</td>
								</tr>
								<tr>
									<td colspan="5" class="p-3 pr-3"><strong>DIVISION: </strong>{{$l->division}}</td>
									<td colspan="3" class="p-3 pr-3"><strong>RESPONSIBILITY CENTER CODE: </strong>{{$l->respo_center}}</td>
								</tr>
								<tr>
									<td colspan="5" class="p-3 pr-3"><strong>PAPCODE: </strong>{{$l->papcode}}</td>
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
										var val = (arr[arr.length-3]);
										//alert(val);
										document.getElementById("req_num").value = val;
			         			</script>
								<tr>
									<td colspan="8" class="p-3 pr-3 justify-content-center" align="center"><strong>Lists of Stocks</strong></td>
								</tr>
								<tr>
									<td colspan="3" class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff;">Stock Lists</td>
									<td class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Unit</td>
									<td colspan="2" class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Quantity</td>
									<td class="p-3 pr-3" align="center" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff">Balance</td>
									<td align="center" style="width: 150px;border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Category</strong></td>
								</tr>
								@foreach($data as $i)
								<tr>
									

									<td colspan="3" class="p-3" align="left">{!!nl2br(e($i->item))!!}</td>
									<td class="p-4" align="center">{{$i->unit}}</td>
									<td colspan="2" class="p-3" align="center">{{$i->available}}</td>
									<td class="p-3" align="center"><span id="bal_{{$i->id}}"></span></td>
									<td align="center">{{$i->category}}</td>
									<input type="hidden" name="total_bal_{{$i->id}}" id="total_bal_{{$i->id}}">
									<script>
											var it = {!! json_encode($i->stock_number) !!};
											var di = {!! json_encode($i->id) !!};
											url = "{{url('/request/details-get-stock-balance')}}/"+it;
											$.get(url, function (data) {
       											//console.log(data);
       											var b='bal_'+{!! json_encode($i->id) !!};
       											var tb='total_bal_'+{!! json_encode($i->id) !!};
       											document.getElementById(tb).value=data.data[0].quantity;
		       									document.getElementById(b).innerHTML=data.data[0].quantity;
		       									
       										});
									</script>

								</tr>
								@endforeach
								
						</table>
					</form>
								<tr>
									<td colspan="8" class="mb-5">
										<span class="d-flex float-left mt-2 ml-3" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff; font-size: 11px;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
										<span class="d-flex float-right mb-2 mt-2" style="margin-top: 10px;">
											<a onclick="goBack();"  class="btn btn-sm btn-primary pl-4 pr-4 mr-3" style="color: #fff; font-size: 11px;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>
										</span>
									</td>
								</tr>

				</div>
@else

<div class="p-3 ml-3 pr-1 mr-1" style="margin-left: 10px; margin-right: 1px;">
	<div class="row justify-content-center">
		<div>
			<div class="card">
				<div class="card-header">
					<div class="card-header" style="color: #FF0000; font-size: 18px;"><Strong>No Items found!</Strong></div>
					<div class="mt-3 mb-3">No available items listed on your division so far</div>
					<div class="d-flex float-right"><a onclick="location = '{{ url('/request') }}';"><button class="btn btn-sm btn-primary">Back</button></a></div>
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


        if (parseInt(my_input1) > parseInt(my_input2)) 
        {
        	sendAlert("Requested quantity is greater than stock available",5000);
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


	function goBack(){
		window.history.back();
	}
	
	function export_excel()
	{

		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-2]);
		var id2 = (arr[arr.length-1]);

		window.location = "{{ url('/export-pdf-report/ris') }}/"+id+"/"+id2;
	}
</script>
@endsection