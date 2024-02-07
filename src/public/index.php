<?php 
    include './utils/data-collector.php';
    include './utils/head.php'; 
?>

<body>


    <div class="container-fluid">
        
        <div class="row-1">

        </div>


        <div class="row-2">
            <div class="col">
                <h1 class="glow-element">Trivia Quiz</h1>
            </div>
         </div>
    
    <div class="row-3">   
        
    <form action="question.php" method="post" id="quiz-form" onsubmit="return navigate('next');">
        <!-- <label for="quiz-topic" class="form-label"></label> -->
        <select class="form-select" aria-label="Default select example" id="topic" name="topic">
            <!-- <option selected>Thema</option> -->
            <option   selected value="cinema">Cinema</option>
            <option value="tech">Tech</option>
            <option value="animals">Animals</option>
            <option value="ch-norris">Chuck Norris</option>
            <option value="tiere">Tiere</option>
            <option value="geography">Geography</option>
            <option value="astronomy">Astronomy</option>
            <option value="history">History</option>
            <option value="werkzeuge">Werkzeuge</option>


        </select>
    </div> 
        
    <div class="row-4">   
        <div class="form-group">
            <label for="questionNum" class="form-label"><p>Anzahl der Fragen</p></label>
            <input class="form-control" type="number" id="questionNum" name="questionNum" min="1" max="40" value="10">

        </div>
        <input type="hidden" id="lastQuestionIndex" name="lastQuestionIndex" value="-1">
        <input type="hidden" id="indexStep" name="indexStep" value="1">

        <p id="validation-warning" class="warning"></p>

        <div class="start-button">
            <button type="submit" class="btn btn-primary">Start</button>
        </div>

    </div>

    <div class="row-5 glow-element">
    <marquee class="marquee-text" scrollamount=5 scrolldelay=5>Testen Sie Ihr Wissen!!</marquee>
    </div>
        
        
    
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
