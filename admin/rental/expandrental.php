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

<body id="expandrental_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main>
        <?php
        require("../mysql.php");
        if (isset($_POST["expand_vertrag_first"])) {
            if ($_POST["days"] >= 7) {
                header("location: informations.php?ID=$_POST[carid]");
            } else {
                if ($_POST["days"] == 0 && $_POST["weeks"] == 0) {
                    header("location: informations.php?ID=$_POST[carid]");
                } else {
                    $until = $mysql->prepare("SELECT * FROM memberrental WHERE CARID = $_POST[carid]");
                    $until->execute();
                    $beginSetter;
                    $endSetter;
                    $endDatum;
                    $otd;
                    while ($untilRow = $until->fetch()) {
                        $beginnDatum = $untilRow["LENTTO"];
                        $beginSetter = date("d.m.y", $beginnDatum);
                        $daysValue = $_POST["days"] + ($_POST["weeks"] * 7);
                        $endDatum = $untilRow["LENTEND"] + ($daysValue * (3600 * 24));
                        $endSetter = date("d.m.y", $endDatum);

                        $otd = $untilRow["OTD"] + $daysValue;
                    }
                    $vertragCarmieteVerlängerung = "BLA BLA BLA\n$_POST[id]\nBLA BLA BLA\n$beginSetter\nBLA BLA BLA $endSetter BLA BLA BLA";

                    $payment;
                    $stmtPrices = $mysql->prepare("SELECT * FROM rental WHERE ID=$_POST[carid]");
                    $stmtPrices->execute();
                    while ($setPriceRow = $stmtPrices->fetch()) {
                        $dayprice = $setPriceRow["DAYT"];
                        $weekprice = $setPriceRow["WEEK"];
                        $days = $_POST["days"];
                        $weeks = $_POST["weeks"];
                        $insDays = $dayprice * $days;
                        $insWeeks = $weekprice * $weeks;
                        $rabatt = (100 -  $_POST["rabatt"]) / 100;
                        $payment = ($insDays + $insWeeks) * $rabatt;
                        $inspay = $_POST["payment"] + $payment;
                    }
                    echo "<form method=\"post\" action=\"index.php\">\n";
                    echo "<section>";
                    echo "<input type=\"number\" style=\"display: none\" name=\"carid\" readonly value=\"$_POST[carid]\">\n";
                    echo "<input type=\"text\" style=\"display: none\" name=\"id\" readonly value=\"$_POST[id]\">\n";
                    echo "<input type=\"text\" style=\"display: none\" name=\"besitzer\" readonly value=\"$_POST[besitzer]\">\n";
                    echo "<p class=\"infotext\">Angegebener Rabatt: <input type=\"number\" name=\"rabatt\" readonly value=\"$_POST[rabatt]\">%</p>\n";
                    echo "<input type=\"number\" style=\"display: none\" name=\"enddate\" readonly value=\"$endDatum\">\n";
                    echo "<input type=\"number\" style=\"display: none\" name=\"inspayment\" readonly value=\"$inspay\">\n";
                    echo "<p class=\"infotext\">Neupay: <input type=\"number\" name=\"payment\" readonly value=\"$payment\"></p>\n";
                    echo "<p class=\"infotext\">Tage insgesamt gemietet: <input type=\"number\" name=\"otd\" readonly value=\"$otd\"></p>\n";
                    echo "<p class=\"infotext\">Tage hinzufügen: <input type=\"number\" value=\"$_POST[days]\" readonly name=\"days\"></p>";
                    echo "<p class=\"infotext\">Wochen hinzufügen: <input type=\"number\" value=\"$_POST[weeks]\" readonly name=\"weeks\"></p>";
                    echo "</section>";
                    echo "<p id=\"vertragP\">Vertrag:</p>";
                    ?>
                        <textarea cols="45" rows="15" readonly><?php echo $vertragCarmieteVerlängerung; ?></textarea>
                    <?php
                    
                    echo "<p class=\"pay\">Kunde zahlt $$payment auf der VBAN 123 456</p>";
                    echo "<p class=\"pay\">Kunde hat bezahlt und Vertrag wurde bestätigt <input type=\"checkbox\" required></p>";
                    echo "<p><input type=\"submit\" name=\"expand_car\" readonly value=\"Auto verleihen\"></p>";
                    echo "</form>";
                }
            }
        }
        ?>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>