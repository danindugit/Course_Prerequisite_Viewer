<?php
    header('Access-Control-Allow-Origin: *');

    error_reporting(0);
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //$inputData = json_decode(file_get_contents('php://input'), true);
        $inputData = json_decode(file_get_contents('php://input'), true);

        if (empty($inputData))
        {
            $newCourse = storeCourse($_POST);
        }
        else
        {
            $newCourse = storeCourse($inputData);
        }
        echo $newCourse;
    }

    function storeCourse($courseInput)
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
        {
            $query = "INSERT INTO parsedData (courseCode,courseTitle,semesters,numLectures,numLabs,credits,courseDescription,offerings,prerequisites) VALUES ('$courseCode','$courseName','$semesters','$numLectures','$numLabs','$credits','$courseDescription','$offerings','$prereqs')";
            $result = mysqli_query($conn, $query);

            if ($result)
            {
                $data = [
                    'status' => 201,
                    'message' => 'Record created successfully'
                ];
                header("HTTP/1.0 201 Created");
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