
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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;">PROPERTY CARD</div>

    	<div  style="background-color: #fff; display: inline-block; width: auto;">

<!--Content-->
<div class="pl-3 ml-3 pr-1 mr-1">
	<div class="row justify-content-center">
		<div>
			<div class="card" style="background: #A9D0F5; margin-left: -5px;">
				<div class="card-header">
					<div class="card-header" style="background: #08298A; color: #ffffff"><Strong>Items/Property Card</Strong></div>
						<div align="justify-content-center">
							<div align="center" class="p-3"><img src="{{url('/images/JxnkUJGd89gKjgGjhvbKjhFTjhLkhnBkjuh_lkhkjn-khnkB__kjGguyu7.png')}}" width="50%" height="50%"></div>
							<span class="card p-4" style="background: #DF0101; font-size: 30px; color: #ffffff">No Item found from the date range selected</span>
						</div>
						<div class="mt-4" style="float: right;"><button onclick="window.history.back();"  class="btn btn-small btn-primary"><span class="fa fa-chevron-left"></span> Back</button></div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--Content End-->
    	</div>

    </section>

</div>

</div>
@endsection