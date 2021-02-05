<html>

<head>

</head>

<body>

<h1> User Account </h1>
{{--    {!! QrCode::size(300)->generate('A basic example of QR code! Nicesnippets.com');!!}--}}
<form action="newLec" method="post">
    {{@csrf_field()}}

    <input type="hidden" name="courseID" value="CS150"> <br>
    <input type="radio" name="type" value="Lec"> lec <br>
    <input type="radio" name="type" value="Lab"> lab <br>
    <input type="submit" value="generate" formtarget="_blank">

</form>


</body>
</html>
