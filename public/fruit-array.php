<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Fruit Array</title>
    </head>
    <body>
        <?php
        $fruit = [
        	'green' => 'apple',
        	'yellow' => 'banana',
        	'red' => 'raspberry'
        ];
        foreach($fruit AS $colour => $type_of_fruit) {
            echo $type_of_fruit . 's are ' . $colour . '<br />';
        }
        ?>
    </body>
</html>
