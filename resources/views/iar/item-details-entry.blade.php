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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Inspected and Accepted Items/Property New Entry</div>

    	<div  style="background-color: #fff; display: inline-block; width: auto;">

<!--Content-->
<form id="form" method="POST" action="{{ url('/inspection-and-acceptance/save-inspection-details') }}/{{$items['id']}}"  accept-charset="utf-8" enctype="multipart/form-data">
	@csrf
								
	<table border="1px #fff solid;" style="table-layout: fixed;">
		<tr>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px; border: 1px solid #A9D0F5;"><Strong>Entity Name:</Strong></td>
			<td colspan="8" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['entity_name'] }}</td>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><Strong>Fund Cluster:</Strong></td>
			<td colspan="2" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['cluster'] }}</td>
		</tr>
		<tr>
			<td align="center" style="padding-right: 10px; padding-left: 10px;color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Supplier:</strong></td>
			<td colspan="8" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['supplier'] }}</td>
			<input name="supplier" id="supplier"  type="hidden" value="{{ $items['supplier'] }}">
			<input name="papcode" id="papcode"  type="hidden" value="{{ $items['papcode'] }}">
			<input type="hidden" id="invoice_number" name="invoice_number" value="{{ $items['invoice_no'] }}">
			<input type="hidden" id="invoice_date" name="invoice_date" value="{{ $items['invoice_date'] }}">
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>IAR No.:</strong></td>
			<td colspan="2" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['iar_no'] }}</td>
		</tr>
		<tr>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>PO No./Date:</strong></td>
			<td colspan="8" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['po_number'] }}</td>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Date:</strong></td>
			<td colspan="2" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['iar_date'] }}</td>
		</tr>
		<tr>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Requisitioning Office/Dept.:</strong></td>
			<td colspan="8" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['department'] }}</td>
			<input name="department" id="department" type="hidden" value="{{ $items['department'] }}">
			<input name="respo_center_code" id="respo_center_code" type="hidden" value="{{ $items['responsibility_code'] }}">
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Invoice No.:</strong></td>
			<td colspan="2" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['invoice_no'] }}</td>
		</tr>
		<tr>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Respo Center Code:</strong></strong></td>
			<td colspan="8" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['responsibility_code'] }}</td>
			<td align="center" style="padding-right: 10px; padding-left: 10px; color: #1C1C1C; width: 100px; padding-top: 10px; padding-bottom: 10px;border: 1px solid #A9D0F5;"><strong>Date:</strong></td>
			<td colspan="2" class="pl-3" style="border: 1px solid #A9D0F5;">{{ $items['invoice_date'] }}</td>
		</tr>
		<tr>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Stock/<br>Property No.</strong></td>
			<td colspan="4" align="center" style="width: 450px; border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Description</strong></td>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Unit</strong></td>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Cost</strong></td>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Quantity</strong></td>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Category</strong></td>
			<td align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Consume Days</strong></td>
			<td colspan="2" align="center" style="border: 1px solid #A9D0F5; background: #3b5998 ; color: #fff"><strong>Expense Category</strong></td>
		</tr>
		<tr>
			<td align="center" valign="top" class=" p-1"><input style="text-align: center;" list="data_proplist" name="propno" id="propno" class="form-control" onblur="getdesctiption(document.getElementById('propno'), document.getElementById('data_proplist'));" width="1px" maxlength="255"required>
				<datalist id="data_proplist">
			        @if($library->count()>0)
			        @foreach($library as $l)
						<option value="{{ $l->stock_code }}">
					@endforeach
					@endif
				</datalist>
					<input type="hidden" id="optselect" name="optselect">
			</td>
			<td  class=" p-1" colspan="4" align="center"  valign="top"><textarea style="font-size: 12px;" name="description" id="description" class="form-control" width="1px" required cols="1" rows="2"></textarea></td>
			<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" name="unit" id="unit" class="form-control" width="1px" maxlength="255"required></td>
			<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" name="cost" id="cost" class="form-control" width="1px" maxlength="255"required></td>
			<td  class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" name="quantity" id="quantity" class="form-control" width="1px" maxlength="255"required></td>
			<td  class=" p-1" align="center"  valign="top">
			<select id="category" name="category" class="form-control" >
				<option value="StockCard" selected>ICS</option>
					<option value="PropertyCard">PAR</option>
			</select>
			</td>
			<td valign="top"><input class="form-control m-1" style="text-align: center; width: 80px;" type="number" id="consume" name="consume" value="0"></td>
			<td colspan="2" class=" p-1" align="center"  valign="top"><input style="text-align: center;" type="text" class="form-control" name="ex_cat" id="ex_cat" readonly></td>
		</tr>
		<tr>
			<td colspan="6">
				<div class="form-group row mt-2" style="float: left;">
					<label for="image" class="col-md-4 col-form-label text-md-right">Upload Image</label>
					    <div class="col-md-6">
					        <input type="file" name="img_file" id="img_file" class="form-control" style="padding-bottom: 35px; width: 170%;" accept="image/x-png,image/gif,image/jpeg,image/bmp,image/jpg,application/pdf" onchange="PreviewImage();">
					    </div>
					                			
				</div>
			</td>
			<td colspan="6">
				<div class="photo-container" style="float: right"><img id="image" class="photo-info ml-5 mt-1" src="" style="height: 105px; border: 1px solid #08298A; margin: 5px;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;"/></div><br>
					     <div id="err"></div>
				</td>
			</tr>
			{{--
			<tr>
				<td colspan="6">
					<div>
						<label for="ispartial" class="p-2">Partial</label>
					    <input class="ischeck" type="checkbox" name="ispartial" id="ispartial">
					    <span class="ml-3">|</span>
					    <label for="complete" class="p-2">Complete</label>
					    <input class="ischeck" type="checkbox" name="complete" id="complete">
					</div>
				</td>
			</tr>
			--}}
		</table>

			<div class="d-flex float-right">
				<div class="justify-content-center p-3">

				    <button type="submit" class="btn btn-sm btn-primary" style="color: #fff;  font-size: 10px;"><span class="fa fa-plus-square-o" style="vertical-align: top;"></span> Add Stock/Item</button>
				        <a onclick="location = '{{ url('/inspection-and-acceptance') }}';"><button class="btn btn-sm btn-success  pl-4 pr-4" style="margin-left: 20px; color: #fff; font-size: 10px;"><span class="fa fa-check-square-o"></span> Done</button></a>
				</div>
	</form>



