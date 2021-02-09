<html>
<head>

</head>
<body>
<div class="visible-print text-center">
    <h1> Laravel QR Code Generator Example </h1>
{{--        <h2>{{$item}}</h2><br>--}}


    {!! QrCode::size(200)->generate($qrContent);!!}

</div>
</body>
</html>
