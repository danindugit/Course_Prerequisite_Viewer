<style>
  h1 {
    text-align: center;
    color: #333;
}

body {
    font-family: Arial, sans-serif;
    background-color: #C20430;
    margin: 0;
    padding: 20px;
}


label {
    display: white;
    margin-bottom: 10px;
    color: #ffffff;
}
form {
    max-width: 300px;
    margin: 0 auto;
    background-color: #C20430;
    padding: 20px;
    border-radius: 5px;
    
}


h3 {
    text-align: center;
    margin-top: 25px;
    color: #FFC72A;
}
input[type="number"],
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #000000;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 19px;
}



</style>

<?php
include '../../components/navbar.php';

    // recieve input
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operator = $_POST["operator"];

    
    if ($operator == "+") {
      $result = $num1 + $num2;
  } elseif ($operator == "-") {
      $result = $num1 - $num2;
  } elseif ($operator == "*") {
      $result = $num1 * $num2;
  } elseif ($operator == "/") {
      //error handling
      if ($num2 == 0) {
          $result = "Can't divide by 0 try again";
      } else {
          $result = $num1 / $num2;
      }
  } else {
      $result = "Wrong operator option";
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h1>Calculator</h1>

    <!-- Calculator form -->
    <form method="POST">
        <label for="num1">First Number:</label>
        <input type="number" name="num1" required><br>

        <label for="operator">Choose the operator:</label>
        <select name="operator" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br>

        <label for="num2">Second Number:</label>
        <input type="number" name="num2" required><br>

        <input type="submit" value="Calculate">
    </form>

   
    <?php if (isset($result)) { ?>
        <h3>Result: <?php echo $result; ?></h3>
    <?php } ?>

</body>
</html>
<!-- Sources:
https://t4tutorials.com/simple-calculator-using-php/
https://www.w3schools.in/php/examples/simple-calculator-program
https://tutorialsclass.com/exercise/simple-calculator-program-in-php/
    -->
