<?php
if(session()->has('courseID')and session()->has('Announcements'))
{
    $courseID=session()->get('courseID');
    $announcements=session()->get('Announcements');
}
?>
    <!DOCTYPE html>
<html>
<head>

    <title>make announcement</title>
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

    </style>
    <script>
        $(function(){
            $(".makeEditable").click(function(){
                $('input:text').removeAttr("readonly");
            });
            $(".makeNonEditable").click(function(){
                $('input:text').attr("readonly", "readonly");
            });
        })

    </script>
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
    {{--<div class="row">
        <h1>{{$courseID}}</h1>
    </div>--}}


    <div class="row">

        <form action="{{route('makepost')}}" method="post">
        @csrf <!-- {{ csrf_field() }} -->

            <input type="hidden" name='courseID' value={{$courseID}}> <br>

            <span>Announcement</span>
            <input class="s_name" type="text" name='announcement' > <br>
            <button type="submit" class="btn btn-defult btn-lg" formtarget="_blank">post </button>
        </form>
        <div>
            @foreach($announcements as $announce)
                <div class="row">
                    {{$announce->body}}
                    <a href={{route('updatepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >
                    <button type="button" >   update</button></a>
                    <a href={{route('deletepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >
                        <button type="button">   delete</button></a>


                </div>
            @endforeach
        </div>
    </div>
</div>

</body>
</html>
