<!DOCTYPE html>
<html>
    <head>
        <title>Danindu's PHP Demo</title>

        <link rel="stylesheet" href="./main.css">

    </head>
    <body>
        <?php
            include '../../components/navbar.php';
        ?>
      <header>
         <br>
         <h1>About Danindu</h1>
         <br>
      </header>
      <div style="text-align: center;">
         <img src="../../components/dan.png" alt="Danindu's Image" class="header-image">
         <br>
         <br>
         <p>Choose a sport below to view my favourite team:</p>
      </div>
      
      <div style="text-align: center; margin-top: 20px;">
         <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = post>
            <button name="sport" value="Hockey" type="submit" class="btn btn-danger btn-lg">Hockey</button>
            <button name="sport" value="Football" type="submit" class="btn btn-danger btn-lg">Football</button>
            <button name="sport" value="Basketball" type="submit" class="btn btn-danger btn-lg">Basketball</button>
            <button name="sport" value="Baseball" type="submit" class="btn btn-danger btn-lg">Baseball</button>
         </form>
      </div>
      <div style="text-align: center; margin-top: 20px;">
         <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['sport'])) {
                  $selectedSport = $_POST['sport'];
                  echo "<p>";

                  switch ($selectedSport) {
                     case 'Hockey':
                        echo "Vancouver Canucks!";
                        echo '<br><br><img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/3a/Vancouver_Canucks_logo.svg/1200px-Vancouver_Canucks_logo.svg.png" alt="canucks logo" class="sports-logo">';
                        break;
                     case 'Football':
                        echo "Kansas City Chiefs!";
                        echo '<br><br><img src="https://cdn.freebiesupply.com/images/large/2x/kansas-city-chiefs-logo-transparent.png" alt="chiefs logo" class="sports-logo">';
                        break;
                     case 'Basketball':
                        echo "Toronto Raptors!";
                        echo '<br><br><img src="https://cdn.freebiesupply.com/images/large/2x/toronto-raptors-logo-transparent.png" alt="raptors logo" class="sports-logo">';
                        break;
                     case 'Baseball':
                        echo "Toronto Blue Jays!";
                        echo '<br><br><img src="https://cdn.freebiesupply.com/images/large/2x/toronto-blue-jays-logo-transparent.png" alt="blue jays logo" class="sports-logo">';
                        break;
                     default:
                        echo "No selection.";
                  }

                  echo "</p>";
            }
         }
         ?>
      </div>

      <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>