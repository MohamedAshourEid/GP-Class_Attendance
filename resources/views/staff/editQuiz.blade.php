<html>
<head>

</head>
<body>
<h1>hello</h1>
{{-- {{  $questions2 = Json_decode($questions) }}--}}
{{--{{$questions3 = Json_encode($questions2)}}--}}
{{--{{ gettype($questions2)}}--}}
{{--{{$questions3 = Json_decode($questions2,false)}}--}}

{{ Json_decode($questions)}}
{{--{{$test[0]}}--}}
{{--@foreach($questions as $question)--}}

{{--    <h1>{{$question}}</h1>--}}
{{--    <div>--}}
{{--        <input type="button" value="x"onclick="removeQuestion()" style="width: 26">--}}
{{--        <input type="text" value="{{$question->question.$j}}">--}}
{{--        @for($i=1; $i<$question->optionsCount.$j++;$i++)--}}
{{--            <input type="text" value="{{$question->option.$i}}">--}}

{{--        @endfor--}}
{{--    </div>--}}
{{--@endforeach--}}

</body>
</html>
