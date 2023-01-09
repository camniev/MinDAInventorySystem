@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
  body {
        font-family: 'Poppins', Arial, sans-serif;
        background-repeat: no-repeat;
        font-size: 12px !important;
        height: 100%;
    }

    .strike {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap; 
    }

    .strike > span {
        position: relative;
        display: inline-block;
    }

    .strike > span:before,
    .strike > span:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 8vw;
        height: 1px;
        background: black;
    }

    .strike > span:before {
        right: 100%;
        margin-right: 10px;
    }

    .strike > span:after {
        left: 100%;
        margin-left: 10px;
    }

    .left-pane {
        width: 40%;
        background-image: url("{{ asset('images/bg-inv-sys.png') }}");
        background-size: cover;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .minda-logo {
        width: 150px;
        height: 160px;
    }

    .right-pane {
        width: 60%;
        padding: 30px;
    }

    .right-pane h1 {
        font-weight: 700;
    }

    .left-pane h2 {
        font-weight: 700;
        color: white;
    }

    .mg0-pd0 {
        margin: 0;
        padding: 0;
    }
    
    .cbody {
        display: flex;
        flex-direction: row;
    }

    .card-body {}
  </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" style="display: none;">
                <div class="card-header" style="font-size: 16px; font-weight: bold;">{{ __('Login') }}</div>
                <div align="center"><img src="{{ url('/images/54yrfdbiojsdf908s7ft8sdgiuaw34.jpg') }}" height="70%" width="70%" class="rounded-circle mt-2"></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert" style="color: #FF0000;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 ">
                            <div class="col-md-8 offset-md-4 d-flex">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif--}}

                                    <div class="form-check ml-4 mt-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label pl-4" for="remember" style="font-weight: normal;">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mg0-pd0">
                <div class="cbody">
                    <div class="left-pane">
                    <img src="{{ url('/images/minda-logo-inv-sys.png') }}"class="minda-logo"/>
                    <h2>Inventory System</h2>
                    </div>
                    <div class="right-pane">
                        <h1>Login</h1>
                        <p>Welcome! Please login using your account details</p>
                        <div class="form-group">
                            <div>
                                <input id="username" type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">

                            <label class="form-check-label" for="remember" style="font-weight: normal;">
                                Remember Me
                            </label>
                        </div>

                        <div class="strike">
                           <span>or</span>
                        </div>

                        <button>Continue with Google</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
