<?php 
    include './utils/data-collector.php';
    include './utils/head.php'; 
?>


<body>
<?php 
       
       // Holde die ID der aktuellen Frage aus $quiz
        if (isset($quiz["questionIdSequence"])) {
            $id = $quiz["questionIdSequence"][$currentQuestionIndex];
          
        }
    
        // Hole alle Datenfelder zur Frage mit $id von der Datenbank
        $question = fetchQuestionById($id, $dbConnection);


?>

<div class="container-fluid">
 
    <div class="row-10 glow-element">
        <div class="col-9">
        <h1>Frage <?php echo ($currentQuestionIndex + 1);?> von <?php echo $quiz ["questionNum"]; ?> </h1>
        
        <h2><?php echo $question["question_text"]; ?></h2>
        </div>
    </div>

  <div class="row-11">  
    <div class="col-12">
<form action="<?php echo $actionUrl; ?>" method="post" onsubmit="return navigate('next');">   
   
   <?php 
    $correct = $question["correct"];    //z.B.: den String "1,3"
    

    $pattern = "/\s*, \s*/";    //RegEx-Suchmuster für die Trennzeichen
    $correctItems = preg_split($pattern, $correct);   //["1","3"]

    //Verwandle die id-strings in id-nummern
    foreach ($correctItems as $i => $item) {
        $correctItems[$i] = intval ($item);
    }
    //Berechne die maximal mögliche Punktzahl für diese Frage
    $maxPoints = count($correctItems);

    //Entscheide , ob single-choice (radio) oder multiple-choice (checkbox) Antworten sind
    if (count($correctItems) > 1) $multipleChoice = true;
    else $multipleChoice = false;   //Bedeutet Single-Choice

    for ($a = 1; $a <= 5 ; $a++) {

        //setze für $answerColumnName den Namen der tabellenspalte "answer-N" zusammen
        $answerColumnName = "answer_" . $a;

        if (isset($question[$answerColumnName]) && !empty($question[$answerColumnName])) {

            $answerText = $question[$answerColumnName];

            if (in_array($a, $correctItems, true)) $value = 1;
            else $value = 0;
        

        echo "\n<div class='form-check'>\n";
        
        if ($multipleChoice) {
            echo " <input class='form-check-input' type='checkbox' name='$answerColumnName' id='$answerColumnName' value='$value'>\n";
        }
        else {
            echo " <input class='form-check-input' type='radio' name='single-choice' id='$answerColumnName' value='$value'>\n";
        }

        echo " <label class='form-check-label' for='$answerColumnName'>$answerText</label>\n";
        echo "</div>";

    }
}
   ?>
            <input type="hidden" name="questionNum" value="<?php $quiz["questionNum"];?>">
            <input type="hidden" name="lastQuestionIndex" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex;?>">
            <input type="hidden" name="multipleChoice" name="multipleChoice" value="<?php echo $multipleChoice ? 'true' : 'false'; ?>">
            <input type="hidden" id="maxPoints" name="maxPoints" value="<?php echo $maxPoints; ?>">
            <input type="hidden" name="indexStep" name="indexStep" value="1">
    </div>
    </div>
    <div class="next-button">
        <button type="submit" class="btn btn-primary">Next</button>
        <input type="hidden">
    </div>
    
</form>
</div>
</body>
</html>
