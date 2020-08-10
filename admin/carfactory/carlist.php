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
    <link rel="stylesheet" href="style/carlist.css">
</head>

<body>
    <table>
        <tr>
            <th>Autoname</th>
            <th>PS1</th>
            <th>PS2</th>
            <th>PS3</th>
            <th>PS4</th>
            <th>Kategorie</th>
            <th>Kraftstoff</th>
            <th>Sitzanzahl</th>
            <th>Tank</th>
            <th>Geschwindigkeit</th>
            <th>Bild</th>
            <th>Bearbeiten</th>
        </tr>
        <tr>
            <form action="carlist.php" method="POST">
                <td><input type="text" name="carname" id="" style="width: 9vw;" required></td>
                <td><input type="text" name="ps1" id="" style="width: 3vw;" required value="0"></td>
                <td><input type="text" name="ps2" id="" style="width: 3vw;" required value="0"></td>
                <td><input type="text" name="ps3" id="" style="width: 3vw;" required value="0"></td>
                <td><input type="text" name="ps4" id="" style="width: 3vw;" required value="0"></td>
                <td><input type="text" name="kategorie" id="" style="width: 6vw;" required value="0"></td>
                <td><input type="text" name="kraftstoff" id="" style="width: 4vw;" required value="-1"></td>
                <td><input type="text" name="sitzanzahl" id="" style="width: 4vw;" required></td>
                <td><input type="text" name="tank" id="" style="width: 4vw;" required value="-1"></td>
                <td><input type="text" name="geschwindigkeit" id="" style="width: 9vw;" required value="-1"></td>
                <td><input type="text" name="bild" id="" style="width: 27vw;" required></td>
                <td><input type="submit" name="addcar" value="Hinzufügen" style="width: 9vw;" required></td>
            </form>
        </tr>
        <?php
        if (isset($_POST["addcar"])) {
            $fullcar = $_POST["carname"];
            $seach = $mysql->prepare("SELECT * FROM carlist WHERE Fullcar = '$fullcar'");
            $count = $seach->rowCount();
            if ($count == 0) {
                $insert = $mysql->prepare("INSERT INTO carlist (Fullcar, HP1, HP2, HP3, HP4, Kategorie, Kraftstoff, Sitzanzahl, Tank, Geschwindigkeit, Bilds) VALUES (:car, :hp1, :hp2, :hp3, :hp4, :kategorie, :kraftstoff, :sitzanzahl, :tank, :geschwindigkeit, :bild)");
                $insert->bindParam(":car", $fullcar);
                $insert->bindParam(":hp1", $_POST["ps1"]);
                $insert->bindParam(":hp2", $_POST["ps2"]);
                $insert->bindParam(":hp3", $_POST["ps3"]);
                $insert->bindParam(":hp4", $_POST["ps4"]);
                $insert->bindParam(":kategorie", $_POST["kategorie"]);
                $insert->bindParam(":kraftstoff", $_POST["kraftstoff"]);
                $insert->bindParam(":sitzanzahl", $_POST["sitzanzahl"]);
                $insert->bindParam(":tank", $_POST["tank"]);
                $insert->bindParam(":geschwindigkeit", $_POST["geschwindigkeit"]);
                $insert->bindParam(":bild", $_POST["bild"]);
                $insert->execute();
                header("location: carlist.php");
            }
        }
        ?>
        <?php
        if (isset($_GET["edit_submit"])) {
            $fullcar = $_GET["carname"];
            $hp1 = $_GET["ps1"];
            $hp2 = $_GET["ps2"];
            $hp3 = $_GET["ps3"];
            $hp4 = $_GET["ps4"];
            $kraftstoff = $_GET["kraftstoff"];
            $sitzanzahl = $_GET["sitzanzahl"];
            $kofferraum = $_GET["kofferraum"];
            $kategorie = $_GET["kategorie"];
            $tank = $_GET["tank"];
            $geschwindigkeit = $_GET["geschwindigkeit"];
            $bild = $_GET["bild"];
            $upstmt = $mysql->prepare("UPDATE `carlist` SET `Fullcar`='$fullcar', `HP1`=$hp1, `HP2`=$hp2, `HP3`=$hp3, `HP4`=$hp4, `Kraftstoff`='$kraftstoff', `Sitzanzahl`=$sitzanzahl, `Kofferraum`=$kofferraum, `Kategorie`='$kategorie', `Tank`=$tank, `Geschwindigkeit`=$geschwindigkeit, `Bilds`='$bild' WHERE `Fullcar`='$fullcar'");
            $upstmt->execute();
            header("location: carlist.php");
        }
        ?>
        <?php
        $stmt = $mysql->prepare("SELECT * FROM carlist");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>$row[Fullcar]</td>";
            echo "<td>$row[HP1]</td>";
            echo "<td>$row[HP2]</td>";
            echo "<td>$row[HP3]</td>";
            echo "<td>$row[HP4]</td>";
            echo "<td>$row[Kategorie]</td>";
            echo "<td>$row[Kraftstoff]</td>";
            echo "<td>$row[Sitzanzahl]</td>";
            echo "<td>$row[Tank]</td>";
            echo "<td>$row[Geschwindigkeit]</td>";
            echo "<td>$row[Bilds]</td>";
            echo "<td><a href=\"edit.php?Fullcar=$row[Fullcar]\">Bearbeiten</a></td>";

            echo "</tr>";
        }

        ?>
    </table>

</body>

</html>