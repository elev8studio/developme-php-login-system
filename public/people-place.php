<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Where do we live?</title>
        <style media="screen">
            body {
                font-family: sans-serif;
                line-height: 22px;
            }
        </style>
    </head>
    <body>
        <?php
        function dd($var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
            die();
        }

        $homeTown = [
            'Oli' => 'Bedminster',
            'Jess' => 'Weston-Super-Mare',
            'Alys' => 'Windmill Hill',
            'Jonathan' => 'Clifton',
            'Sasha' => 'Hanham',
            'Jack' => 'Clifton'
        ];
        // sort array in ascending order by key
        ksort($homeTown);

        dd($homeTown);
        
        ?>
        <h2>Places we live:</h2>
        <ul>
            <?php
            // foreach($array AS $key => $value)
            foreach($homeTown AS $name => $town) {
                echo "<li> $name lives in $town </li>";
            }
            ?>
        </ul>

        <?php
        $placesToPeople = [
        	'Bedminster' => ['Oli', 'Sid', 'Rowley'],
        	'Weston-Super-Mare' => ['Jess', 'Paul'],
        	'Windmill Hill'	=> ['Alys'],
        	'Hanham' => ['Sasha']
        ];
        ?>
        ​
        <ul>
            <?php
            // foreach($array AS $key => $value){
            foreach($placesToPeople AS $place => $people){
            	foreach($people AS $person){
            		echo '<li>'.$person.' lives in '.$place.'</li>';
            	}
            }

            dd($placesToPeople);
            ?>


        </ul>
    </body>
</html>
