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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>Inventory Custodian Slip  &nbsp;&nbsp;&nbsp;&nbsp;<span id="qresult" style="color: #0B3861; font-style: bold"></span></Strong>
    		<span class="d-flex float-right mr-5 mb-1" style="margin-top: -3px;"><button onclick="export_excel();" class="btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
    	</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<table>
	<th class="pl-5">FY</th>
	<th colspan="7">
							
		<select id="cy" name="cy" class="form-control mt-1 mb-1" style="width:120px" onchange="searchCY();">
			@if($cy->count()>0)
				<option value="" selected disabled hidden>Select FY</option>
			@foreach($cy as $y)
				<option id="opt" value="{{$y->cy}}">{{$y->cy}}</option>
			@endforeach
			@endif
		</select>
	</th>

	<th class="d-flex" valign="middle" align="right"><span class="mt-3" style="float: right; margin-left: auto;">Filter: </span>&nbsp;&nbsp;
							
		<select id="euser" name="euser" class="form-control mt-1 mb-1" style="width:200px; float: right;" onchange="searchEnduserChange();">
			@if($user->count()>0)
				<option value="" selected disabled hidden>Choose End-User</option>
			@foreach($user as $ui)
				<option value="{{$ui->requested_by}}">{{$ui->requested_by}}</option>
			@endforeach
			@endif

		</select>
							
	</th>

		<tr>
			<td align="center" valign="center" rowspan="2" style="width: 80px; padding-left: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>ICS No.</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 90px; padding-left: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5;  background-color: #BDBDBD; color: #1C1C1C;"><strong>Quantity</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 90px; padding-left: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Unit</strong></td>
			<td align="center" valign="center" colspan="2" style="width: 120px; padding-left: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Amount</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 230px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Description</strong></td>
			<td align="center" valign="tocenterp" rowspan="2" style="width: 130px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Property Number/<br/>Inventory Item No.</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 80px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Estimated<br/>Useful Life</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 130px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>End-User</strong></td>
			<td align="center" valign="center" rowspan="2" style="width: 130px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5; background-color: #BDBDBD; color: #1C1C1C;"><strong>Remarks</strong></td>
		</tr>
		<tr>
			<td align="center" style="background-color: #BDBDBD; color: #1C1C1C;; padding: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5;"><strong>Unit Cost</strong></td>
			<td align="center" style="background-color: #BDBDBD; color: #1C1C1C;; padding: 5px; border-right: 1px solid #A9D0F5; border: 1px solid #A9D0F5;"><strong>Total Cost</strong></td>
		</tr>

		@if($data->count()>0)
		@foreach($data as $i)
		<tr>
			<td class="p-3">{{$i->par_ics_series}}</td>
			<td class="p-3">{{$i->quantity}}</td>
			<td class="p-3">{{$i->unit}}</td>
			<td class="p-3" align="right">{{number_format($i->cost, 2, '.', ',')}}</td>
			<td class="p-3" align="right">{{number_format($i->cost * $i->quantity, 2, '.', ',')}}</td>
			<td class="p-3" style="white-space: pre-wrap;">{!!nl2br(str_replace(" ", " &nbsp;", $i->description))!!}</td>
			<td class="p-3">{{$i->prop_num}}</td>
			<td class="p-3">{{$i->consume_days}}</td>
			<td class="p-3" align="center">{{$i->requested_by}}</td>
			<td class="p-3">{!!nl2br(str_replace(" ", " &nbsp;", $i->remarks))!!}</td>
		</tr>
		{{--
		<script>
			if(!{{$i->date_assumed}}){
				var date = new Date('{{$i->date_assumed}}');

					y = date.getFullYear();
					m = date.getMonth() + 1;
					d = date.getDate();

				var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
								document.getElementById("span_{{$i->id}}").innerHTML = months[date.getMonth()] + " " + d + ", " + y;
			}
		</script>
		--}}
		@endforeach
		@endif
		<tr>
			<td colspan="10" class="mb-5">
				<a href="{{ url('/inventory-custodian-slip') }}" class="btn btn-sm btn-success mt-1 mb-1 mr-1" style="color: #fff; float: right;"><span class="fa fa-list-ol" style="vertical-align: middle;"></span> List All</a>

			</td>
		</tr>


	</table>

	@if($data->count() > 0)
		<div class="justify-content-center mb-5" style="margin-top: 10px; color: #084B8A">{{ $data->links() }}

		</div>
						
	@endif
