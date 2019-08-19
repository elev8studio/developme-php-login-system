
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Calculator</title>
        <style media="screen">
        body {
            font-family: sans-serif;
            background: #222;
            color: white;
            padding: 15px 30px;
        }

        input {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background: darkorange;
            color: white;
        }
        </style>
    </head>
    <body>
        <?php

        $number1 = '0';
        $number2 = '0';
        $output = '?';
        $operator = '';

        if ($_POST) {
            // $number1 = $_POST['number1'];
            // $number2 = $_POST['number2'];
            $operator = $_POST['operator'];

            $opArr = [
                'add' => '+',
                'subtract' => '-',
                'multiply' => 'x',
                'divide' => '&divide;',
                'power' => '^',
                'remainder' => '%'
            ];

            $number1 == '' ? $number1 = 0 : $number1 = $_POST['number1'];
            $number2 == '' ? $number2 = 0 : $number2 = $_POST['number2'];


            // if (($number1 != "") && ($number2 != "")) {
            switch ($operator) {
                case 'add':
                    $output = ($number1 + $number2);
                    break;
                case 'subtract':
                    $output = ($number1 - $number2);
                    break;
                case 'multiply':
                    $output = ($number1 * $number2);
                    break;
                case 'divide':
                    $output = ($number1 / $number2);
                    break;
                case 'power':
                    $output = pow($number1, $number2);
                    break;
                case 'remainder':
                    $output = ($number1 % $number2);
                    break;
            }

            $number1 = $output;
            $number2 = $number2;
        }

        ?>

        <h2>Calculator</h2>

        <form action="" method="post">
            <input type="text" name="number1" value="<?php echo $number1 ?>">
            <select id="operator" name="operator">
                <option <?php if ($operator == 'add') {
            echo 'selected';
        } ?> value="add">+</option>
                <option <?php if ($operator == 'subtract') {
            echo 'selected';
        } ?> value="subtract">-</option>
                <option <?php if ($operator == 'multiply') {
            echo 'selected';
        } ?> value="multiply">x</option>
                <option <?php if ($operator == 'divide') {
            echo 'selected';
        } ?> value="divide">&divide;</option>
                <option <?php if ($operator == 'power') {
            echo 'selected';
        } ?> value="power">^</option>
                <option <?php if ($operator == 'remainder') {
            echo 'selected';
        } ?> value="remainder">%</option>
            </select>
            <input type="text" name="number2" value="<?php echo $number2 ?>">
            <input type="submit" name="calculate" value="Calculate">
            <span style="font-size: 20px;"> = <?php echo number_format($output, '2', '.', ',') ?></span>
        </form>
    </body>
</html>
