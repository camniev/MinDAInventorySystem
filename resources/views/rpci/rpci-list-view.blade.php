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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>Supplies and Materials</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<div class="card-header"><Strong>Physical Count of Inventories</Strong></div>
						<input type="hidden" id="rpci_num" name="rpci_num" value="">

								<script type="text/javascript">
				         				var arr = (window.location.pathname).split("/");
										var val = (arr[arr.length-1]);
										//alert(val);
										document.getElementById("rpci_num").value = val;
			         			</script>

						<table>
							<th align="center" colspan="11" style="text-align: center; border-bottom: 1px solid #fff; font-family: Cambria;">REPORT ON THE PHYSICAL COUNT OF INVENTORIES</th>
							<tr>
								<td colspan="11" align="center" style="border-bottom: solid 1px #fff; border-right: solid 1px #59ACFB; border-left: solid 1px #59ACFB; font-family: Cambria;"></td>
							</tr>
							<tr>
								<td colspan="11" align="center" style=" border-bottom: solid 1px #fff; border-right: solid 1px #59ACFB; border-left: solid 1px #59ACFB; font-family: Cambria;">As at <span id="date"></span></td>
							</tr>
							<tr style="height: 40px;"><td colspan="11" style="border-bottom: 1px solid #fff; border-right: solid 1px #59ACFB; border-left: solid 1px #59ACFB; font-family: Cambria;"></td></tr>
							<tr>
								<td colspan="11" style=" border-bottom: 1px solid #fff; font-family: Cambria; padding-left: 10px; border-left: solid 1px #59ACFB;">Fund Cluster: {{$data[0]->cluster}}</td>
							</tr>
							<tr>
								<td colspan="9" style="font-family: Cambria; padding-left: 10px; border-left: solid 1px #59ACFB;">For which &nbsp;&nbsp;&nbsp;&nbsp; <strong> {{$sig[0]->IARSupplyOfficer}}, {{$sig[0]->IARSupplyOfficerPos}}. MINDANAO DEVELOPMENT AUTHORITY, &nbsp;&nbsp;&nbsp;&nbsp;</strong> &nbsp;&nbsp;&nbsp;&nbsp;  is accountable, having assumed such accountability on (&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: bold;" id="assumed_date"></span> &nbsp;&nbsp;&nbsp;&nbsp; ).</td>
							</tr>

								
									<script>
										
										var date = new Date('{{$sig[0]->assume_date}}'); // Or your date here
										//alert((date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());

										y = date.getFullYear();
										m = date.getMonth() + 1;
										d = date.getDate();

										var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

										//alert(months[date.getMonth()] + " " + d + ", " + y);
										document.getElementById("assumed_date").innerHTML = months[date.getMonth()] + " " + d + ", " + y;
										
									</script>
									

							<tr>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C; border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Article</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Description</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Stock Number</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Unit Measure</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Unit Value</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Balance Per Card</strong></td>
								<td align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>On Hand Per <br>Count</strong></td>
								<td align="center" colspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;"><strong>Shortage/Overage</strong></td>
								<td colspan="2" align="center" rowspan="2" class="pl-2 pr-2" style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria; width: 300px;"><strong>Remarks</strong></td>
							</tr>
							<tr>
								<td style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;" align="center"><strong>Quantity</strong></td>
								<td style="background-color: #BDBDBD; color: #1C1C1C;border: 1px solid #A9D0F5; font-family: Cambria;" align="center"><strong>Value</strong></td>
							</tr>

							
							@foreach($data as $i)
							<tr>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;"></td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;">{!!wordwrap($i->description,10,"<br>\n")!!}</td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;">
									{{$i->stock_number}}
									<input type="hidden" name="{{$i->id}}_stnum" id="{{$i->id}}_stnum" value="{{$i->stock_number}}">
								</td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;">{{$i->unit}}</td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;" align="right">{{ number_format($i->totalcost, 2, '.', ',') }}</td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;" align="center"><span id="{{$i->id}}_total_stock"></span></td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria; text-align: center;" align="center"><input style="font-family: cambria; text-align: center;" class="form-control" type="text" name="{{$i->id}}" id="{{$i->id}}" value="{{$i->physical_count }}" onblur="update_id(this.id)"></td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;" align="center"><span id="{{$i->id}}_short_over"></span></td>
								<td class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;"></td>
								<td colspan="2" class="p-3 pr-2 mt-2 mb-2" style="font-family: cambria;"><textarea id="{{$i->id}}tx" name="{{$i->id}}tx" cols="20" rows="2" onblur="update_id(this.id)">{!!nl2br(str_replace(" ", " &nbsp;", $i->remarks))!!}</textarea></td>

									<script  type="text/javascript">
											var it = {!! json_encode($i->stock_number) !!};
											var di = {!! json_encode($i->id) !!};
											url = "{{url('/report-on-physical-count-of-inventories/get-stock')}}/"+it;
											$.get(url, function (data) {
       											console.log(data);

       											var tb={!! json_encode($i->id) !!}+'_total_stock';
       											var so={!! json_encode($i->id) !!}+'_short_over';

       											var rl = {!! json_encode($i->physical_count) !!};
       											var st = data.data[0].totalquantity;

       											var res = parseInt(st) - parseInt(rl);

       											document.getElementById(tb).innerHTML=data.data[0].totalquantity;
       											document.getElementById(so).innerHTML=res;
       											
       										});
									</script>
							</tr>

							@endforeach
						

							<tr>
							<td colspan="11">

								<span class="d-flex float-left ml-2" style="margin-top: 3px;"><button onclick="export_excel();" class="reportType btn btn-sm btn-success" style="color: #fff;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
								
								<a href="javascript:history.back()" class="btn btn-sm btn-primary mt-1 mb-1 mr-1" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>

							</td>
						</tr>
						{{--
						<tr>
							<td>
								<button onclick="customerService();">Play</button>  

							</td>

						</tr>
							--}}
						</table>


<!--Content End-->
    </div>

</section>

</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>

	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();

	var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	//document.getElementById("date").innerHTML = months[n.getMonth()] + " " + d + ", " + y;
	document.getElementById("date").innerHTML = months[n.getMonth()] + " " + y;

function export_excel()
	{
		var rpttype	= $('input#reporttype').val();
		var url = window.location.pathname;
		var arr = (window.location.pathname).split("/");
		var id = (arr[arr.length-1]);

		window.location = "{{ url('/export-excel-rpci-details/excel-output') }}/"+id+"/"+rpttype;
	}


function update_id(_id)
  {
  	var int_id = parseInt(_id,10);

  	var CSRF_TOKEN 	= 	$('meta[name="csrf-token"]').attr('content');
  	var xcount 		= 	$('input#'+int_id).val();
  	var xremarks 	= 	$('textarea#'+int_id+'tx').val();
  	var int_so		=	$('span#'+int_id+'_total_stock').text();
  	var stcode 		= 	$('input#'+int_id+'_stnum').val();

  	var int_so = parseInt(int_so);

  	var calc = parseInt(int_so)-parseInt(xcount);

  	$('span#'+int_id+'_short_over').text(calc);

  	//alert(stcode);
  	
	$.ajax({
	      url: "{{ url('/report-on-physical-count-of-inventories/update-stock') }}/"+stcode,
	      type: "POST",
	      data: {_token: CSRF_TOKEN,physicalcount: xcount,availitem: calc,remarks: xremarks},
	      success: function(response){
	  
	  			console.log(response);
	  			tempAlert('Changes auto saved...',2000);

		},
	      error: function(err){
	      	alert("Error processing request, please try again");
	      	//alert(JSON.stringify(err));
	      }
	    });
	 	//e.preventDefault();

	 	
  }

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

</script>
@endsection