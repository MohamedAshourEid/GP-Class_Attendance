<html>
<head>

</head>
<body>
<h1>hello world</h1>
<h1>{{ gettype($quizes) }}</h1>
@foreach($quizes as $quiz)
    <div class="row">
        <div class="col-sm-4">
            <a  type="button" class="btn btn-defult btn-lg" href={{route('showQuize',['quizID' => $quiz->id])}}>
                {{$quiz->topic}}  </a>
        </div>
        <div class="col-sm-4">
            <a href="#"><span class="glyphicon glyphicon-minus-sign"></span> </a>
        </div>
    </div>
@endforeach
</body>
</html>
