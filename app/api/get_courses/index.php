<?php
    #header('Access-Control-Allow-Origin: *');
    #header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    #header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

    $servername = "localhost";
    $username = "cis3760";
    $password = "pass1234";
    $dbname = "courseData";
    #$servername = "localhost";
    #$username = "root";
    #$password = "";
    #$dbname = "coursedata";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
    // Check if the request method is GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Set the content type to JSON
        header('Content-Type: application/json');

        $query = "SELECT * FROM parsedData";
        $query_run = mysqli_query($conn, $query);

        if ($query_run)
        {
            if (mysqli_num_rows($query_run) > 0)
            {
                $res = mysqli_fetch_all($query_run);

                $json_data = array();
                foreach ($res as $course) {
                    array_push($json_data, [
                        'courseCode' => $course[0],
                        'courseTitle' => $course[1],
                        'semesters' => $course[2],
                        'numLectures' =>  $course[3],
                        'numLabs' => $course[4],
                        'credits' => $course[5],
                        'courseDescription' => $course[6],
                        'offerings' => $course[7],
                        'prerequisites' => $course[8],
                        'equates' => $course[9],
                        'restrictions' => $course[10],
                        'department' => $course[11],
                        'location' => $course[12],
                    ]);
                }

                $data = [
                    'status' => 200,
                    'message' => 'Courses found',
                    'data' => $json_data
                ];
                header("HTTP/1.0 200 Success");
                echo json_encode($data);
            }
            else
            {
                $data = [
                    'status' => 404,
                    'message' => 'No records found'
                ];
                header("HTTP/1.0 404 No records found");
                echo json_encode($data);
            }
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
?>