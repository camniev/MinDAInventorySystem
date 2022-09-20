<header class="main-header navbar navbar-expand navbar-white navbar-light">    
    <div class="logo">
      <span class="logo-lg"><b>Inventory System</span>
    </div>
  <nav class="navbar navbar-static-top">
    <ul class="navbar-nav">
      <li class="nav-item d-sm-inline-block">
        <a class="nav-link" data-widget="pushmenu" data-toggle="push-menu" href="#" role="button" style="float: left; list-style-type:none;"><i class="fa fa-bars" aria-hidden="true" style="font-size: 16px; color: #E6E6E6;"></i></a>
      </li>
    </ul>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a class="reorder" href="javascript:void();">
              <i id="noti" class="fa fa-bell" style="display: none; color: #fff; font-size: 12px; animation: opacity 1s ease-in;"></i>
              <span id="span_data" class="rounded-circle" style="display: none; background: #ff0000; color: #fff; animation: opacity 1s ease-in; float: right; padding-left: 5px; padding-right: 5px;"></span>
            </a>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ url('dist/img/minda_logo160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
              <!--<span class="hidden-xs" id="rop">sffsfsdfsdf</span>-->
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ url('dist/img/minda_logo160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->email }}
                </p>
              </li>

              <li class="user-footer">

                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-flat">Sign out</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i></a>
          </li>
        </ul>
      </div>

    </nav>

<script type="text/javascript">

$(document).ready(function() {
    url = "{{url('/re-order-lists-count')}}";
      $.get(url, function (response) {
            console.log(response);  
            
            var r = response[0]; 

            if(r>0){
              document.getElementById("noti").innerHTML = r;

              $(document).on("click", ".reorder" , function(e) {
                document.location.href="{{ url('/re-order-lists') }}";
              });
            }
      });
});

$(document).ready(function() {
        
        var data = [];
        //alert("Settings page was loaded");
        var audio = new Audio("{{ url('/notification/ding.mp3')}}");
        var isbelow = false;
        var r = 0;

        @foreach($reorderdata as $d )
            data.push({ ro: '{{ $d->reorderpoint }}', av: '{{ $d->available }}' });
        @endforeach

        for (i = 0; i < data.length; i++) {

                var a = JSON.stringify(parseInt(data[i]['ro']));
                var b = JSON.stringify(parseInt(data[i]['av']));

                if(parseInt(b)<=parseInt(a)){
                    isbelow=true;
                    r++;
                }
                

        }

        if(r>0){
              document.getElementById('span_data').innerHTML=r;

                  $(function(){
                    $('#span_data').delay(1000).fadeIn(100);
                    $('#noti').delay(1000).fadeIn(100);
                  });

                  //warnAlert('There are '+r+' items that need to re-order', 2000);

              $(document).on("click", ".reorder" , function(e) {
                document.location.href="{{ url('/re-order-lists') }}";
              });
            }



        if(isbelow)
        {
            var playPromise = audio.play();
            $('#alert-modal').modal('show');
            audio.play();
        }


    url = "{{url('/re-order-lists-count')}}";
      $.get(url, function (response) {
            console.log(response);  

            var r = JSON.stringify(response);
            $("#rop").html(data);
                
          });

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
</header>