<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
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
        }
        a:link
        {
            text-decoration: none;
        }
        div.row
        {
            margin: 20px;
        }
        button.btn
        {
            width: 250px;
            height: 50px;
            margin: 20px;
            background-color: #ffffff;
            border:2px solid #3DB2EB;
            color: #3DB2EB;
            text-align: center;
        }
        div.div1
        {
            margin-top: 50px;
        }
        span
        {
            margin: 20px;
            font-size: 30px;
            color: red;
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
        <form class="navbar-form navbar-left" action="/action_page.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" >Submit</button>
        </form>
    </div>
</div>
<div class="container text-center">
    <div class="div1">
        @foreach($courses as $course)
            <div class="row">
                <div class="col-sm-4">
                    <a  type="button" class="btn btn-defult btn-lg" href="/courseView/{{$course->course_id}}">
                        {{$course->course_id}}  </a>
                </div>
                <div class="col-sm-4">
                    <a href="#"><span class="glyphicon glyphicon-minus-sign"></span> </a>
                </div>
            </div>
        @endforeach

    </div>
</div>
</body>
</html>
