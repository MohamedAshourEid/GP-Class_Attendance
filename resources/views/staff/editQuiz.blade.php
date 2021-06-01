<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateChoice(choiceID,newValue){
        document.getElementById(choiceID).innerHTML = newValue;
        document.getElementById(choiceID).value = newValue;
    }

    function removeQuestion(node,questionID) {
        $.ajax({
            url: "{{ route('removeQuestion') }}",
            type: 'POST',
            data:{
                id: questionID
            },
            success:function(data){
                // alert(data);
                node.remove();
            },
            error:function(xhr,status,error){
                $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        alert(item)
                    }
                );
                // alert(data.code);
            }
        });
    }

    var saveQuestion = function (form){
        var count=form["choices"].length
        var choices=[]
        for(let i=0;i<count;i++){
            choices[i] =form["choices"][i].value;
        }
        $.ajax({
            url: "{{ route('updateQuestion') }}",
            type: 'POST',
            datatype:"json",
            data:{
                id: form["questionID"].value,
                content:form["content"].value,
                correctAnswer:form["correct_answer"].value,
                choices:choices,
                quizID:{{$quizID}}
            },
            success:function(data){
                alert(data);
                console.log(data);
            },
            // error:function(xhr,status,error){
            //     $.each(xhr.responseJSON.errors,function (key,item)
            //         {
            //             alert(item)
            //         }
            //     );
            // }
        });
    }

    var newOption2 = function(questionID,where, correctAnswerList,optionCountID) {

        console.log(optionCountID.value);

        var questionOption = document.createElement('input');
        questionOption.type = 'text';
        // generate name & id

        var optionCountValue = parseInt(optionCountID.value);
        optionCountValue +=1;
        console.log(optionCountValue);

        var newOptionID = questionID + 'option' + optionCountValue;
        console.log('optionCountValue ' + optionCountValue)
        optionCountID.value = optionCountValue ;
        questionOption.name = newOptionID;
        questionOption.placeholder = 'option content';
        questionOption.id = newOptionID;
        questionOption.size = '40';
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;

        }

        where.appendChild(questionOption);

        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        correctAnswerList.appendChild(option);

        var br2 = document.createElement('br');
        where.appendChild(br2);

    };

    var newQuestion = function() {
        questionsCount = document.getElementById('questionsCount')
        var section = document.createElement('div');
        // 1- add close button
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);
        };
        section.appendChild(close);
        // create question id and increment value of questions count
        var questionID = parseInt(questionsCount.value);
        questionID +=1;
        questionsCount.value = questionID;
        var optionCount = document.createElement('input');
        optionCount.type = 'hidden';
        optionCount.id = 'optionCount' + questionID;
        optionCount.name = 'optionCount' + questionID;
        optionCount.value = 0;
        var question = document.createElement('input');
        question.type = 'text';
        // generate name & id
        question.name = 'question'+questionID;
        question.id = 'question'+questionID;
        question.placeholder = 'question body';
        section.appendChild(question);
        var br = document.createElement('br');
        section.appendChild(br);
        var options = document.createElement('div');
        section.appendChild(options);
        options.appendChild(optionCount);
        var correctAnswer = document.createElement('select');
        correctAnswer.name = 'correctAnswer'+questionID;
        options.appendChild(correctAnswer);
        var addNewOption = document.createElement('a');
        addNewOption.innerHTML = 'add new option';
        addNewOption.href = '#';
        addNewOption.id = 'add-new-option';
        addNewOption.onclick = function(){
            newOption2(question.id,options,correctAnswer,optionCount)
            console.log(question.id);
        }
        options.appendChild(addNewOption);
        var br4 = document.createElement('br');
        section.appendChild(br4);
        document.getElementById('newQuestions').appendChild(section);
        newOption2(question.id,options,correctAnswer,optionCount);
        newOption2(question.id,options,correctAnswer,optionCount)
    };

    var displayOption = function (question){
        var optionDiv = document.createElement('div');

        var questionID = question['questionID'].value;
        var questionOption = document.createElement('input');
        questionOption.type = 'text';

        var newOptionID =   parseInt(question['optionCount'].value);
        document.getElementById(questionID+'options').value = ++newOptionID;
        questionOption.name = 'choices';
        questionOption.placeholder = 'option content';
        questionOption.id = newOptionID;
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;

        }

        var location = document.getElementById(question['questionID'].value)
        // alert("location " + location)


        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        question['correct_answer'].appendChild(option);
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);

            document.getElementById(option.id).remove();

        };
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        location.appendChild(optionDiv);
        var br2 = document.createElement('br');
        location.appendChild(br2);
    }

    var newOption = function(question) {
        $.ajax({
            url: "{{ route('addOption') }}",
            type: 'POST',
            datatype:"json",
            data:{
                id: question["questionID"].value,
                quizID:{{$quizID}}
            },
            success:function(optionID){
                displayOption(question,optionID);
                // alert(data);
                // console.log(data);
            },
            // error:function(xhr,status,error){
            //     $.each(xhr.responseJSON.errors,function (key,item)
            //         {
            //             alert(item)
            //         }
            //     );
            // }
        });


    };

    var removeChoice = function (node,choiceID){
        $.ajax({
            url: "{{ route('removeChoice') }}",
            type: 'POST',
            data:{
                id: choiceID
            },
            success:function(data){

                node.remove();
            },
            error:function(xhr,status,error){
                $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        alert(item)
                    }
                );
                // alert(data.code);
            }
        });
    }
</script>
<h1>hello</h1>
@foreach($questions as $question)
    <form id="sections" onchange="saveQuestion(this)">

        <div id="{{$question['questionid']}}" name="options">
            <input type="button" value="x" style="width: 26" onclick="removeQuestion(this.parentElement,'{{$question['questionid']}}')">
            <input type="hidden" value="{{$question['questionid']}}"  name="questionID">
            <input type="hidden" value="{{$question['optionsCount']}}" id="{{$question['questionid']}}options" name="optionCount">
            <input type="text" value="{{$question['question']}}" name="content">
            <br>
            <select name="correct_answer">
                <option value="{{$question['correctAnswer']}}" > {{$question['correctAnswer']}} </option>
                @for($j=1; $j<=$question['optionsCount']; $j++)
                    @if($question['option'.$j] != $question['correctAnswer'])
                        <option value="{{$question['option'.$j]}}" id="{{$question['optionid'.$j]}}"> {{$question['option'.$j]}} </option>
                    @endif                @endfor

            </select>
            <br>
            @for($j=1; $j<=$question['optionsCount']; $j++)
                <div>
                    <input type="button" value="x" style="width: 22" onclick="removeChoice(this.parentElement,'{{$question['optionid'.$j]}}')">
                    <input type="text" value="{{$question['option'.$j]}}" name="choices" id="{{$question['optionid'.$j]}}" onchange="updateChoice({{$question['optionid'.$j]}},this.value)">
                </div>
            @endfor
        </div>
{{--        <a href="#" onclick="test(this.parentElement)"> test</a>--}}
        <a href="#" onclick="newOption(this.parentElement)">add option</a>
    </form>

@endforeach
<form  action="{{route('saveNewQuestions')}}" method="post">
    {{@csrf_field()}}
    <div id="newQuestions">
        <input type="hidden" value="{{$quizID}}" name="quizID">
        <input type="hidden" value="0" id="questionsCount" name="questionsCount">
    </div>
    <input type="submit" value="finish">

</form>
<a id="add-new-section" href="#" onclick="newQuestion()">add question </a><br />

</body>
</html>
