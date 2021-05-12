<!DOCTYPE html>
<html>
<head>
    <title> Sessions </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        a
        {
            display: block;
            color: #3DB2EB;
            font-size: 30px;
            padding: 20px;
            text-decoration: none;
        }
        a:hover
        {
            text-decoration: none;
        }
        table, th, td
        {
            border: 1px solid black;
        }
        th
        {
            font-size: 25px;
            text-align: center;
        }
        td
        {
            font-size: 20px;
        }
        button
        {
            background-color: #3DB2EB;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row text-center">
        <a href={{route('newSession')}}> Create New Session </a>

    </div>
    <div class="row text-center">
        <table style="width:80%">
            <tr >
                <th>Session ID</th>
                <th>Session Name</th>
                <th>Session Date</th>
                <th>Session Attendance</th>
            </tr>
            <?php
            $i=1;
            ?>
            @foreach($sessions as $session)
                <tr>
                    <td><?php echo $i++;?></td>
                    <td>{{$session->session_name}}</td>
                    <td>{{$session->date}}</td>
                    <td class="text-center "><form action="{{route('getAttendance')}}">
                            {{@csrf_field()}}
                            <input type="hidden" name="sessionID" value="{{$session->session_id}}">
                            <input type="hidden" name="courseID" value="{{$session->course_id}}">
                            <button class="btn" type="submit"> Attendance </button>
                        </form></td>
                </tr>
            @endforeach
        </table>

    </div>

</div>

</body>
</html>
