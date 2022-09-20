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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>REPORT OF SUPPLIES AND MATERIALS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->
<table>
							<tr>
								<td align="center" colspan="8" style="font-family: Cambria; font-size: 18px; border-bottom: solid 1px #fff"><strong>REPORT OF SUPPLIES AND MATERIALS</strong></td>
							</tr>
							<tr>
								<td align="center" colspan="8" style="font-family: Cambria; font-size: 14px; font-style: italic;  border-bottom: solid 1px #fff">Mindanao Development Authority (MinDA)</td>
							</tr>
							<tr>
								<td align="center" colspan="8" style="font-family: Cambria; font-size: 14px; font-style: italic;  border-bottom: solid 1px #fff">Agency</td>
							</tr>
							<tr>
								<td colspan="8" height="25" style="border-bottom: solid 1px #fff"></td>
							</tr>
							<tr>
								<td style="border: solid 1px #fff;"><div class="ml-3">Date:</div></td>
								<td colspan="5" style="border-bottom: solid 1px #e6e7e7; border-right: solid 1px #fff;">{{ $receive_date }}</td>
								<input type="hidden" name="rp_date" id="rp_date" value="{{ $receive_date }}">
								<td align="center" style="border: solid 1px #fff;">NO.</td>
								<td style="border-bottom: solid 1px #e6e7e7; border-right: solid 1px #fff;"><div class="mr-4">{{ $data[0]->ris }}</div></td>
							</tr>
							<tr>
								<td colspan="8" height="25"></td>
							</tr>
							<tr>
								<td colspan="6" style=" border: 1px solid #A9D0F5; padding: 10px;">To be filled up in the Supply and Property Unit</td>
								<td colspan="2" style=" border: 1px solid #A9D0F5; padding: 10px;">To be filled up in the Accounting Unit</td>
							</tr>
							<tr>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>RIS NO</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>RESPONSIBILITY CODE</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>STOCK NO</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>ITEM</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>UNIT</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>QTY ISSUED</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff;background-color: #3b5998"><strong>UNIT COST</strong></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; color: #fff; background-color: #3b5998"><strong>AMOUNT</strong></td>
							</tr>
							@foreach ($data as $i)
							<tr>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$i->ris}}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$i->respocode}}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$i->stock}}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ nl2br($i->description) }}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$i->unit}}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$i->totalquantity}}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ number_format($i->cost, 2, '.', ',') }}</td>
									<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ number_format($i->cost * $i->totalquantity, 2, '.', ',') }}</td>
							</tr>
							@endforeach

							<tr>
								<td style="border: 1px solid #A9D0F5"></td>
								<td colspan="6"  align="center" style="font-size: 12px; font-family: Cambria;font-weight: bold; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Recapulation</td>
								<td style="border: 1px solid #A9D0F5"></td>
							</tr>
							<tr>
								<td style="border: 1px solid #A9D0F5"></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Stock No.</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Quantity</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Description</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Unit Cost</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Total Cost</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; font-style: italic; border: 1px solid #A9D0F5; padding: 10px;">Account Code</td>
								<td style="border: 1px solid #A9D0F5"></td>
							</tr>
							@foreach($data as $d)
							<tr>
								<td style="border: 1px solid #A9D0F5"></td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$d->stock}}</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$d->totalquantity}}</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ nl2br($d->description) }}</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ number_format($d->cost, 2, '.', ',') }}</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{ number_format($d->cost * $d->totalquantity, 2, '.', ',') }}</td>
								<td align="center" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$d->papcode}}</td>
								<td style="border: 1px solid #A9D0F5"></td>
							</tr>
							@endforeach
							<tr>
								<td colspan="8" style="border: 1px solid #A9D0F5" height="25"></td>
							</tr>
							<tr>
								<td colspan="5" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; border-bottom: 1px solid #fff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I hereby certify to the correctness of the abovementioned information</td>
								<td colspan="3" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px; border-bottom: 1px solid #fff">POSTED BY/DATE</td>
							</tr>
							<tr>
								<td colspan="5" height="50" style="border-left: 1px solid #A9D0F5;border-right: 1px solid #A9D0F5; border-bottom: 1px solid #fff"></td>
								<td colspan="3" height="50" style="border-left: 1px solid #A9D0F5;border-right: 1px solid #A9D0F5; border-bottom: 1px solid #fff"></td>
							</tr>
							<tr>
								<td align="center" colspan="5" style="font-size: 12px; font-family: Cambria; font-weight: bold; border: 1px solid #A9D0F5; padding: 10px; border-top: 1px solid #fff">{{$authsig[0]->IARSupplyOfficer}}</td>
								<td align="center" colspan="3" style="font-size: 12px; font-family: Cambria; font-weight: bold; border: 1px solid #A9D0F5; padding: 10px;  border-top: 1px solid #fff">{{strtoupper($authsig[0]->RSMIAccClerk)}}</td>
							</tr>
							<tr>
								<td align="center" colspan="5" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">{{$authsig[0]->IARSupplyOfficerPos}}</td>
								<td align="center" colspan="3" style="font-size: 12px; font-family: Cambria; border: 1px solid #A9D0F5; padding: 10px;">Accounting Clerk</td>
							</tr>
							<tr>
								<td colspan="8" class="mb-5">
									<span class="d-flex float-left mt-2" style="margin-top: 3px;"><button onclick="export_excel();" class="btn btn-sm btn-success ml-2" style="color: #fff;"><span class="fa fa-floppy-o" style="color: #fff;"></span> Export to Excel</button></span>

									<span class="d-flex float-right mb-2 mt-2" style="margin-top: 10px;">
											<a href="{{url('/supplies-and-materials') }}"  class="btn btn-sm btn-primary pl-4 pr-4 mr-2" style="color: #fff"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>
										</span>
								</td>
							</tr>
						</table>

<!--Content End-->
    </div>

</section>

</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>
	function export_excel()
	{

		var x =  $('input#rp_date').val();

        var m = x.split(" ");
        var monthString = m[0];
        var dat = new Date('1 ' + monthString + ' ' + m[1]);

        var mm = dat.getMonth()+1;

        var nd = m[2]+'-'+m[0]+'-'+m[1].replace(",","");
        var smonth = moment().month(m[0]).format("MM");
        var sdate = m[2]+'-'+smonth+'-'+m[1].replace(",","");

        //alert(sdate);
        window.location = "{{ url('/export-excel-rsmi/excel-output/rsmi') }}/"+sdate;

        //"{{ url('/export-excel-rpcppe-details/excel-output') }}/"+id+"/"+person+"/"+dr;
	}
</script>
@endsection