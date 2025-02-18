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

        $courseCode = mysqli_real_escape_string($conn, $inputData["courseCode"]);
        $courseName = mysqli_real_escape_string($conn, $inputData["courseTitle"]);
        $courseDescription = mysqli_real_escape_string($conn, $inputData["courseDescription"]);

        if (!empty($courseCode))
        {
            getByCode($courseCode, $conn);
        }
        elseif (!empty($courseName))
        {
            getByTitle($courseName, $conn);
        }
        elseif (!empty($courseDescription))
        {
            getByDescription($courseDescription, $conn);
        }
    }

    function getByCode($courseCode, $conn)
    {
        if (str_contains($courseCode,"'") || str_contains($courseCode,"%"))
        {
            error403("illegal characters in courseCode");
        }
        $query = "SELECT * FROM parsedData WHERE courseCode='$courseCode' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $res = mysqli_fetch_assoc($result);

                $data = [
                    'status' => 200,
                    'message' => "Record found!",
                    'data' => $res
                ];
                header("HTTP/1.0 200 Ok");
                echo json_encode($data);
                exit();
            }
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

    function getByTitle($courseName, $conn)
    {
        if (str_contains($courseName,"'") || str_contains($courseName,"%")) 
        {
            error403("illegal characters in courseName");
        }
        $query = "SELECT * FROM parsedData WHERE courseName='$courseName' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $res = mysqli_fetch_assoc($result);

                $data = [
                    'status' => 200,
                    'message' => "Record found!",
                    'data' => $res
                ];
                header("HTTP/1.0 500 Ok");
                echo json_encode($data);
                exit();
            }
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

    function getByDescription($courseDescription, $conn)
    {
        if (str_contains($courseDescription,"'") || str_contains($courseDescription,"%")) 
        {
            error403("illegal characters in courseDescription");
        }
        $query = "SELECT * FROM parsedData WHERE courseDescription='$courseDescription' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $res = mysqli_fetch_assoc($result);

                $data = [
                    'status' => 200,
                    'message' => "Record found!",
                    'data' => $res
                ];
                header("HTTP/1.0 500 Ok");
                echo json_encode($data);
                exit();
            }
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
