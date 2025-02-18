<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

    error_reporting(0);
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputData = json_decode(file_get_contents('php://input'), true);

        if (empty($inputData))
        {
            $newCourse = getCourse($_POST);
        }
        else
        {
            $newCourse = getCourse($inputData);
        }
        echo $newCourse;
    }

    function getCourse($inputData)
    {
        $servername = "localhost";
        $username = "cis3760";
        $password = "pass1234";
        $dbname = "courseData";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }

        $courseCodes = mysqli_real_escape_string($conn, $inputData["courseCodes"]);
        
        if (!empty($courseCodes))
        {
            getByCode($courseCodes, $conn);
        }
    }

    function getByCode($courseCodes, $conn)
    {
        if (str_contains($courseCodes,"'") || str_contains($courseCodes,"%")) 
        {
            error403("illegal characters in courseCode");
        }
        $rows = [];
        $codes = explode(",", $courseCodes);
        $courseFound = 0;
        $startCourseLoop = 0;
        $query = "";
        foreach ($codes as $code)
        {
            if ($startCourseLoop != 0)
            {
                $query .= " AND prerequisites LIKE '%$code%'";
            } else
            {
                $startCourseLoop++;
                $query .= "SELECT * FROM parsedData WHERE prerequisites LIKE '%$code%'";
            }
        }
        $result = (mysqli_query($conn, $query)) or die(mysqli_error($conn));
        if ($result)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                //$rows[] = $row;
                $courseFound = 0;
                foreach($rows as $checkCourse)
                {
                    if ($checkCourse["courseCode"] == $row["courseCode"])
                    {
                        $courseFound++;
                    }
                }
                if ($courseFound == 0)
                {
                    $rows[] = $row;
                }
            }
        }

        if ($rows)
        {
            //$res = mysqli_fetch_assoc($rows);

            $data = [
                'status' => 200,
                'message' => "Records found!",
                'data' => $rows
            ];
            header("HTTP/1.0 200 Ok");
            echo json_encode($data);
            exit();
        } else
        {
            $data = [
                'status' => 404,
                'message' => "Nothing found!",
            ];
            header("HTTP/1.0 404 Not found");
            return json_encode($data);
        }
    }

    function error403($message)
    {
        $data = [
            'status' => 403,
            'message' => $message,
        ];
        header("HTTP/1.0 403 Forbidden");
        echo json_encode($data);
        exit();
    }

?>
