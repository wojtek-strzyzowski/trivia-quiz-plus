<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}


//Hilfswerkezeuge laden
include 'tools.php';    //prettyPrint() laden
include 'db.php';       //Datenbankverbindung  $dbConnection aufbauen

//falls verfügbar hole die Quizdaten aus der Session
if (isset($_SESSION["quiz"])) $quiz = $_SESSION["quiz"];
else $quiz = null;


//hole die Indexnummer der letzten Frage aus $POST "lastQuestionIndex".
// $lastQuestionIndex wird für question.php und report.php verwendet , jedoch nicht für index.php

if (isset($_POST["lastQuestionIndex"])) {
    // https://www.php.net/manual/en/function.intval.php
    $lastQuestionIndex = intval($_POST["lastQuestionIndex"]);

    // Nur für gültige Fragenindexe: Post-Daten in $_SESSION speichern.
    if ($lastQuestionIndex >= 0) {
        $questionName = "question-" . $lastQuestionIndex;
        $_SESSION[$questionName] = $_POST;
    }
}
else {
    // -1 soll bedeuten, dass das Quiz noch nicht gestartet wurde.
    $lastQuestionIndex = -1;
}

// Abhängig von der aktuellen Hauptseite: Bereite die benötigten Seitendaten vor.
$scriptName = $_SERVER['SCRIPT_NAME']; 

//index.php (Startseite)--------------------------------------------------------------------
if (str_contains($scriptName, 'index')) {
    // Lösche die Daten aus der Session, inkl. bestehende Daten aus dem Quiz
    session_unset();

    $quiz = null;
}

// question.php (Frageseite)----------------------------------------------------------------
else if (str_contains($scriptName, 'question')) {
    if ($quiz===null) {
        $questionNum = intval($_POST["questionNum"]);
        //                     $_POST ["topic"]
    
    
        // hole die Sequenz aus der Frage id's aus der Datenbank
        $questionIdSequence = fetchQuestionIdSequence( $_POST['topic'],$questionNum, $dbConnection);
        
        //berechne die wircklich mögliche Anzahl von Fragen
        $questionNum = count($questionIdSequence); 
        
        // Sammle Quiz-Daten in $quiz und speicher $quiz in der Session
        
       
        $quiz = array ( 
            "topic" => $_POST ["topic"],
            "questionNum" => $questionNum,
            "lastQuestionIndex" => $lastQuestionIndex,
            "currentQuestionIndex" => -1,
            "questionIdSequence" => $questionIdSequence,
        );
        
        $_SESSION["quiz"] = $quiz;

    }

    // Index der aktuellen Frage, sowie für das Quiz setzen
    $currentQuestionIndex = $lastQuestionIndex +1;

    if ($currentQuestionIndex >= $quiz["questionNum"]-1) {
        // Auf die result.php Seite springen.
        $actionUrl = "result.php";
    } 
    else {
        //Die nächste Frage darstellen
        $actionUrl = "question.php";
    }
    
}


    

       //result.php (Auswertungsseite)-------------------------------------------------------------

 




?>
