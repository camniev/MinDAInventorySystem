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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>DISPOSALS</Strong></div>

    	<div  style="background-color: #fff; display: inline-block; width: 100%;">

<!--Content-->

@if($lists->count()>0)
@foreach($lists as $l)
@endforeach

<form method="POST" action="{{ url('/disposals/save-disposal-activity-entry') }}" accept-charset="utf-8" enctype="multipart/form-data">
						@csrf
					<table>
						<tr>
							<td colspan="3" class="p-2"><strong>{{$l->cy_date}} Disposal Plan</strong></td>
						</tr>
						<tr>
							<td colspan="3" class="p-2"><strong>{{$l->item}}</strong></td>
						</tr>
						<tr>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 400px;">Activity</td>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;">Start Date</td>
							<td align="center" class="p-2" style="border: solid thin #A9D0F5; background: #3b5998 ; color: #fff; max-width: 190px;">End Date</td>
						</tr>
						<tr>
							<td valign="top" class="p-3" align="center"><textarea style="font-size: 14px;" name="activity" class="form-control p-3" rows="3" cols="10"></textarea></td>
							<td valign="top" class="p-3" align="center"><input type="date" name="activity_date" class="form-control" style="width: 190px;" value="<?php echo date('M-d-Y') ?>"></td>
							<td valign="top" class="p-3" align="center"><input type="date" name="activity_date_end" class="form-control" style="width: 190px;" value="<?php echo date('M-d-Y') ?>"></td>
						</tr>

						<tr>
							<td colspan="3">
								<span>
									<label class="mt-2" style="vertical-align: middle;"><input class="isok ml-2 mt-1" type="checkbox" name="chkcomplete" id="chkcomplete" onclick="chkCheck();"/> Completed</label>
									</span>
								<a onclick="location = '{{ url('/disposals') }}'" class="btn btn-sm btn-primary mt-2 mb-2 mr-2 pl-3 pr-3" style="color: #fff; float: right;"><span class="fa fa-chevron-left" style="vertical-align: middle;"></span> Back</a>

								<button type="submit" name="submit" id="submit" class="btn btn-sm btn-success mt-2 mb-2 mr-2 pl-3 pr-3" style="float: right; color: #fff"><span class="fa fa-save" style="vertical-align: middle;"></span> Save</button>
								</td>
							</tr>

						@if($lists->count()>0)
						@foreach($lists as $i)
						<tr>
							<td class="p-3" style="width: 400px;">{!!wordwrap($i->activity,10,"<br>\n")!!}</td>
							<td class="p-3">{{$i->activity_date}}</td>
							<td class="p-3">{{$i->activity_date_end}}
								
								<a href="{{ url('/disposals/remove-disposal-activity-plan') }}/{{$i->d_id}}/{{$i->id}}" class="btn btn-sm btn-danger" style="float: right;" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o" style="vertical-align: middle;"></span> Delete</a>	
							</td>
						</tr>

						@endforeach
						@endif
						
					</table>

					<input type="hidden" id="d_id" name="d_id" value="">

							<script type="text/javascript">
						        var arr = (window.location.pathname).split("/");
								var val = (arr[arr.length-1]);
								//alert(val);
								document.getElementById("d_id").value = val;
					         </script>
				</form>

@else
<script>
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);

	var arr = (window.location.pathname).split("/");
	var val = (arr[arr.length-2]);

	window.location = "{{ url('/disposals/add-disposal-activity-plan') }}/"+id;

</script>
@endif

<script>

	function chkCheck() {
	  var checkBox = document.getElementById("chkcomplete");
	  if (checkBox.checked == true){
	  	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');

	  	if (document.getElementById('chkcomplete').checked) 
	  	{
  			var iscomplete 			= 1;
        } else {
        	var iscomplete 			= 0;
      	}

		    $.ajax({
		      url: "{{ url('/disposals/save-disposal-activity-compelete') }}/"+val,
		      type: "POST",
		      data: {_token: CSRF_TOKEN,chkcomplete: iscomplete},

		      success: function(response){
		  		console.log(response);
		      	response = JSON.parse(JSON.stringify(response))

		       	tempAlert("Disposal activity is now Completed.",2000);

		      },
		      error: function(){
		      	alert("Error processing request, please try again");
		      }
		    });
		 	e.preventDefault();

	  } else {
	  	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');

	  	if (document.getElementById('chkcomplete').checked) 
	  	{
  			var iscomplete 			= 1;
        } else {
        	var iscomplete 			= 0;
      	}

	  	$.ajax({
		      url: "{{ url('/disposals/save-disposal-activity-compelete') }}/"+val,
		      type: "POST",
		      data: {_token: CSRF_TOKEN,chkcomplete: iscomplete},

		      success: function(response){
		  		console.log(response);
		      	response = JSON.parse(JSON.stringify(response))

		       	tempAlert("Disposal activity is back to Incomplete",2000);

		      },
		      error: function(){
		      	alert("Error processing request, please try again");
		      }
		    });
		 	e.preventDefault();
	    
	  }
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
    	document.body.appendChild(el);

</script>


<!--Content End-->
    </div>

</section>

</div>

</div>
@endsection