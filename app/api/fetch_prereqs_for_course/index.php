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
        $dbname = "courseData";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }

        $code = mysqli_real_escape_string($conn, $courseInput["courseCode"]);

        $query = "SELECT * FROM  parsedData WHERE courseCode LIKE '$code'";
        $query_run = mysqli_query($conn, $query);

        $row = [];
        $edges = [];

        $row = mysqli_fetch_assoc($query_run);

        $prereqs = array_map('trim', preg_split("/,(?![^(]+\))/", $row["prerequisites"]));

        $times = 0;

        foreach($prereqs as $prereq)
        {
            if (str_contains($prereq, " or "))
            {
                $prereq = trim($prereq, "()");
                $nodes = array_map('trim', explode(' or ', $prereq));
                foreach($nodes as $node)
                {
                    
                    if (!in_array(array("data" => array("source" => $node, "target" => $code )), $edges))
                    {
                        $edge =  array("data" => array("source" => $node, "target" => $code ));
                        $edges[] = $edge;
                    }
                }
            }
            elseif (str_contains($prereq, "1 of "))
            {
                $prereq = trim($prereq, "()");
                $prereq = str_replace("1 of ", "", $prereq);
                $nodes = array_map('trim', explode(',', $prereq));
                foreach($nodes as $node)
                {
                    if (!in_array( array("data" => array("source" => $node, "target" => $code )), $edges))
                    {
                        $edge =  array("data" => array("source" => $node, "target" => $code ));
                        $edges[] = $edge;
                    }
                }
            }
            elseif (is_numeric($prereq))
            {
                $prereq .= " credits.";
                if (!in_array(array("data" => array("source" => $prereq, "target" => $code )), $edges))
                {
                    $edge = array("data" => array("source" => $prereq, "target" => $code ));
                    $edges[] = $edge;
                }
            }
            else
            {
                if (!in_array(array("data" => array("source" => $prereq, "target" => $code )), $edges))
                {
                    $edge = array("data" => array("source" => $prereq, "target" => $code ));
                    $edges[] = $edge;
                }
            }
        }

        $data = [
            'status' => 200,
            'message' => 'Prereqs retrieved!',
            'data' => $edges
        ];
        header("HTTP/1.0 200 Success");
        echo json_encode($data);
        exit();
    }

?>