<?php
    include '../components/navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>App Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .review {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1.2rem;
            text-align: center;
            
        }
        .reviewer {
            font-weight: bold;
        }
        .emoji {
            color: #FFD700; 
        }
    </style>
</head>
<body class="container d-flex align-items-center flex-column">
    <h1 class="mt-4 mb-4">Contributions of Team Members</h1>
    
    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Ante</h4>
        <p>Team Lead</p>
    </div>
    
    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Wisam</h4>
        <p>Review page 
        <br>work Contributions page
        <br>PHP research and demo
        <br>NGINX research
        <br>Wiki</p>
    </div>

    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Egor</h4>
        <p>CSS polish
        <br>NGINX and PHP production set up with Dan
        <br>PHP research and demo
        <br>NGINX research
        <br>HTML, CSS, JS help</p>
    </div>
    
    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Dan</h4>
        <p>NGINX and PHP production set up with Egor
        <br>Wrote content for the bad reviews page
        <br>PHP research and demo
        <br>NGINX research</p>
    </div>

    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Connor</h4>
        <p>how to use page 
        <br>work Contributions page
        <br>PHP research and demo
        <br>NGINX research
        <br>upcoming features page</p>
    </div>

    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Jake</h4>
        <p>Home page design and implementation
        <br>Demo page design and implementation
        <br>PHP research and demo</p>
    </div>

    <div class="review col-12 col-md-8 col-lg-6 rounded shadow">
        <h4>Graham</h4>
        <p>Worked with Jake to create and implement the Navbar UI
        <br>Home page
        <br>PHP research and demo
        <br>NGINX research
        <br>Wiki
        <br>Demo library page</p>
    </div>
</body>
</html>
  
