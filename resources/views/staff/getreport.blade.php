
    <!DOCTYPE html>
<html>
<head>
</head>

<body>


        <div>
            <p>
                students attend the lectures frequently
            </p>
            @foreach($regularstudents as $regular)

                <div class="row">
                    {{$regular}}

                </div>
            @endforeach
        </div>
</body>

</html>
