<?php 
    include './utils/data-collector.php';
    include './utils/head.php'; 
?>


<body>

    
    <div class="container-fluid result">
       <div class="row-7 glow-element"> 
       <div class="col-8">
            <h1>Vielen Dank für Ihre Teilnahme!!</h1>
            <h2>Dies ist Ihr Ergebnis :</h2>
       </div>    
        </div>

        <div class="row-8">
           
            <div class="col-8">
               <?php
               //Bestimme die Anzahl der erreichten Punkte. Dazu wird das 'value'-Attribut der Eingabefelder ausgewertet.

               $totalPoints = 0;
               $maxTotalPoints = 0;

            foreach ($_SESSION as $questionKey => $data) {
                if (str_contains($questionKey, 'question-')) {
                    if ($data["multipleChoice"] === 'true'){
                        foreach ($data as $key => $value) {
                            if (str_contains($key, 'answer_')) {
                                $points = intval($value);
                                $totalPoints = $totalPoints + $points;
                            }
                        }
                    }
                    else if ($data["multipleChoice"] === 'false') {
                        if (isset($data["single-choice"])) {
                            $points = intval(($data["single-choice"]));
                            $totalPoints = $totalPoints + $points;
                        }
                    }
                    $maxTotalPoints = $maxTotalPoints + intval($data["maxPoints"]);
                }
            }   
        
        $prozentErgebnis = $totalPoints * 100 / $maxTotalPoints;
            if ($prozentErgebnis > 70) $feedback = "Glückwunsch";
                   
            elseif ($prozentErgebnis >= 40 && $prozentErgebnis <= 70) $feedback = "Geht was....aber geht besser";
            
            else $feedback ="Komm schon fang an zu lernen ....";
               ?>
               <h2> <?php echo $feedback ?></h2>
               <h1>Sie haben <?php echo $totalPoints; ?> von möglichen <?php echo $maxTotalPoints; ?> Punkten.</h1>
            </div>
        </div>
        <div class="row-9">
                <div class="col-12">
            <form>
                 <button class="btn btn-primary" type="submit" formaction="index.php">Neues Quiz Starten</button>
             </form>
             </div>
            </div>
            
</div>

</body>
</html>