
<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">

        p
        {
            font-family: sans-serif;
            color: #3DB2EB;
            font-size: 50px;
            padding: 80px;
            font-family: fantasy;
        }
        button:hover
        {
            background-color: #3DB2EB;

        }
    </style>
</head>
<body>
<div class="container-fluid text-center">
    <p>Scan this QR Code to attend</p>

    {!! QrCode::size(200)->generate($qrContent);!!}
</div>
<div class="container-fluid text-center">

</div>
<div class="container-fluid text-center">
    <a href="{{route('getEnrolledCourses')}}">
        <button type="button" class="btn btn-defult btn-lg" onclick="document.location='QR Code Page1.html'">Done</button>
    </a>
</div>
</body>
</html>
