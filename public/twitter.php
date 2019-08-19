<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Clean Twitter Handles</title>
        <style media="screen">
            body {
                font-family: sans-serif;
            }
        </style>
    </head>

    <!-- Formatting Twitter handle
    Create a function that takes Twitter username in any form, e.g.:

    oliward → @oliward

    @MR_BUBBLES → @mr_bubbles

    @hashtag%warrior → @hashtagwarrior

    Format and return in form '@oliward' (lowercase)

    Hint: see PHP's built-in strtolower() function and str_replace() -->

    <body>

        <h2>Cleaned Twitter Handles</h2>
        <?php

        $testHandles = [
            'jonathansmithies',
            '@MY_SMITHIES',
            '@hashtag%warrior',
            '@toomany@s',
            'galFJAO[]I420',
            'Jonathan_Smithies',
            'Winter-moon☾',
            'https://twitter.com/oliward',
            'http://twitter.com/@oliward',
            'https://twitter.com/oliward#home'
        ];

        function twitterCleaner($username) {
            // define URL prefix
            $prefixURL = [
                'https://twitter.com',
                'http://twitter.com',
                'https://www.twitter.com',
                'http://www.twitter.com'
            ];
            // remove URL prefix
            $username = str_replace($prefixURL, '', $username);
            // define URL suffix
            $suffixURL = '/\#.*/';
            // remove URL suffix
            $username = preg_replace($suffixURL, '', $username);
            // define allowed twitter handle chars
            $whitelist = '/[^a-zA-Z0-9_]/';
            // remove characters not in whitelist
            $username = '@'.substr(strtolower(preg_replace($whitelist, '', $username)),0,15);

            return $username;
        }

        // run test cases
        foreach($testHandles as $testUsername) {
            $cleanedHandle = twitterCleaner($testUsername);

            echo $testUsername;
            echo '  &#187;  ';
            echo $cleanedHandle;
            echo '<br />';
        }

        ?>

        <ul>
            <?php
            // display cleaned twitter handles
            foreach($testHandles as $username) {
                echo '<li>'.twitterCleaner($username).'</li>';
            }
            ?>
        </ul>

    </body>
</html>
