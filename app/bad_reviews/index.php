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
        }
        .reviewer {
            font-weight: bold;
        }
        .stars {
            color: #FFD700; 
        }
    </style>
</head>
<body class="container">
    <h1 class="mt-4 mb-4">App Reviews</h1>
    
    <div class="review rounded shadow-sm">
        <p>"This app is a total waste of time! The download button doesn't work half the time, and when it does, the download speed is painfully slow. I expected more, but I'm left disappointed."</p>
        <p class="reviewer">Greg K. <span class="stars">⭐⭐</span></p>
    </div>
    
    <div class="review rounded shadow-sm">
        <p>"I can't believe I wasted my money on this app. The download button is unreliable, and the user interface is clunky and confusing. Don't bother with it!"</p>
        <p class="reviewer">Emily P.<span class="stars">⭐</span></p>
    </div>

    <div class="review rounded shadow-sm">
        <p>"I thought this app would make downloading files easier, but it's been nothing but frustrating. The download button often freezes, and I've encountered numerous bugs. It's not worth the hassle."</p>
        <p class="reviewer">Michael R.<span class="stars">⭐⭐</span></p>
    </div>

    <div class="review rounded shadow-sm">
        <p>"I had high hopes for this download app, but it's been a letdown. The download button often gives errors, and it doesn't support a wide range of file formats. I regret downloading it."</p>
        <p class="reviewer">Olivia L.<span class="stars">⭐⭐⭐</span></p>
    </div>

    <div class="review rounded shadow-sm">
        <p>"I tried using this app to streamline my downloads, but it's been a headache. The download button is slow, and the app frequently crashes. It's unreliable and not worth the trouble."</p>
        <p class="reviewer">John M.<span class="stars">⭐</span></p>
    </div>
</body>
</html>