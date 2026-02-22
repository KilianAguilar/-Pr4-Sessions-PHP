<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Supermarket managment</title>
</head>

<body>

    <?php
    session_start();

    if (isset($_POST['trabajador']) && $_POST['trabajador'] != "") {
        $_SESSION['trabajador'] = $_POST['trabajador'];
    }
    if (isset($_SESSION['trabajador'])) {
        $trabajador = $_SESSION['trabajador'];
    } else {
        $trabajador = "";
    }


    if (!isset($_SESSION['inventario'])) {
        $_SESSION['inventario'] = array("leche" => 0, "refresco" => 0);
    }
    $inventario = $_SESSION['inventario'];


    if (isset($_POST['add'])) {
        if ($_POST['cantidad'] == "" || $_POST['cantidad'] < 0) {
            echo "Pon una cantidad valida<br>";
        } else {
            $inventario[$_POST['producto']] = $inventario[$_POST['producto']] + $_POST['cantidad'];
        }
    }


    if (isset($_POST['remove'])) {

        if ($_POST['cantidad'] == "" || $_POST['cantidad'] < 0) {
            echo "Pon una cantidad valida</p>";
        } else if ($_POST['cantidad'] > $inventario[$_POST['producto']]) {
            echo "ERROR: no puedes quitar más de lo que hay</p>";
        } else {
            $inventario[$_POST['producto']] = $inventario[$_POST['producto']] - $_POST['cantidad'];
        }
    }



    if (isset($_POST['reset'])) {
        session_unset();
        $_SESSION['inventario'] = array("leche" => 0, "refresco" => 0);
        $inventario = $_SESSION['inventario'];
    }

    $_SESSION['inventario'] = $inventario;



    ?>

    <form method="POST">

        <h2>Supermarket management</h2>
        <h3>Worker name: </h3>
        <input type="text" name="trabajador">

        <h3>Choose product: </h3>

        <select name="producto">
            <option value="leche">Leche</option>
            <option value="refresco">Refresco</option>
        </select>

        <h3>Product Quantity: </h3>

        <input type="number" name="cantidad">
        <br><br>
        <button type="submit" name="add">add</button>
        <button type="submit" name="remove">remove</button>
        <button type="submit" name="reset">Reset</button>

        <h3>Inventory: </h3>

    </form>

    <?php
    echo "Trabajador actual: $trabajador" . "<br>";;
    echo "Leche: " . $inventario["leche"] . "<br>";
    echo "Refresco: " . $inventario["refresco"] . "<br>";

    ?>

</body>

</html>