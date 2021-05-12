<html>
<body>
<h1>{{$courseID}}</h1>
<fieldset>
    <legend>Legend</legend>
    <form id="sections" action="{{route('savequiz')}}" method="post">
        {{@csrf_field()}}
        <input type="text" placeholder="quiz topic" name="quizTopic">
        <input type="hidden" value="{{$courseID}}" name="courseID">
        <input type="hidden" value="0" id="questionsCount" name="questionsCount">
        <input type="submit" value="save quiz">
    </form>
    <a id="add-new-section" href="#">add question </a><br />
</fieldset>

<script>
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
    document.getElementById('add-new-section').onclick = newQuestion;
    newQuestion();
</script>
<h1 id='test'> hi </h1>
</body>
</html>
