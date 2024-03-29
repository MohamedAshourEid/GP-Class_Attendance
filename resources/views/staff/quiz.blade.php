
<html>
<head>
    <title> Create Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style type="text/css">
        body
        {
            padding-top: 40px;
            background-color: white;
        }
        input.save
        {

            margin-left:  470px;
            width: 20%;
            border-radius: 15px;
            margin-top: 10px;
        }
        input
        {
            font-size: 20px;
            height: 50px;
            width: 95%;
            text-align: center;
            color: black;
            margin-top: 20px;

        }
        a:hover
        {
            text-decoration: none;

        }
        a#add-new-section
        {
            font-size: 30px;
            color: #3DB2EB;


        }
        .save:hover
        {
            background-color: #3DB2EB;

        }
        #add-new-option
        {
            font-size: 30px;
            color: gray;
            margin: 200px;
            text-decoration: none;
        }
        #newOptionID
        {
            width: 40%;
        }
        fieldset
        {
            background-color: #EEEEEE;
            padding: 40px;

        }
        .Answers
        {

            width: 50%;
            margin: 10px;
        }
        .topic
        {
            margin-left:  40%;
            width: 20%;
            border-radius: 15px;
        }
        #Close
        {
            background-color: red;
            color: white;
            border-radius: 80px;
            height: 35px;
        }
    </style>
</head>
<body>
<fieldset>
    <div class="container">
        <div class="row ">
            <form id="sections" action="{{route('savequiz')}}" method="post">
                {{@csrf_field()}}
                <input class="topic" type="text" placeholder="quiz topic" name="quizTopic">

                <input type="hidden" value="{{$courseID}}" name="courseID">
                <input type="hidden" value="0" id="questionsCount" name="questionsCount">
                <br>
                <input class="save" type="submit" value="save quiz">
            </form>
        </div>
        <div class="row text-center">
            <a id="add-new-section" href="#"><span class="gl glyphicon glyphicon-plus"></span> </a><br />

        </div>
    </div>
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
        close.id = 'Close';
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
        options.appendChild(br);

        var addNewOption = document.createElement('a');
        addNewOption.innerHTML = 'Add option';
        addNewOption.href = '#';
        addNewOption.id = 'add-new-option';
        addNewOption.onclick = function(){
            newOption(question.id,options,correctAnswer,optionCount)
            console.log(question.id);

        }
        section.appendChild(addNewOption);


        var br4 = document.createElement('br');
        section.appendChild(br4);

        document.getElementById('sections').appendChild(section);

    };

    var newOption = function(questionID,where, correctAnswerList,optionCountID) {

        console.log(optionCountID.value);
        var optionDiv = document.createElement('div');
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
        questionOption.classList.add("Answers");
        // questionOption.size = '40';
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;

        }
        optionDiv.appendChild(questionOption)
        where.appendChild(optionDiv);

        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        correctAnswerList.appendChild(option);

        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.id = 'Close';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);

            document.getElementById(option.id).remove();

        };
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        where.appendChild(optionDiv);

        var br2 = document.createElement('br');
        where.appendChild(br2);

    };

    document.getElementById('add-new-section').onclick = newQuestion;

    newQuestion();

</script>

</body>
</html>
