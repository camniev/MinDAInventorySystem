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
    	<div class="content-header" style="color: #084B8A; font-family: 'Calibri'; font-size: 30px;"><Strong>REPORT ON THE PHYSICAL COUNT OF INVENTORIES</Strong></div>

    	<div  style="background-color: #fff; display: inline-block;">

<!--Content-->
<table width="100%">
    <th  style="font-size: 20px; color: #0B3861;" align="center" class="text-center"><div class="p-5">Select Reporting Date for Physical Count of Inventories</div></th>

    <tr>
        <td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2">
            <input list="rep_date_rpci" name="rp_date_rpci" id="rp_date_rpci" class="go form-control" style="width: 200px;"><span style="font-style: italic;">"Note: double-click the box or down arrow to show the date list(s)"</span>
            <datalist id="rep_date_rpci"></datalist>
                        
        </td>
    </tr>
    <tr>
        <td class="p-3" style="border-top: solid thin #fff;"><span style="float: right;" class="mr-3"><a href="javascript:void(0);" class="go_btn_rpci btn btn-small btn-success"><span class="fa fa-search"></span> View</a></span></td>
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

$(document).ready(function(){

        var options = '';
        var p="";
    
        url = "{{url('/report-on-physical-count-of-inventories-get-dates')}}";    

        $.get(url, function (data) {
                console.log(data);
                for (i = 0; i < data.data.length; i++) {
                    
                    if(data.data[i].report_date !== null){

                        var n = data.data[i].date_receive;
                        var m = n.split("-");
                        var y = m[0];
                        
                        var months = [];
                        months.push(moment().month(m[1]-1).format("MMMM"));
                        options += '<option value="'+months+' '+m[2]+', '+y+'" />';

                    }
                }

                document.getElementById('rep_date_rpci').innerHTML = options;
        });    


            setTimeout(function (){
                $('input#rp_date_rpci').focus();
            }, 1000);

});

    var o = false;


$(document).on("click", ".go_btn_rpci", function() {
    var x =  $('input#rp_date_rpci').val();

    if(x)
    {
        var m = x.split(" ");
        var monthString = m[0];
        var dat = new Date('1 ' + monthString + ' ' + m[1]);

        var mm = dat.getMonth()+1;

        var nd = m[2]+'-'+m[0]+'-'+m[1].replace(",","");
        var smonth = moment().month(m[0]).format("MM");
        var sdate = m[2]+'-'+smonth+'-'+m[1].replace(",","");

        //alert(sdate);
        document.location.href="{{ url('/report-on-physical-count-of-inventories') }}/"+sdate;
        //document.location.href=url;
    }else{
        warnAlert('Error: Please select correct date',2000);
    }
});

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