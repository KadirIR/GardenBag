<?php

    $host = 'localhost';
    $dbname = 'gardenbag';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname";

    try{
        $db = new PDO($dsn, $username, $password);
    }catch(PDOException $e){
        echo '<b>Error: </b>' . $e->getMessage();
    }
?>
