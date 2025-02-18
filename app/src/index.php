<?php
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/CourseController.php";
//$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$uri = explode( '/', $uri );
echo json_encode($uri);
//
//$limit = 20;
//
//if ((isset($uri[2]) && $uri[2] != 'course') || !isset($uri[3])) {
//    header("HTTP/1.1 404 Not Found");
//    exit();
//}

$objFeedController = new CourseController();
$objFeedController->echoHello();
//$strMethodName = $limit . 'Action';
//$objFeedController->{$strMethodName}();
?>
