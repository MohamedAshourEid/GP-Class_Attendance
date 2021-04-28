@extends('layouts.header')
@section('content')
    <script>
        function validate(){
            var email = document.getElementById('email').value;
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (re.test(email)){
                return true;
            } else {
                document.getElementById("result").innerHTML = "invalid email";
                return false;
            }
        }
    </script>

    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>

            @endif
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <form action={{route("createAccount")}} method="post" onsubmit="return validate()">
                @csrf
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off">
                    @error('first_name')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="text" class="input-control"  placeholder="Last name" name="last_name" autocomplete="off">
                    @error('last_name')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="text" id="email" class="input-control" required placeholder="Email address" name="email" autocomplete="off" >
                    @error('email')
                    <span class="form-text text-danger">{{$message}}</span>

                    @enderror
                    <span id="result" class="text-danger"></span>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Your ID please" required name="id" pattern="[0-9]{6,}" title="enter valid id" autocomplete="off">
                    @error('id')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="password" class="input-control" required placeholder="Enter password" name="password" autocomplete="off">
                    @error('password')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="hidden" name="role" value="instructor">

                </div>

                <div class="input-box">
                    <input type="submit" class="input-submit">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href={{route('login')}}>Login here</a></div>
            </form>
        </div>
    </div>

@endsection
