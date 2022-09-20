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

    	<div  style="background-color: #fff; display: inline-block;">

<!--Content-->
<table width="30%">
    <th  style="font-size: 20px; color: #0B3861;" align="center" class="text-center"><div class="p-5">Select Reporting Date for Supplies and Materials Issued</div></th>

    <tr>
        <td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2">
            <input list="rep_date" name="rp_date" id="rp_date" class="go form-control" style="width: 200px;"><span style="font-style: italic;">"Note: double-click the box or down arrow to show the date list(s)"</span>
            <datalist id="rep_date"></datalist>
                        
        </td>
    </tr>
    <tr>
        <td class="p-3" style="border-top: solid thin #fff;"><span style="float: right;" class="mr-3"><a href="javascript:void(0);" class="go_btn btn btn-small btn-success"><span class="fa fa-search"></span> View</a></span></td>
    </tr>

</table>
<!--Content End-->
    </div>

</section>

</div>

</div>

<div class="modal fade" id="report-date" tabindex="-1" role="dialog"aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog  modal-lg" style="min-width: auto; max-width: 50%"  role="document">
    <div class="modal-content">
      <div class="modal-header"><span style="font-size: 24px; color: #FF4000;"><strong>REPORT OF SUPPLIES AND MATERIALS</strong></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="form_result"></span>
            <table width="100%">
                <th colspan="2" style="font-size: 20px; color: #0B3861;" align="center" class="text-center">Select Reporting Date for Supplies and Materials Issued</th>
                <tr>
                    <td align="center" class="p-3" style="font-size: 14px; color: #0B3861;"><strong>Start Date</strong></td>
                </tr>
                <tr>
                    <td align="center" class="p-3" style="border-bottom: none; background: #F2F2F2">
                        <input list="rep_date" name="rp_date" id="rp_date" class="go form-control" style="width: 200px;"><span style="font-style: italic;">"Note: double-click the box or down arrow to show the date list(s)"</span>
                        <datalist id="rep_date"></datalist>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="p-3" style="border-top: solid thin #fff;"><span style="float: right;" class="mr-3"><a href="javascript:void(0);" class="go_btn btn btn-small btn-success"><span class="fa fa-search"></span> View</a></span></td>
                </tr>

            </table>
                
            <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>

$(document).ready(function(){

        var options = '';
        var p="";
    
        url = "{{url('/report-on-supplies-and-materials-issued')}}";    

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

                document.getElementById('rep_date').innerHTML = options;
        });    

        //$('#report-date').modal('show');

            setTimeout(function (){
                $('input#rp_date').focus();
            }, 1000);

});

    var o = false;

$(function(){
    $('.report_btn').click(function(){

        var options = '';
        var p="";
    
        url = "{{url('/report-on-supplies-and-materials-issued')}}";    

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

                document.getElementById('rep_date').innerHTML = options;
        });    

        $('#report-date').modal('show');

            setTimeout(function (){
                $('input#rp_date').focus();
            }, 1000);
    });
});



$(document).on("click", ".go_btn", function() {
    var x =  $('input#rp_date').val();

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

        url="{{ url('/report-on-supplies-and-materials-issued') }}/"+sdate;
        document.location.href=url;
    }else{
        //alert('Please select correct date');
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