<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != RENTALMOD && getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style_all.css">
</head>

<body id="rentalsetinput_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main>
        <?php
        require("../mysql.php");
        $bestmt = $mysql->prepare("SELECT * FROM rental WHERE ID=$_GET[ID]");
        $bestmt->execute();
        $until = $mysql->prepare("SELECT * FROM memberrental WHERE CARID =$_GET[ID]");
        $until->execute();
        $beginSetter;
        $endSetter;
        while ($untilRow = $until->fetch()) {
            $beginnDatum = $untilRow["LENTTO"];
            $beginSetter = date("d.m.y", $beginnDatum);
            $daysToAdd = $untilRow["OTD"];
            $enddatum = $beginnDatum + ($daysToAdd * (3600 * 24));
            $endSetter = date("d.m.y", $enddatum);
        }
        if ($row = $bestmt->fetch()) {
            if ($row["ISRENTAL"] == 0) {
                echo "<form method=\"post\" action=\"rentalsubmitter.php\">";
                echo "<p><input type=\"number\" style=\"display: none\" name=\"id\" readonly value=\"$row[ID]\"></p>";
                echo "<p>Kennzeichen: <input type=\"text\" name=\"mark\" readonly value=\"$row[MARK]\"></p>";
                echo "<p>Autoname: <input type=\"text\" name=\"carname\" readonly value=\"$row[CARNAME]\"></p>";
                echo "<p>Rabatt: <input type=\"number\" name=\"discount\" value=\"$row[DISCOUNT]\">%</p>";
                echo "<p>Kundenname: <input type=\"text\" name=\"rentuser\" value=\"Vorname_Nachname\"><span>*Der Kunde muss im System hinterlegt sein!</span></p>";
                echo "<p>Tage ausgeliehen: <input type=\"number\" name=\"days\" value=\"0\"></p>";
                echo "<p>Wochen ausgeliehen: <input type=\"number\" name=\"weeks\" value=\"0\"></p>";
                echo "<p><input type=\"submit\" name=\"subRentsetter\" value=\"Auto verleihen\"></p>";
                echo "</form>";
            } else {
                echo "<p id=\"alreadyrent\">Das Auto ist noch bis zum $endSetter vermietet.</p>";
            }
        } else {
        }
        ?>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>