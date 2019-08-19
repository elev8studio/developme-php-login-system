<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Switch - Sunset to Sunrise</title>
        <style media="screen">
            body {
                font-family: sans-serif;
                line-height: 22px;
            }
        </style>
    </head>
    <body>
        <?php
        // Create a for loop that goes through the hours of the day, starting at 0:00. Write a switch statement to print whether it is light or not.

        // For example:

        // "0:00 is dark"
        // ...
        // "8:00 is light"
        // ...
        // "23:00 is dark"

        for($hour = 0; $hour <= 23; $hour++) {
            switch ($hour) {
                case 0: case 1: case 2: case 3: case 4: case 5: case 22: case 23:
                    echo $hour.':00 is &#9790;'.'<br />'; break;
                default:
                    echo $hour.':00 is &#9728;'.'<br />'; break;
            }
        }
        ?>
    </body>
</html>
