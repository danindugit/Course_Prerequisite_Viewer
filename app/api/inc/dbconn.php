<?php

    $servername = "localhost";
    $username = "root";
    $password = "pass1234";
    $dbname = "coursedata";

    //program cannot create database variable... try OOP?
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

?>