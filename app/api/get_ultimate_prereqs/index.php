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

        //get entered prereqs
        $courseCodes = mysqli_real_escape_string($conn, $courseInput["courseCodes"]);
        $courseCodes = strtoupper($courseCodes);
        $takenCourses[] = array_map('trim', explode(",", $courseCodes));

        //calculate credits in each prereq given
        $courseCreditTotals = loadCreditTotals($conn, $takenCourses);
        $totalCreditNumber = calculateCredits($courseCreditTotals);

        //get list of prereq boxes from prereq table A
        $courseComparisonTable = loadCourseComparisonTable($conn);
        $coursePrereqTable = loadPrereqTable($conn);
        
        $database = loadCourseDatabase($conn);

        $returnCourseList = [];
        $requirementsList = [];

        $times = 0;

        //shedding excess array input
        foreach($takenCourses as $takenCourseStrings);

        asort($takenCourses);
        foreach($coursePrereqTable as $prereqTable)
        {
            //for each item in prereq table
            //check if flags
            $courseMatch = true;
            foreach($prereqTable as $key => $item)
            {
                if ($key == "courseCode")
                {
                    $cCode = $item;
                }
                else
                {
                    if ($item == null)
                    {
                        break;
                    }
                    $requirementsList[] = $key;
                    $box = array_map('trim', explode(",", $item));
                    foreach($box as $requirement)
                    {
                        $requirementsList[] = $requirement;
                        
                        #if ($times == 0)
                        #{
                        #    $returnCourseList[] = $requirement;
                        #}
                        if (str_contains($requirement," credits in "))
                        {
                            $inPos = strpos($requirement,"in ");
                            $startPos = $inPos + 3;
                            $program = substr($requirement, $startPos, 20);
                            $program = str_replace('.', '', $program);
                            $creditTokens = explode(" ", $requirement);
                            $creditsRequired = $creditTokens[0];
                            //check program against course code table
                            foreach($courseComparisonTable as $comparisonTable)
                            {
                                if ($comparisonTable["courseName"] == $program)
                                {
                                    $program = $comparisonTable["courseCode"];
                                    break;
                                }
                            }
                            if (array_key_exists($program, $courseCreditTotals) == 1)
                            {
                                $creditsEarned = $courseCreditTotals[$program];
                                if ($creditsEarned >= $creditsRequired)
                                {
                                    $courseMatch = true;
                                    break;
                                    
                                }
                                else
                                {
                                    $courseMatch = false;
                                }
                            }
                            else
                            {
                                $courseMatch = false;
                            }
                        }
                        else if (str_contains($requirement, "credits."))
                        {
                            $creditTokens = explode(" ", $requirement);
                            if($totalCreditNumber >= $creditTokens[0])
                            {
                                $courseMatch = true;
                                break;
                            }
                            else
                            {
                                $courseMatch = false;
                            }
                        }
                        else if (is_numeric($item))
                        {
                            if ($totalCreditNumber >= $item)
                            {
                                $courseMatch = true;
                                break;
                            }
                            else
                            {
                                $courseMatch = false;
                            }
                        }
                        else
                        {
                            foreach($takenCourseStrings as $strong)
                            {
                                if (str_contains($strong, $requirement))
                                {
                                    $courseMatch = true;
                                    
                                    break;

                                }
                                else
                                {
                                    $courseMatch = false;
                                }
                            }
                            
                        }
                        if ($courseMatch == true)
                        {
                            break;
                        }
                    }
                    #$times++;
                    if ($courseMatch == false)
                    {
                        break;
                    }
                }
                
            }
            if ($courseMatch == true)
            {
                if (!in_array($cCode, $takenCourseStrings))
                {
                    $returnCourseList["course$times"] = $prereqTable["courseCode"];
                    $times++;
                }
            }

        }

        //This can be uncommented to add prerequsisites without course requirements

        //foreach($database as $course)
        //{
        //    if ($course["prerequisites"] == null)
        //    {
        //        $returnCourseList[] = $course["courseCode"];
        //    }
        //}

        //asort($returnCourseList);

        $data = [
            'status' => 200,
            'message' => 'Prereqs retrieved!',
            'data' => $returnCourseList
        ];
        header("HTTP/1.0 200 Success");
        echo json_encode($data);
        exit();
    }

    function loadCourseDatabase($conn)
    {
        //change to data
        $query = "SELECT * FROM parsedData";
        $result = mysqli_query($conn, $query);

        while($row[] = mysqli_fetch_assoc($result));

        return $row;
    }

    function loadPrereqTable($conn)
    {
        //change to prereqa
        $query = "SELECT * FROM prereqa";
        $result = mysqli_query($conn, $query);

        while($prereqTable[] = mysqli_fetch_assoc($result));

        foreach($prereqTable as $item)
        {
            if ($item != null)
            {
                $returnPrereqTable[] = $item;
            }
        }

        return $returnPrereqTable;
    }

    function loadCreditTotals($conn, $courseCodes)
    {
        $courseCreditTotals = [];
        $courseStrings = [];

        foreach($courseCodes as $courseStrings);

        foreach($courseStrings as $item)
        {
            $courseCode = substr($item, 0, strpos($item, '*'));
            if (!array_key_exists($courseCode, $courseCreditTotals))
            {
                $courseCreditTotals[$courseCode] = 0;
            }
            //change to data
            $query = "SELECT credits FROM parsedData WHERE courseCode LIKE '%$item%' LIMIT 1";
            $result = (mysqli_query($conn, $query)) or die(mysqli_error($conn));
            if ($result)
            {
                $row = mysqli_fetch_assoc($result);
                $creditsToAdd = (double)$row["credits"];
                $currentCredits = (double)$courseCreditTotals[$courseCode];
                $totalToAdd = $creditsToAdd + $currentCredits;
                $courseCreditTotals[$courseCode] = $totalToAdd;
            }
        
        }

        asort( $courseCreditTotals );
        return $courseCreditTotals;
    }

    function calculateCredits($courseCreditTotals)
    {
        $total = 0;
        foreach($courseCreditTotals as $courseCode => $credits)
        {
            $total = $total + $credits;
        }

        return $total;
    }

    function loadCourseComparisonTable($conn)
    {
        //change to courseCodes
        $query = "SELECT * FROM coursecodes";
        $result = mysqli_query($conn, $query);

        while($courseTable[] = mysqli_fetch_assoc($result));

        foreach($courseTable as $item)
        {
            if ($item != null)
            {
                $returnPrereqTable[] = $item;
            }
        }

        

        return $returnPrereqTable;
    }

?>