<!--Content End-->
    	</div>

    </section>

</div>

</div>


<!--Modal Working-->

<div class="modal fade" id="working-modal" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog  modal-lg" style="width: 200px; height: 600px;" role="document">
    <div class="modal-content">
    	<div align="center"><img src="{{ url('/images/dsgdfgs456tvw45466w45656esry5y4.gif') }}"></div>
    	<hr id="cpb" style="display: block; margin-before: 0.5em; margin-after: 0.5em; margin-start: auto; margin-end: auto; overflow: hidden; border-width: 2px; float: left; background: #FF0000">
    </div>
  </div>
</div>

<script>

	$(document).ready(function (e) {
 		$("#form").on('submit',(function(e) {
  			e.preventDefault();

  			var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
		  	var arr = (window.location.pathname).split("/");
			var val = (arr[arr.length-1]);

			//alert(val);

  		$.ajax({
        	url: "{{ url('/inspection-and-acceptance/save-inspection-details') }}/"+val,
   			type: "POST",
   			data:  new FormData(this),
   			contentType: false,
         	cache: false,
   			processData:false,
   			beforeSend: function() {
	            $('#working-modal').modal('show');
	            var i = 1;

				var interval = setInterval( increment, 20);

				function increment(){
				    i = i % 100 + 1;
				    //console.log(i+'%');
				    document.getElementById("cpb").style.width = i+'%';
				}
	        },
   			success: function(data)
   			{
    			if(data=='invalid')
   			{
     			$("#err").html("Invalid File !").fadeIn();
   			}
    		else
    		{
     			// view uploaded file.

     			$(".photo-container").html(data).fadeIn();
     			//$("#form")[0].reset(); 
     			window.location.href="{{ url('/inspection-and-acceptance/add-inspection-details') }}/"+val;
    		}
      	},
      	complete: function(e)
	      	{
	      		$('#working-modal').modal('hide');
	      		window.location.href="{{ url('/inspection-and-acceptance/add-inspection-details') }}/"+val;
	      	},
     	error: function(e) 
      	{
    		$("#err").html(e).fadeIn();
      	}          
    	});
 	}));
});

	
</script>

<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_file").files[0]);

        oFReader.onload = function (oFREvent) {
            //document.getElementById("image").src = oFREvent.target.result;

        $(".photo-container").animate({
            opacity: 0.10,
        }, 200, function () {
            $(".photo-info").attr("src", oFREvent.target.result);
        }).animate({ opacity: 1 }, 800);
        };
    };

</script>

<script>

function getdesctiption(el, dl){
		if(el.value.trim() != ''){
		    var opSelected = dl.querySelector(`[value="${el.value}"]`);
		    var option = document.createElement("option");
		    option.value = opSelected.value;
		    option.text = opSelected.getAttribute('value');

		    var x = opSelected.getAttribute('value');

		    url="{{ url('/stock-code/') }}/"+x;

		    //alert(x);
		    
		    document.getElementById('optselect').value=x;

		    $.ajax({
			    url: "{{ url('/stock-code/') }}/"+x,
			    context: document.body,
			    success: function(data){
			      //console.log(data);
			      $('input#unit').val(data.data[0].unit);
			      $('textarea#description').val(data.data[0].description);
			      if(x.indexOf("165") >-1){
			      	//$('span#ex_cat').html("<b>SEMI EXPENDABLE</b>");
			      	$('input#ex_cat').val('SEMI EXPENDABLE');
			  	  }else{
			  	  	//$('span#ex_cat').html("<b>OTHER SUPPLIES</b>");
			  	  	$('input#ex_cat').val('OTHER SUPPLIES');
			  	  }
			    }
			});

  		}
}

$(document).ready(function(){
	$(".check").hide();
    $('.ischeck').click(function() {
        $('.ischeck').not(this).prop('checked', false);
	    if( $('.pcheck').is(':checked')) {
			$(".check").show({duration: 500});
			
	    } else {
	        $(".check").hide({duration: 500});
	    }
    });
});

</script>
@endsection