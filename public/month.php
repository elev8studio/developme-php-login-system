<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Month</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <h2>

            <?php
            $month = 1;

            if ($month == 1) {
                echo 'It\'s January!';
            } elseif ($month == 2) {
                echo 'It\'s February!';
            } elseif ($month == 3) {
                echo 'It\'s March!';
            } elseif ($month == 4) {
                echo 'It\'s April!';
            } elseif ($month == 5) {
                echo 'It\'s May!';
            } elseif ($month == 6) {
                echo 'It\'s June!';
            } elseif ($month == 7) {
                echo 'It\'s July!';
            } elseif ($month == 8) {
                echo 'It\'s August!';
            } elseif ($month == 9) {
                echo 'It\'s September!';
            } elseif ($month == 10) {
                echo 'It\'s October!';
            } elseif ($month == 11) {
                echo 'It\'s November!';
            } elseif ($month == 12) {
                echo 'It\'s December!';
            } else {
                echo 'Please choose a valid month!';
            }
            ?>
         </h2>

    </body>
</html>
