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

    if (isset($_POST["edit"])) {
        $status = $_POST["status"];
        $id = $_POST["ID"];
        $update = $mysql->prepare("UPDATE ordernumber SET baustatus='$status' WHERE ID=$id");
        $update->execute();
        header("location: contractlist.php");
    }


    $stmt = $mysql->prepare("SELECT * FROM ordernumber ORDER BY baustatus DESC");
    $stmt->execute();

    echo "<table>";
    echo "<tr>";
    echo "<th>Auftragsnummer</th>";
    echo "<th>Kunde</th>";
    echo "<th>Bearbeiter</th>";
    echo "<th>Autoname</th>";
    echo "<th>Motor angezahlt</th>";
    echo "<th>Rubine dazugegeben</th>";
    echo "<th>Diamanten dazugegeben</th>";
    echo "<th>Status</th>";
    echo "<th>Editieren</th>";
    echo "</tr>";

    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>$row[auftrag]</td>";
        echo "<td>$row[spielername]</td>";
        echo "<td>$row[bearbeiter]</td>";
        echo "<td>$row[Autoname]</td>";
        echo "<td>$row[maxmotor]</td>";
        echo "<td>$row[playerrubys]</td>";
        echo "<td>$row[playerdiamonds]</td>";
        if ($row["baustatus"] == "status1") {
            echo "<td>offen</td>";
        } else  if ($row["baustatus"] == "status2") {
            echo "<td>Warte auf Motor</td>";
        }
        else if ($row["baustatus"] == "status3") {
            echo "<td>Warteschlange</td>";
        }
        else if ($row["baustatus"] == "status4") {
            echo "<td>In Bau</td>";
        }
        else if ($row["baustatus"] == "status5") {
            echo "<td>Abholbereit</td>";
        }
        else if ($row["baustatus"] == "status6") {
            echo "<td>Abgeschlossen</td>";
        }
        echo "<td><a href=\"contractedit.php?ID=$row[ID]\">Edit</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>