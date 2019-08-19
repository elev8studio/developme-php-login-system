<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>How Many Seconds In Year</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <h2>
            <?php
            $daysInYear = 365.25;
            $hoursInDay = 24;
            $minutesInHour = 60;
            $secondsInMinute = 60;
            $secondsInYear = $daysInYear * $hoursInDay * $minutesInHour * $secondsInMinute;

            echo number_format($secondsInYear, 0, '.', ',') . ' seconds in a year';
             ?>
         </h2>

    </body>
</html>
