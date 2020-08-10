<?php
require("../mysql.php");
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $carname = $_GET["Fullcar"];
    $stmt = $mysql->prepare("SELECT * FROM carlist WHERE Fullcar = '$carname'");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
    ?>
        <form action="carlist.php" action="post">
            <p>Autoname<input type="text" name="carname" id="" value="<?php echo $carname ?>"></p>
            <p>Motor-1<input type="number" name="ps1" id="" value="<?php echo $row["HP1"] ?>"></p>
            <p>Motor-2<input type="number" name="ps2" id="" value="<?php echo $row["HP2"] ?>"></p>
            <p>Motor-3<input type="number" name="ps3" id="" value="<?php echo $row["HP3"] ?>"></p>
            <p>Motor-4<input type="number" name="ps4" id="" value="<?php echo $row["HP4"] ?>"></p>
            <p>Kraftstoff<select name="kraftstoff" id="kraftstoff">
                    <?php
                    if ($row["Kraftstoff"] == "-1") {
                    ?>
                        <option value="-1">Unbekannt</option>
                        <option value="diesel">Diesel</option>
                        <option value="benzin">Benzin</option>
                    <?php
                    } else if ($row["Kraftstoff"] == "Benzin") {
                    ?>
                        <option value="benzin">Benzin</option>
                        <option value="-1">Unbekannt</option>
                        <option value="diesel">Diesel</option>
                    <?php
                    } else if ($row["Kraftstoff"] == "Diesel") {
                    ?>
                        <option value="diesel">Diesel</option>
                        <option value="-1">Unbekannt</option>
                        <option value="benzin">Benzin</option>
                    <?php
                    }
                    ?>
                </select></p>

                <p>Kofferraum<input type="number" name="kofferraum" id="" value="<?php echo $row["Kofferraum"] ?>"></p>
                <p>Kategorie<input type="text" name="kategorie" id="" value="<?php echo $row["Kategorie"] ?>"></p>

            <p>Sitzanzahl<input type="number" name="sitzanzahl" id="" value="<?php echo $row["Sitzanzahl"] ?>"></p>
            <p>Tank/Liter<input type="number" name="tank" id="" value="<?php echo $row["Tank"] ?>"></p>
            <p>Max. Geschwindigkeit<input type="number" name="geschwindigkeit" id="" value="<?php echo $row["Geschwindigkeit"] ?>"></p>
            <p>Bildlink (StateV Link)<input type="text" name="bild" id="" value="<?php echo $row["Bilds"] ?>"></p>
            <input type="submit" value="Ändern" name="edit_submit">
        </form>
    <?php
    }
    ?>
</body>

</html>