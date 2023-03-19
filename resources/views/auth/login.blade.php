@extends('layouts.app')

@section('content')

  <style>
  body {
        font-family: 'Poppins', Arial, sans-serif;
        background-repeat: no-repeat;
        font-size: 12px !important;
        height: 100%;
        background-color: #DFE6F5;
    }

    .strike {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap; 
        margin-top: 24px;
        color: #B5B5B5;
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
        width: 7vw;
        height: 1px;
        background: #B5B5B5;
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
        border-radius: 130px 0px 0px 130px;
        padding: 20px;
    }

    .minda-logo {
        width: 220px;
        height: 230px;
    }

    .right-pane {
        width: 55%;
        padding: 60px;
    }

    .right-pane h1 {
        font-weight: 700;
    }

    .right-pane p {
        margin-top: 32px;
        font-size: 14px;
        font-weight: 500;
        color: #A0A0A0;
    }

    .left-pane h2 {
        font-weight: 700;
        font-size: 32px;
        color: white;
        margin-top: 24px;
        text-align: center;
    }

    .mg0-pd0 {
        margin-top: 100px;
        padding: 0;
    }
    
    .cbody {
        display: flex;
        flex-direction: row;
        background-color: #F5F5F5;
        height: 650px;
        box-shadow: -50px 50px 90px rgb(6 8 30 / 30%);
        border-radius: 130px;
    }

    .card {
        border-radius: 130px;
    }

    .right-pane input[type=text], .right-pane input[type=password] {
        height: 65px;
        padding: 20px;
        margin-top: 24px;
        font-size: 16px;
        border-radius: 10px;
        background-color: #E4E4E4;
        color: #666666;
        border: 0px;
    }

    .right-pane input[type=text] {
        background-image: url("{{ asset('images/user.png') }}");
        background-position: 18px 20px;
        background-repeat: no-repeat;
        padding-left: 50px;
        background-size: 25px;
    }

    .right-pane input[type=password] {
        background-image: url("{{ asset('images/lock.png') }}");
        background-position: 18px 20px;
        background-repeat: no-repeat;
        padding-left: 50px;
        background-size: 25px;
    }

    .form-check {
        padding: 0px;
    }

    .form-check-label {
        font-weight: 600;
        padding-left: 5px;
    }

    .btn-signin {
        margin-top: 24px;
        color: white;
        background-color: #00B297;
        width: 100%;
        height: 50px;
        border-radius: 0px;
        border-radius: 10px;
    }

    button.btn-signin:hover {
        background-color: #f5f5f5;
        color: #00B297;
        transition: 0.2s;
        border: 4px solid #00b297;
    }

    .btn-google {
        margin-top: 16px;
        border: 4px solid #00B297;
        background-color: #F5F5F5;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #06081E;
    }

    .btn-google i {
        margin-right: 10px;
        font-size: 20px;
    }

    a.btn-google:hover {
        background-color: #00B297;
        color: white;
        transition: 0.2s;
    }
  </style>
<div class="container">
    <div class="row justify-content-center d-flex">
        <div class="col-md-10">
            <div class="card mg0-pd0">
                <div class="cbody">
                    <div class="left-pane">
                    <img src="{{ url('/images/minda-logo-inv-sys.png') }}"class="minda-logo"/>
                    <h2>Inventory Management System</h2>
                    </div>
                    <div class="right-pane">
                        <h1>{{ __('Login') }}</h1>
                        <p>Welcome! Please login using your account details.</p>

                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <div>
                                    <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert" style="color: #FF0000;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="flat-red" type="checkbox" name="remember" id="remember">

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <button class="btn btn-signin">{{ __('Login') }}</button>

                            {{--@if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif--}}

                            <div class="strike">
                                <span>or</span>
                            </div>

                            <a class="btn btn-block btn-google">
                                <i class="fa fa-google-plus"></i> Sign in with Google
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
