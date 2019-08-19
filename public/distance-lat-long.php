<?php

$lat1 = 51.4429178;
$lon1 = -2.5693264;
$lat2 = 51.4411688;
$lon2 = -2.6022332;

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) and ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = number_format(($dist * 60 * 1.1515), 2, '.', '.');
        $unit = strtoupper($unit);

        return $miles;
    }
}

echo 'It\'s '.distance(51.4429178, -2.5693264, 51.4411688, -2.6022332, "M").' miles from the DevelopMe space to The Hare Pub<br>';

?>
