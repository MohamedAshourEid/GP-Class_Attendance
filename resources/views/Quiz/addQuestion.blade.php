<?php
session_start();
$quiz_id=0;
if(session()->has('quizID')){
    $quiz_id=session('quizID');
}
?>
<html>
<head>

</head>
    <body>
        <p>Add Question From</p>
        <form method="post" action="{{route('saveQuestion')}}">
            @csrf
            <input type="text" name="Content" placeholder="Type question content please"><br><br>
            <input type="hidden" name="quizID" value='<?php if($quiz_id!=0)
                {echo $quiz_id;}?>'>
            <input type="submit" class="input-submit" value="submit" name="Add Question">
        </form>
    </body>
</html>
