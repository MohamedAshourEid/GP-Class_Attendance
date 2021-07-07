<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<script>
    function removeQuestion(node,questionID) {
        node.remove();
        let _url     = `removeQuestion`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: _url,
            type: "get",
            data: {
                questionID: questionID,
            },
            success: function(response) {
                if(response.code == 200) {
                    alert('success');
                }
                else
                    alert(response.code);
            },
            error: function(response) {
                alert('error');
                alert((response.responseJSON.errors.title));
                alert((response.responseJSON.errors.description));
            }
        });
    }
    var saveQuestion = function (node){
        console.log(node);
    }
    /*
    to create new question you need to
    1- create div to contain the question section
    2- add to this div the following elements
           I- input element contain the question body
           II-
    */
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
            newOption(question.id,options,correctAnswer,optionCount)
            console.log(question.id);
        }
        options.appendChild(addNewOption);
        var br4 = document.createElement('br');
        section.appendChild(br4);
        document.getElementById('sections').appendChild(section);
        newOption(question.id,options,correctAnswer,optionCount);
        newOption(question.id,options,correctAnswer,optionCount)
    };
    var newOption = function(questionID,where, correctAnswerList,optionCountID) {
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
    // document.getElementById('add-new-section').onclick = newQuestion;
    // newQuestion();
</script>
<h1>hello</h1>

<form id="sections">
    @foreach($questions as $question)
        <div>
            <input type="hidden" value="2" id="questionsCount" name="questionsCount">
            <input type="button" value="x" style="width: 26" onclick="removeQuestion(this.parentElement,'q8question1')">
            <input type="text" value="{{$question['question']}}">
            <select>
                {{--<option value="{{$question['correctAnswer']}}"> {{$question['correctAnswer']}} </option>--}}
                @for($j=0; $j<count($question['options']); $j++)

                    <option value="{{$question['options'][$j]}}"> {{$question['options'][$j]}} </option>
                @endfor
            </select>
            @for($j=0; $j<count($question['options']); $j++)

                <input type="text" value="{{$question['options'][$j]}}">
            @endfor
            <input type="button" value="save" onclick="saveQuestion(this.parentElement)">
        </div>
    @endforeach
</form>
<a id="add-new-section" href="#" onclick="newQuestion()">add question </a><br />

</body>
</html>
