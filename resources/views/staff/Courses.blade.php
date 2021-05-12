<?php
session_start();
if(session()->has('instructorID'))
    {
        $instructorID=session()->get('instructorID');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
            margin-left:50%;
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
        button{
            border:0px;
            margin-right: 40%;
            margin-top: 13px;
            background-color: white;
        }
        a.btn1
        {
            margin-left: 90%;
            font-size: 22px;
        }
    </style>
</head>
<body id="page-top">
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
    <div class="div1  text-center">
        <a href="{{route('join_course')}}" class="btn1"> <button > Join Course </button> </a>
        @if(isset($success))
            <div class="alert alert-success row text-center" role="alert" >
                {{$success}}
            </div>
        @endif
        @if(!is_null($courses))
                @foreach($courses as $course)
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <a class="btn btn-defult btn-lg" href="/courseView/{{$course->course_id}}">
                                {{$course->name}}  </a>
                        </div>
                        <div col sm-6>
                            <form action="{{route('delete_instructor_course')}}" method="post">
                                {{@csrf_field()}}
                                <input type="hidden" name="courseID" value="{{$course->course_id}}">
                                <input type="hidden" name="instructorID" value="{{$instructorID}}">
                                <button type="submit"><span class="gl glyphicon glyphicon-minus-sign"></span></button>
                            </form>
                        </div>

                    </div>
                @endforeach
                <div class="row">
                    <a href="{{route('create_course')}}"> <span class="gl1 glyphicon glyphicon-plus-sign"></span> </a>

                </div>
        @endif
    </div>
    @if(is_null($courses))
        <div class="div2" >
            <div class="alert alert-success row text-center" role="alert" >
                You have not any courses
            </div>

            <div class="row">
                <a href="{{route('create_course')}}"> <span class="gl1 glyphicon glyphicon-plus-sign"></span> </a>

            </div>
        </div>
    @endif
</div>

</body>

</html>