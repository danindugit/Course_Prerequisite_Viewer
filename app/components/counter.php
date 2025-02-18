<?php
    $counter = 'counter.txt';
    $download = '../Eligibility_Finder.xlsm';

    $number = file_get_contents($counter);
    $number++;
    $file = fopen($counter, 'w');
    fwrite($file, $number);
    fclose($file);
    header("Location: $download");
?>
