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

<div class="content-wrapper" style="margin-left: 20px;" >
    <section class="content-header">
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">Inspected and Accepted Items/Property</div>

    		@if($lists->count() > 0)
			<div class="sidebar-form" style="width: 200px; margin-left: 5px; float: right;">
				<div class="input-group">
					<input type="text" id="q" name="q" class="form-control" placeholder="IAR Number search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="searchbtn btn btn-flat" >
								<i class="fa fa-search"></i>
							</button>
						</span>
				</div>
            </div>
            

            <span class="d-flex float-left" style="margin-top: 18px;"><button onclick="export_excel();" class="btn btn-sm btn-success mb-2 ml-2" style="color: #fff;  font-size: 12px;"><span class="fa fa-file-excel-o" style="color: #fff;"></span> Export to Excel</button></span>
            @endif
            <input type="hidden" name="type_input" id="type_input" value="{{$viewtype}}">
    	<div  style="background-color: #fff; display: inline-block;">

			@if($lists->count() > 0)
				<table border="1px #fff solid;" style="table-layout: fixed;">
					<tr>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">PO No./Date</td>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">IAR No.</td>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">Supplier</td>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">Requisitioning Office/Dept.</td>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">Respo Center Code</td>
							<td align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">Status</td>
							<td colspan="2" align="center" style="padding: 10px; background-color: #BDBDBD; color: #1C1C1C; font-weight: bold;">Action</td>
									
					</tr>
				@foreach ($lists as $list)
					<tr>
						@if($list->type=='iar')						
							@if($list->iscomplete==0)
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #045FB4;"><strong>{{ $list->po_number }}</strong></td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #045FB4;"><strong>{{ $list->iar_no }}</strong></td>
								<td align= "justify" style="padding-left: 5px; padding-right: 5px; color: #045FB4;"><strong>{{$list->supplier }}</strong></td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #045FB4;"><strong>{{ $list->department }}</strong></td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #045FB4;"><strong>{{ $list->responsibility_code }}</strong></td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">Pending</td>
							@else
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">{{ $list->po_number }}</td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">{{ $list->iar_no }}</td>
								<td align= "justify" style="padding-left: 5px; padding-right: 5px; color: #000000;">{{$list->supplier }}</td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">{{ $list->department }}</td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">{{ $list->responsibility_code }}</td>
								<td align= "center" style="padding-left: 5px; padding-right: 5px; color: #000000;">Complete</td>
							@endif
										
							<td colspan="2" align= "right" style="padding: 10px;">
								<div class="d-flex justify-content-center row" style="text-align: center;">
									<a href="{{ url('/inspection-and-acceptance/add-inspection-details') }}/{{ $list->id }}" style="text-decoration: none; font-size: 11px;" class="btn btn-sm btn-success mt-1 mb-1 ml-3"><span class="fa fa-pencil-square-o" title="Edit"></span><br/>Update</a>
									

									<a href="{{ url('/inspection-and-acceptance/view-inspection-details/') }}/{{ $list->id }}" style="text-decoration: none; font-size: 11px;" class="btn btn-sm btn-info mt-1 mb-1 ml-3"><span class="fa fa-eye" title="Edit"></span><br/> View</a>
									
								<form method="POST" onSubmit="return confirm('Do you want to delete this item/record?')" action="{{ url('/inspection-and-acceptance/delete-inspection-data') }}/{{$list->id}}" enctype="multipart/form-data" class="delete_form" style="display: inline-flex; margin-left: 5px;">
									@csrf
									<button class="btn btn-sm btn-danger ml-2 mr-4 mt-1 mb-1" style="text-decoration: none; font-size: 11px;"><span class="fa fa-trash-o" title="Delete"></span><br/>Delete</button></form>
							</td>
						</div>
					</tr>
				@endif
			@endforeach
			</table>
			@else
				<div align="center" class="container" style="position: relative; width: 100%">
					<span style="color: #DF0101; font-size: 40px;"> No record found on the database   </span>
				</div>

			@endif

			@if($lists->count()>0)
				<div class="justify-content-center mb-3 mr-2" style="margin-top: 30px; padding-bottom: 10px;">{{ $lists->links() }}
					<span class="d-flex float-right" style="margin-top: -18px;">
			               <a href="{{ url('/inspection-and-acceptance/new-inspection') }}" style="font-size: 12px;"><button class="btn btn-sm btn-success"><span class="fa fa-plus-square-o" style="color: #fff; vertical-align: middle;"></span> New Item</button></a>
			       	</span>
				</div>
			@else
				<div class="justify-content-center mb-2" style="margin-top: 30px; padding-bottom: 10px;">
					<span class="d-flex float-right mr-2" style="margin-top: -18px;">
			                	<a href="{{ url('/inspection-and-acceptance/new-inspection') }}" style="font-size: 12px;"><button class="btn btn-sm btn-success"><span class="fa fa-plus-square-o" style="color: #fff; vertical-align: middle;"></span> New Item</button></a>
			        </span>
				</div>
			@endif

    	</div>

    </section>

</div>

</div>

<script>
	$(document).ready(function() {

        $(document).on("click", ".searchbtn", function() {
             //var x = document.getElementById("q").value;

             var x =  $('input#q').val();

            if(x.length > 0){
                window.location = "{{ url('/inspection-and-acceptance/search-iar-number') }}/" + x
                //alert('Search button fired');
            }else{
                warnAlert("Search criteria is empty",2000);
            }
        });       
    });

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

function warnAlert(msg,duration)

    {
     var elx = document.createElement("div");
     elx.setAttribute("style","position:fixed;top:50%;left:45%;margin: 0 auto;background-color:#FF0000; border: solid thin #DF0101; border-radius: 3px; padding-left: 25px; padding-right: 25px; padding-top: 12px; padding-bottom: 12px; color: #ffffff;box-shadow:2px 5px 5px #585858;-moz-box-shadow:2px 5px 5px #585858;-webkit-box-shadow:2px 5px 5px #585858;");
     elx.innerHTML = msg;

     setTimeout(function(){
      elx.parentNode.removeChild(elx);
     },duration);
     document.body.appendChild(elx);
     $(elx).hide().fadeIn('slow');
    }

    //export-excel-iar-list

 function export_excel()
	{

		var t = $('input#type_input').val();
		var url = window.location.pathname;
		var id = url.substring(url.lastIndexOf('/') + 1);

		if(t==0){
			window.location = "{{ url('export-excel-iar-list') }}";
		}else{
			var id = url.substring(url.lastIndexOf('/') + 1);
			window.location = "{{ url('export-excel-iar-number-list') }}/"+id;
		}
	}
</script>
@endsection




    	