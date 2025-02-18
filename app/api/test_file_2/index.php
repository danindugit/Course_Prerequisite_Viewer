<?php

    error_reporting(E_ALL);
    ini_set("display_erros",1);

    //echo "This file has a connection";

    $servername = "127.0.0.1";#
    $username = "cis3760";
    $password = "pass1234";
    $dbname = "courseData";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $pdo->prepare("SELECT `SCHEMA_NAME` FROM `information_schema`.`SCHEMATA`");
        $statement->execute();
        $dbs = [];
        while($arr = $statement->fetch(PDO::FETCH_ASSOC))
        {
            echo $arr.'<br>';
        }
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    echo("<script>console.log('PHP: " . $array . "');</script>");

?>