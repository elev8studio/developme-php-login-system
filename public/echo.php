<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Echo</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <h2><?php echo 'If you shoot for the moon, even if you miss, you\'ll land among the stars! ' . 'Fly man, fly!' ?></h2>

        <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' ?></p>

        <?php
        $type_of_fruit = 'apples';
        echo 'I would like some ' . $type_of_fruit . ' please';
        echo "I would like some $type_of_fruit please";
        ?>
    </body>
</html>
