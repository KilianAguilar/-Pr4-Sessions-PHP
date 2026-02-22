<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    session_start();
    if (isset($_SESSION['numbers'])) {
        $numbers = $_SESSION['numbers'];
    } else {
        $numbers = array(10, 20, 30);
        $_SESSION['numbers'] = $numbers;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['mod'])) {
            $position = $_POST['position'];
            $newValue = $_POST['newValue'];

            if ($position == 1) {
                $numbers[0] = $newValue;
            } else if ($position == 2) {
                $numbers[1] = $newValue;
            } else if ($position == 3) {
                $numbers[2] = $newValue;
            }
        }
        if (isset($_POST['avg'])) {

            $media = array_sum($numbers);
            $count = count($numbers);
            $avg = $media / $count;
            echo $avg;
        }
        if (isset($_POST['reset'])) {
            session_unset();
            $numbers = array(10, 20, 30);
            $_SESSION['numbers'] = $numbers;
        }
    }

    ?>

    <form method="POST">
        <a>Position to modify:</a>
        <select name="position">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <br>
        <br>
        New value: <input type="number" name="newValue">
        <input type="submit" value="Submit">

        <br>
        <button type="submit" name="mod">Mod</button>
        <button type="submit" name="avg">Avg</button>
        <button type="submit" name="reset">Reset</button>
    </form>

    <?php
    echo "<br>";
    echo "<br>";
    echo "Current Array: " . implode(", ", $numbers) . "<br><br>";

    ?>
</body>

</html>