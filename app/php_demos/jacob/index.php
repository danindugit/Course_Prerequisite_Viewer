<html>
    <head>
        <title>Jake's PHP Demo</title>
    </head>
    <body>
        <?php
            include '../../components/navbar.php';
            
        ?>
        <body>
            <div style="text-align: center; padding-top: 25px">
                <h1>About Jake</h1>
                <img class="card-img-top" src="../../components/jacob.jpeg" alt="Card image cap" style="max-width:20%;">
            </div>
            <div class="fun-facts" style="text-align: center; padding-top: 25px">
                <p>- 4th year computer science student at the University of Guelph.</p>
                <p>- Has designed a game for the Baltimore Ravens.</p>
                <p>- Loves to play golf.</p>
                <p>- Once won $5000 on HQ.</p>
            </div>
            <div class="like-meter" style="text-align: center; padding-top: 25px">
                <?php
                    $counter = file_get_contents("counter.txt");
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $counter = isset($_POST['counter']) ? $_POST['counter'] : 0;
                        if(isset($_POST["big-button"])){
                            $counter++;
                        }
                        file_put_contents('counter.txt', $counter);
                    }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = post>
                    <button name="big-button" type="submit" class="btn btn-danger btn-lg">How much do you like me? Click to increase the like meter</button>
                    <input type = "hidden" name = "counter" value = "<?php print $counter; ?>"; />
                </form>
                <div>
                    <?php
                        echo "Like meter: ".$counter;
                    ?>
                </div>
            </div>
        </body>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>