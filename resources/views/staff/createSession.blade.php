<?php
session_start();
$instr_id;
$courseID;
if(session()->has('instructorID') and session()->has('courseID'))
    {
        $instr_id=session()->get('instructorID');
        $courseID=session()->get('courseID');
    }
?>
<!DOCTYPE html>
<html>
<head>

    <title>QR Code Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        h1
        {
            font-size: 50px;
            font-family: fantasy;
            color: #3DB2EB;
        }
        button:hover
        {
            background-color: #3DB2EB;
        }
        div.container-fluid
        {
            background-color: #dddd;
        }
        li a
        {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        div#myNavbar
        {
            background-color: #ddd;
        }
        button.btn
        {
            width: 350px;
            height: 50px;
            margin: 20px;
            background-color: #ffffff;
            border:2px solid #3DB2EB;
            color: #3DB2EB;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="navbar-header">

        <a class="navbar-brand" href="#">Class-Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="{{route('flush')}}">Log out</a></li>
        </ul>

    </div>
</div>

<div class="container text-center">
    <div class="row">

        <form action="{{route('create_session')}}" method="post">
            {{@csrf_field()}}

            <input type="hidden" name='courseID' value={{$courseID}}> <br>
            <input type="hidden" name='instructorID' value={{$instr_id}}> <br>
            @if(isset($errors))
                <div class="error">{{$errors}}</div>

            @endif
            <span>Session Name:</span>
            <input class="s_name" type="text" name='session_name' > <br>
            <button type="submit" class="btn btn-defult btn-lg" formtarget="_blank">Create </button>
        </form>

    </div>
</div>

</body>
</html>
