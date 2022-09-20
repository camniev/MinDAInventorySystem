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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Physical Count of Property, Plant and Equipment</div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<table>
	<tr>
		<td class="p-3" style="width: 170px; padding-left: 5px;  background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>RIS Number</strong></td>
		<td class="p-3" style="width: 20%; padding-left: 5px; background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Division</strong></td>
		<td class="p-3" style="width: 270px; padding-left: 5px; background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Personnel</strong></td>
		<td class="p-3" style="width: 170px; padding-left: 5px;  background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Position</strong></td>
							
		<td class="p-3" align="center" style="width: 130px;  background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5;"><strong>Action</strong></td>
	</tr>

		@if($data->count()>0)
		@foreach($data as $i)
		<tr>
			@if($i->complete==1)
				<td class="pl-2">{{$i->ris_num}}</td>
				<td class="pl-2">{{$i->division}}</td>
				<td class="pl-2">{{$i->requested_by}}</td>
				<td class="pl-2">{{$i->requested_by_pos}}</td>

				<td class="justify-content-center mb-5" style="text-align: center;">
					<div class="row justify-content-center d-flex">
						<button id="{{ $i->id }}" class="date_range btn btn-sm btn-success ml-2 mr-2 mt-2 mb-2" style="text-decoration: none; margin-right: 10%; color: #fff" title="View Details"><span class="fa fa-eye"></span><br/>View</button>

						<a href="{{ url('/report-on-the-physical-count-of-property-plant-and-equipment/remove-rpcppe-details') }}/{{$i->id}}" class="btn btn-sm btn-danger  mt-2 mb-2 mr-1" style="color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o"></span><br/>Delete</a>
					</div>
				</td>
			@else
				<td class="pl-2" style="color: #0404B4"><strong>{{$i->ris_num}}</strong></td>
				<td class="pl-2" style="color: #0404B4"><strong>{{$i->division}}</strong></td>
				<td class="pl-2" style="color: #0404B4"><strong>{{$i->requested_by}}</strong></td>
				<td class="pl-2" style="color: #0404B4"><strong>{{$i->requested_by_pos}}</strong></td>
	

				<td class="justify-content-center mb-5" style="text-align: center;">
					<div class="row justify-content-center d-flex">
						<button id="{{ $i->id }}" class="date_range btn btn-sm btn-success ml-2 mr-2 mt-2 mb-2" style="text-decoration: none; color: #fff" title="View Details"><span class="fa fa-eye"></span><br/>View</button>

						<a href="{{ url('/report-on-the-physical-count-of-property-plant-and-equipment/remove-rpcppe-details') }}/{{$i->id}}" class="btn btn-sm btn-danger  mt-2 mb-2 mr-1" style="color: #fff" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o"></span><br/>Delete</a>
					</div>
				</td>
			@endif
							
		</tr>

			<script>
				var date = new Date('{{$i->date_receive}}');

					y = date.getFullYear();
					m = date.getMonth() + 1;
					d = date.getDate();

				var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

				if(m===null){
								
				}else{
					document.getElementById("span_{{$i->id}}").innerHTML = months[date.getMonth()] + " " + d + ", " + y;
				}
			</script>

			@endforeach
			@endif

			@if($data->count() > 0)
			<tr>
				<td colspan="7" style="border-bottom:  1px solid #fff;" class="mb-5">
					<div class="justify-content-center" style="font-size: 10px; margin-top: 10px;">{{ $data->links() }}</div>
								
				</td>
			</tr>
			@endif


</table>

<!--Content End-->
    </div>

</section>

</div>

</div>


<div class="modal fade" id="date-range" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto; max-width: 50%"  role="document">
    <div class="modal-content">
      <div class="modal-header"><span style="font-size: 24px; color: #FF4000; text-align: center;"><strong>REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</strong></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
      		<table width="60%">
      			<th style="font-size: 20px; color: #0B3861;" align="center" class="text-center">Select Accountability Date for Personnel's name '{{$i->requested_by}}'</th>
      			<tr>
      				<td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2">

      					<input list="rep_date" name="rp_date" id="rp_date" class="form-control" style="width: 200px;"><span style="font-style: italic;">"Note: double-click the box or down arrow to show the list"</span>
      					<datalist id="rep_date"></datalist>
      				</td>
      				
      				<input type="hidden" id="_id" name="_id" value="">
      				<input type="hidden" id="person" name="person" value="{{$i->requested_by}}">

      			</tr>
      			<tr>
      				<td  class="p-3" style="border-top: solid thin #fff;"><span style="float: right;" class="mr-3"><a href="javascript:void(0);" class="go_btn btn btn-small btn-success"><span class="fa fa-search"></span> View</a></span></td>
      			</tr>

      		</table>
				
      		<div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>


	$(document).ready(function() {

		$(document).on("click", ".date_range", function() {
			var stock 	= $(this).attr("id"); 

			var d = new Date();
	      	var m = d.getMonth()+1;

	      	var listdate = new Array();
	      	var options = '';
	      	var p = 0;

	      	//document.getElementById("rp_date").value =new Date().getMonth() + " " + new Date().getFullYear();

			document.getElementById("_id").setAttribute('value',stock);
			
			var p_name = $("#person").val();

			url =  "{{ url('/report-on-the-physical-count-of-property-plant-and-equipment') }}/"+p_name;

			$.get(url, function (data) {
        		console.log(data);

        		for (i = 0; i < data.data.length; i++) {
        			
        			if(data.data[i].report_date !== null){

					  	var n = data.data[i].report_date;
        				var m = n.split("-");
        				var y = m[1];
        				

        				if(m[0]!=p){
        					p=m[0];
						  	var months = [];
						  	months.push(moment().month(m[0]-1).format("MMMM"));
						  	options += '<option value="'+months+', '+y+'" />';
					  	}
					}
				}

				document.getElementById('rep_date').innerHTML = options;

        	});

	        $('#date-range').modal('show');

	        setTimeout(function (){
		        $('input#rp_date').focus();
		    }, 1000);
	    });       
	});

rp_date

	$(document).on("click", ".go_btn", function() {
		var x =  $('input#rp_date').val();
		var p_name = $("#person").val();

		var m = x.split(", ");
		var monthString = m[0];
		var dat = new Date('1 ' + monthString + ' ' + m[1]);

		var mm = dat.getMonth()+1;
		if(x)
		{
			window.location  = "{{ url('/report-on-the-physical-count-of-property-plant-and-equipment/details') }}/"+mm+"-"+m[1]+"/"+p_name;
		}else{
			warnAlert('Error: Please select correct date',2000);
		}

	});

	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();

	var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	//document.getElementById("date").innerHTML = months[n.getMonth()] + " " + d + ", " + y;
	document.getElementById("date").innerHTML = months[n.getMonth()] + " " + y;


function warnAlert(msg,duration)
    {
     var el = document.createElement("div");
     el.setAttribute("style","position:fixed;top:60%;left:45%;margin: 0 auto;background-color:#FF0000; border: solid thin #DF0101; border-radius: 3px; padding-left: 25px; padding-right: 25px; padding-top: 12px; padding-bottom: 12px; color: #ffffff;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858; font-size: 16px;");
     el.innerHTML = msg;

     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
     $(el).hide().fadeIn('slow');
    }
</script>
@endsection