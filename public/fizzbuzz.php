<?php
// Write a script that prints the numbers from 1 to 100. For multiples of 3, print "Fizz" instead of the number. For multiples of 5, print "Buzz". For numbers which are multiples of both 3 and 5, print "FizzBuzz".

// Then, complete PHP Fizz Buzz in fewest characters.

for ($i = 1; $i <= 100; $i++) {
    $n = '';
    if ($i % 3 == 0) {
        $n .= 'Fizz';
    }
    if ($i % 5 == 0) {
        $n .= 'Buzz';
    }
    echo(($n === '' ? $i : $n).'<br>');
}
?>