<!--Content End-->
    </div>

</section>

</div>

</div>

<!--Modal Section-->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  	<div class="modal-dialog  modal-lg" role="document" style="width: 20%;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="edit-modal-label">Confirmation<span id="item_name" name="item_name" style="color: #045FB4;"></span> </h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
        			
        			<div class="m-3">Do you want to add Fiscal Year on you search?</div>
        					

        			<div><button onclick="searchuser();" style="float: right;" class="btn btn-sm btn-danger mt-2 mb-2 ml-1 mr-2  pl-3 pr-3"> No</button><button onclick="searchfyuser();" style="float: right;" class="btn btn-sm btn-success mt-2 mb-2  pl-3 pr-3"> Yes</button></div>

    		</div>
		</div>
	</div>

<script>
	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();

	var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	//document.getElementById("date").innerHTML = months[n.getMonth()] + " " + d + ", " + y;
	//document.getElementById("date").innerHTML = months[n.getMonth()] + " " + y;

	function searchCY() {
	  var x = document.getElementById("cy").value;
	  //alert(x);
	  window.location = "{{ url('/inventory-custodian-slip/list-by-fiscal-year') }}/" + x
	}

	function searchEnduser() {
	  var x = document.getElementById("cy").value;
	  var y = document.getElementById("euser").value;
	  //alert(x);
	  if (confirm('Do you want to filter by FY and End-user?')) {
	    	window.location = "{{ url('/inventory-custodian-slip/list-by-fiscal-year-end-user') }}/" + x +"/" + y
		} else {
	    	window.location = "{{ url('/inventory-custodian-slip/list-by-end-user/') }}/" + y
		}

	}

	function searchEnduserChange() {
		$('#edit-modal').modal('show');
	}

	function searchfyuser(){
		var x = document.getElementById("cy").value;
	  	var y = document.getElementById("euser").value;

	  	window.location = "{{ url('/inventory-custodian-slip/list-by-fiscal-year-end-user') }}/" + x +"/" + y

	}

	function searchuser(){
			var x = document.getElementById("cy").value;
		  	var y = document.getElementById("euser").value;
		  	window.location = "{{ url('/inventory-custodian-slip/list-by-end-user/') }}/" + y

		}
</script>

<script>
	$(document).ready(function() {
		var arr = (window.location.pathname).split("/");
		var val = (arr[arr.length-1]);
		var user = (arr[arr.length-2]);
			$('[id=cy] option').filter(function() { 
			    return ($(this).text() == val); //To select cy
			}).prop('selected', true);

		if(user.length > 4){
			document.getElementById("qresult").innerHTML = "(Search result: " + val + ")";
		}else{
			document.getElementById("qresult").innerHTML = "(Search result: " + user + " : " + val + ")";
		}

	});


	function export_excel()
	{

		var url = window.location.pathname;

		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-1]);
		var id2 = (arr[arr.length-2]);

		//alert(id2.length+'\n'+id2);

		if(id.length < 24){
			if(id.length >= 4 && id.length < 24){
				
				if(isNaN(id)){
					
					if(!isNaN(id2)){
						window.location = "{{ url('/export-excel-ics/excel-output/cy-user-export') }}/"+id+"/"+id2;
					}else{
						window.location = "{{ url('/export-excel-ics/excel-output/cy-user') }}/"+id;
					}
					
				}else{
					window.location = "{{ url('/export-excel-ics/excel-output/cy-user') }}/"+id;
				}
			}
		}else{
			
			window.location = "{{ url('/export-excel-ics/excel-output/list-all') }}";
		}
	}
</script>
@endsection