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
    <title> Create Session</title>
    <title> Sessions </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
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
        }
        button.btn1
        {
            margin: 70px;
            width: 20%;

            color: black;
            border-radius: 15px;
        }
        button:hover
        {
            background-color: #3DB2EB;

        }
        .error{
            color:red;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="row">
        <p> Session Name: </p>
    </div>

    <div class="row text-center">
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>

        @endif
    <form action="{{route('create_session')}}" method="post">
        {{@csrf_field()}}
        <input type="hidden" name='courseID' value={{$courseID}}> <br>
        <input type="hidden" name='instructorID' value={{$instr_id}}> <br>
        @if(Session::has('error'))
            <div class="error" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
        <div class="row text-center">
        <input type="text" name="SessionName" id="SessionName">
        </div><br>
        <div class="row text-center" >
        <button type="submit" class="btn btn-defult btn-lg" formtarget="_blank">Create </button>
        </div>

    </form>
    </div>
</div>

</body>
</html>
