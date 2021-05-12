<?php
if(session()->has('instructorID'))
    {
        $instructorID=session()->get('instructorID');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title> Join Course</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        div.container-fluid
        {
            background-color: #dddd;
        }
        div.row
        {
            margin: 20px;

        }
        .btn-lg
        {
            width: 250px;
            height: 50px;
            margin: 20px;
            background-color: #ffffff;
            color: #3DB2EB;
            text-align: center;
            margin-left:70%;
            font-size: 30px;
        }
        div.div1
        {
            margin-top: 100px;
        }
        span.gl
        {
            margin: 20px;
            font-size: 30px;
            color: red;


        }
        span.gl1
        {
            color: #3DB2EB;
            font-size: 50px;
            margin-left: 90%;
            margin-top: 10%;
        }
        span.i1
        {
            color: black;
        }
        body
        {
            padding: 50px;
        }
        p
        {
            color: black;
            font-size: 30px;
            margin-left: 15%;
        }
        input
        {
            padding: 10px;
            width: 30%;
            border-color: black;
            border-radius: 15px;
            text-align: center;
            font-size: 20px;
            margin-left:  35%;
        }
        input.btn1
        {
            margin-left:  40%;
            width: 20%;

            color: black;
            border-radius: 15px;
        }
        input.btn1:hover
        {
            background-color: #3DB2EB;

        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary navbar-fixed-top" id="mainNav">
    <div class="container-fluid">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle bg-primary" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar i1"></span>
                <span class="icon-bar i1"></span>
                <span class="icon-bar i1"></span>
            </button>
            <a class="navbar-brand" href="#page-top">Class-Management</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="{{route('flush')}}">Log out</a></li>
            </ul>

        </div>

    </div>
</nav>
<div class="container">
    <div class="row ">
        <form action="{{route('joinCourse')}}" method="post">
            {{@csrf_field()}}
            @if(isset($success))
                <div class="alert alert-success row text-center" role="alert" >
                    {{$success}}
                </div>
            @endif
            <p> Course Code </p>
            <input type="text" name="courseID" id="CourseCode">
            <br><br><br>
            <input type="hidden" name="ID" value="{{$instructorID}}">
            <input type="hidden" name="role" value="instructor">
            <input  class="btn1" type="submit" value="Join">
        </form>


    </div>

</div>

</body>
</html>
