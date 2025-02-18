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
            $newCourse = updateCourse($_POST);
        }
        else
        {
            $newCourse = updateCourse($inputData);
        }
        echo $newCourse;
    }

    function updateCourse($courseInput)
    {
        $servername = "localhost";
        $username = "cis3760";
        $password = "pass1234";
        $dbname = "courseData";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }

        $courseCode = mysqli_real_escape_string($conn, $courseInput["courseCode"]);
        $courseName = mysqli_real_escape_string($conn, $courseInput["courseTitle"]);
        $semesters = mysqli_real_escape_string($conn, $courseInput["semesters"]);
        $numLectures = mysqli_real_escape_string($conn, $courseInput["numLectures"]);
        $numLabs = mysqli_real_escape_string($conn, $courseInput["numLabs"]);
        $credits = mysqli_real_escape_string($conn, $courseInput["credits"]);
        $courseDescription = mysqli_real_escape_string($conn, $courseInput["courseDescription"]);
        $offerings = mysqli_real_escape_string($conn, $courseInput["offerings"]);
        $prereqs = mysqli_real_escape_string($conn, $courseInput["prereqs"]);

        if(str_contains($courseCode,"'") || str_contains($courseCode,"%"))
        {
            error403('Forbidden character in courseCode');
        }
        elseif(str_contains($courseName,"'") || str_contains($courseName,"%"))
        {
            error403('Forbidden character in courseTitle');
        }
        elseif(str_contains($courseDescription,"'") || str_contains($courseDescription,"%"))
        {
            error403('Forbidden character in courseDescription');
        }
        if(empty(trim($courseCode)))
        {
            error422('Enter the courseCode');
        }
        elseif (empty(trim($courseName)))
        {
            error422('Enter the courseName');
        }
        elseif (empty(trim($courseDescription)))
        {
            error422('Enter the courseDescription');
        }
        else
        {   //change back to parsedData
            $query = "UPDATE parsedData SET courseCode='$courseCode',courseTitle='$courseName',semesters='$semesters',numLectures='$numLectures',numLabs='$numLabs',credits='$credits',courseDescription='$courseDescription',offerings='$offerings',prerequisites='$prereqs' WHERE courseCode='$courseCode' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result)
            {
                $data = [
                    'status' => 200,
                    'message' => 'Record updated successfully'
                ];
                header("HTTP/1.0 200 Success");
                echo json_encode($data);
            }
            else
            {
                $data = [
                    'status' => 500,
                    'message' => 'Internal server error'
                ];
                header("HTTP/1.0 500 Internal server error");
                echo json_encode($data);
            }
        }
    }

    function error422($message)
    {
        $data = [
            'status' => 422,
            'message' => $message
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        echo json_encode($data);
        exit();
    }

    function error403($message)
    {
        $data = [
            'status' => 403,
            'message' => $message,
        ];
        header("HTTP/1.0 403 Forbidden character");
        echo json_encode($data);
        exit();
    }
?>