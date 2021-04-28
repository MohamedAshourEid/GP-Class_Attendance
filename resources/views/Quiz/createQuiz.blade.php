<html>
<head>

</head>
    <body>
    <p>Create quiz From</p>
            <form method="post" action="{{route('saveQuiz')}}">
                @csrf
                <input type="text" name="topic" placeholder="Type the topic please"><br><br>
                <input type="text" name="courseID" placeholder="Course id please"><br><br>
                <input type="submit" class="input-submit" value="submit" name="submit">
            </form>
    </body>
</html>
