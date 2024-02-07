<?php

//verbinde mit mySQL, mit Hilfe eines PHP PDO Objektes
$dbHost = getenv("DB_HOST");
$dbName = getenv("DB_NAME");
$dbUser = getenv("DB_USER");
$dbPassword = getenv("DB_PASSWORD");


try {
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    
    //setze den Fehlermode für Web Devs
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}


//----------Query Functions--------------------

function fetchQuestionIdSequence($topic, $questionNum, $dbConnection) {
    $query = "SELECT `id` FROM `questions` WHERE `topic` = '$topic' ORDER BY RAND() LIMIT $questionNum"; 

$sqlStatement = $dbConnection -> query($query);
$rows = $sqlStatement -> fetchAll(PDO::FETCH_COLUMN, 0); // `id` ist die Spalte (column) 0.

return $rows;

}

function fetchQuestionById($id, $dbConnection) {
    $sqlStatement = $dbConnection -> query ("SELECT * FROM `questions` WHERE `id` = $id");
    $row = $sqlStatement -> fetch(PDO::FETCH_ASSOC);

    return $row;
}
?>