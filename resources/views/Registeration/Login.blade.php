@extends('layouts.header')
@section('content')
    <div class="container">
        <div class="content">
            <h2 class="heading">Login</h2>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>

            @endif

        <!--<div class='notification'>Logged In Successfull</div>-->
            @if(Session::has('error'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
            <form action="{{route('validate')}}" method="post">
                @csrf
                <div class="input-box">
                    <input type="text" class="input-control" required placeholder="ID please" name="id" >
                    @error('id')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="password" class="input-control" required placeholder="Password please" name="password">
                    @error('password')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>
                <br>
                <div class="input-box rm-box">
                    <div>
                        <input type="checkbox" id="remember-me" class="remember-me" name="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
                </div><br>
                <div class="input-box">
                    <input type="hidden" name="role" value="instructor">

                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="LOGIN" name="login">
                </div>
                <div class="login-cta"><span>Don't have an account?</span> <a href={{route('signup')}}>Sign up here</a></div>
            </form>

        </div>
    </div>
@endsection
