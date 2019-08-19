<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>For Loop 1-100</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <?php
        // for($i = 0; $i <= 100; $i += 2) {
        //     echo $i.'<br />';
        // }

        // for($j = 0; $j <= 100; $j++) {
        //     if ($j % 2 === 0) {
        //         echo $j.'<br />';
        //     }
        // }

        $oneHundred = array();

        for($k = 0; $k <=100; $k += 2) {
            array_push($oneHundred, $k);
        }

        // foreach($array AS $value)
        foreach($oneHundred as $even) {
            echo $even.'<br />';
        }
        ?>

    </body>
</html>
