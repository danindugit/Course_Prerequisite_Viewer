<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

    error_reporting(0);
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //$inputData = json_decode(file_get_contents('php://input'), true);
        $inputData = json_decode(file_get_contents('php://input'), true);

        //A proper PUT call would use both $_POST and $_GET, but we are just updating with code for now
        if (empty($inputData))
        {
            $newCourse = processData($_POST);
        }
        else
        {
            $newCourse = processData($inputData);
        }
        echo $newCourse;
    }

    function processData($courseInput)
    {
        $servername = "localhost";
        $username = "cis3760";
        $password = "pass1234";
        $dbname = "coursedata";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }

        $code = mysqli_real_escape_string($conn, $courseInput["courseCode"]);

        $query = "SELECT * FROM parsedData WHERE courseCode LIKE '$code*%'";
        $query_run = mysqli_query($conn, $query);

        $row = [];

        while($row[] = mysqli_fetch_assoc($query_run));

        $data = [
            'status' => 200,
            'message' => 'Prereqs retrieved!',
            'data' => $row
        ];
        header("HTTP/1.0 200 Success");
        echo json_encode($data);
        exit();
    }

?>