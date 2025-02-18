<?php
   // https://stackoverflow.com/questions/33439030/how-to-grab-data-using-fetch-api-post-method-in-php
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Set the content type to JSON
        header('Content-Type: application/json');

        // Access and process the parameters
        $name = $_POST['name'] ?? null;
        $age = $_POST['age'] ?? null;

        // Check if the required parameters are present
        if ($name && $age) {
            // Create a response array
            $response = array(
                'message' => 'Data received successfully',
                'name' => $name,
                'age' => $age
            );

            //--Missing steps
            //sanitize data + responses
            //require_once database connection
            //make MySQL commands + requests 

            // Encode the response array to JSON and output it
            echo json_encode($response);
        } else {
            // If parameters are missing, return an error message
            http_response_code(400);
            echo json_encode(array('message' => 'Missing parameters'));
        }
    } else {
        // If the request method is not POST, return an error message
        header('Allow: POST');
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
    }
?>