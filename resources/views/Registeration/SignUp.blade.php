@extends('layouts.header')
@section('content')


<div class="container">
    <div class="content">
<h2 class="heading">Sign Up</h2>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
<form action={{route("createAccount")}} method="post">
    @csrf
    <div class="input-box">
        <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off">
        @error('first_name')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="input-box">
        <input type="text" class="input-control" placeholder="Last name" name="last_name" autocomplete="off">
        @error('last_name')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="input-box">
        <input type="text" class="input-control" required placeholder="Email address" name="email" autocomplete="off" >
        @error('email')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="input-box">
        <input type="text" class="input-control" placeholder="Your ID please" name="id" autocomplete="off">
        @error('id')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="input-box">
        <input type="password" class="input-control" placeholder="Enter password" name="password" autocomplete="off">
        @error('password')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="input-box">
        <input type="radio" name="role" value="instructor">
        <label class="form-check-label" for="flexRadioDefault1">
            instructor
        </label>
        <input type="radio" name="role" value="student">
        <label class="form-check-label">
            student
        </label>

    </div>

    <div class="input-box">
        <input type="submit" class="input-submit">
    </div>
    <div class="sign-up-cta"><span>Already have an account?</span> <a href={{route('login')}}>Login here</a></div>
</form>
        </div>
</div>
@endsection
