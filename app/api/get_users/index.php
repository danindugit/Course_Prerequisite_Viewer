<?php
    // Simulating data
    $users = array(
        array('id' => 1, 'name' => 'John Doe', 'age' => 30),
        array('id' => 2, 'name' => 'Jane Smith', 'age' => 25),
        array('id' => 3, 'name' => 'Michael Johnson', 'age' => 35)
    );

    $servername = "cis3760f23-14";
    $username = "cis3760";
    $password = "pass1234";
    $dbname = "courseData";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) 
    {
        echo $conn->connect_error;
    }
    else
    {
        echo "success";
    }
    // Check if the request method is GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Set the content type to JSON
        header('Content-Type: application/json');

        //-->Missing steps<--
        //sanitize data + responses
        //require_once database connection
        //make MySQL commands + requests 

        //GET Parameter
        $num = $_GET['num'] ?? null;

        //if there is num Parameter
        if ($num){
            echo $num;
        //simple GET
        }else{
            // JSON 200 response 
            echo json_encode($users);
        }
    } else {
        // If the request method is not GET, return an error message
        header('Allow: GET');
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
    }
?>