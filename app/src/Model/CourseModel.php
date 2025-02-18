<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class CourseModel extends Database
{
    public function getCourses($limit)
    {
        return $this->select("SELECT * FROM parsedData ORDER BY courseCode ASC LIMIT ?", ["i", $limit]);
    }

    public function getHello()
    {
        return "hello";
    }

    //Add other functions here
    // delete function
    // put function
    // post function?
}