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
    <link rel="stylesheet" href="../style/style_all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body id="informations_body">
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
        if ($row = $bestmt->fetch()) {
            if ($row["ISRENTAL"] != 0) {

                // informations
                $playerstmt = $mysql->prepare("SELECT * FROM memberrental WHERE CARID=$_GET[ID]");
                $playerstmt->execute();
                while ($rowUser = $playerstmt->fetch()) {
                    $beginnDatum = $rowUser["LENTTO"];
                    $beginSetter = date("d.m.y", $beginnDatum);
                    $daysToAdd = $rowUser["OTD"];
                    $enddatum = $beginnDatum + ($daysToAdd * (3600 * 24));
                    $endSetter = date("d.m.y", $enddatum);
                    echo "<div class=\"infos\">";
                    echo "<p>Gezahlt: $rowUser[USERPAYMENT]$</p>";
                    echo "<p>Rabatt: $rowUser[DISCOUNT]%</p>";
                    echo "<p>Kunde: $rowUser[USERID]</p>";
                    echo "<p>Autobesitzer: $row[BESITZER]</p>";
                    echo "<p>Kennzeichen: $row[MARK]</p>";
                    echo "<p>Autoname: $row[CARNAME]</p>";
                    echo "<p>Laufzeit insgesamt: Wochen: $rowUser[WEEKPRICE], Tage: $rowUser[DAYPRICE]</p>";
                    echo "<p>Vertrag endet am: $endSetter</p>";
                    echo "</div>";
                    // kill
                    if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == ADMIN) {
                        echo "<form method=\"post\" action=\"index.php\" class=\"kill\">\n";
                        echo "<input type=\"number\" name=\"id\" readonly value=\"$rowUser[ID]\" style=\"display: none\">\n";
                        echo "<input type=\"number\" name=\"carid\" readonly value=\"$rowUser[CARID]\" style=\"display: none\">\n";
                        $userid = $rowUser["USERID"];
                        $besitzer = $row["BESITZER"];
                        $member = $mysql->prepare("SELECT * FROM member WHERE spielername = '$userid'");
                        $member->execute();
                        while ($memberinfos = $member->fetch()) {
                            $vban = $memberinfos["vban"];
                            echo "<br>VBAN für die Kaution: $vban";
                        }
                        echo "<br>Schlüssel zurückbekommen <input type=\"checkbox\" required>";
                        echo "<br>Kaution (750$) zurückbezahlt <input type=\"checkbox\" required>";
                        echo "<br><br><input type=\"submit\" name=\"kill_vertrag\" readonly value=\"Vertrag kündigen\">\n";
                        echo "</form>\n";
                    }
                    // expandrental
                    echo "<form method=\"post\" action=\"expandrental.php\" class=\"expand\"></p>\n";
                    echo "<input type=\"number\" name=\"carid\" readonly value=\"$rowUser[CARID]\" style=\"display: none\">\n";
                    echo "<input type=\"text\" name=\"id\" readonly value=\"$userid\" style=\"display: none\">\n";
                    echo "<input type=\"text\" name=\"besitzer\" readonly value=\"$besitzer\" style=\"display: none\">\n";
                    echo "<input type=\"text\" name=\"payment\" readonly value=\"$rowUser[USERPAYMENT]\" style=\"display: none\">\n";   
                    echo "<p>Tage verlängern: <input type=\"number\" name=\"days\" value=\"0\"></p>\n";
                    echo "<p>Wochen verlängern: <input type=\"number\" name=\"weeks\" value=\"0\"></p>\n";
                    echo "<p>Rabatt: <input type=\"number\" name=\"rabatt\" value=\"0\">%</p>\n";
                    echo "<input type=\"submit\" name=\"expand_vertrag_first\" readonly value=\"Vertrag verlängern\">\n";
                    echo "</form>\n";
                }
            } else {
                echo "Das Auto ist momentan nicht verliehen!";
            }
        } else
            echo "Fehler: Matrikelnummer $_GET[ID] nicht vorhanden\n";
        ?>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>