<html>
<head>
<title>Ante's Guest book</title>

<!-- Connect CSS to the page -->
<link rel="stylesheet" href="main.css">
</head>
<body>

<!-- Import component where you want to use it -->
<?php include '../../components/navbar.php';?>

<body>
    <h1>Guestbook</h1>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
    
    <?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
        // Get user input
        $name = $_POST['name'];
        $message = $_POST['message'];
        
        $entry = "Name: $name        Message: $message\n";
        if($name == ""){
            $entry = "*Webpage reloaded\n";
        }

        file_put_contents('comments.txt', $entry, FILE_APPEND);

        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
    
    
    
    if (file_exists('comments.txt')) {
        $entries = file_get_contents('comments.txt');
        echo "<h2>Guestbook Entries:</h2>";
        echo "<pre>$entries</pre>";
    }
    ?>
</body>
</html>
