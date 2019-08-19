<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Format Credit Card Numbers</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
    <!-- Formatting credit card numbers
    Create a function that takes CC numbers in any form, e.g.:
    41112222333344445
    4111 2222 3333 4444
    4111x2222x3333x4444
    4111-2222-3333-4444
    4111-2222-3333-4444-5555
    Format and return in form '4111-2222-3333-4444'
    Hint: see PHP's built-in substr() function -->

        <h2>Credit Card Numbers</h2>

        <?php

        $testCards = [
            '41112222333344445',
            '4111 2222 3333 4444',
            '4111x2222x3333x4444',
            '4111-2222-3333-4444',
            '4111-2222-3333-4444-5555'
        ];

        function formatCC($ccNum) {
            // define allowed characters
            $digits = '/[^0-9]/';
            // remove disallowed characters and shorten to max 16 characters
            $ccNum = substr(preg_replace($digits, '', $ccNum),0,16);
            // split string every 4 characters and turn into an array
            // then glue back together with ' '
            $ccNum = implode('-', str_split($ccNum, 4));
            return $ccNum;
        };

        // run test cases
        foreach($testCards as $testCard) {
            $formattedCC = formatCC($testCard);

            echo $testCard;
            echo '  &#187;  ';
            echo $formattedCC;
            echo '<br />';
        }

        ?>

        <ul>
            <?php
            // display formatted cc numbers
            foreach($testCards as $card) {
                echo '<li>'.formatCC($card).'</li>';
            }
            ?>
        </ul>

    </body>
</html>
