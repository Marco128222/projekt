<?php

session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}

require("../rankmanager.php");
require("../mysql.php");
$checkaccount = $mysql->prepare("SELECT ID FROM banking WHERE INHABER = '$userLogin'");
$checkaccount->execute();
if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != CARADMIN && getRank($userLogin) != ADMIN) {
    while ($row = $checkaccount->fetch()) {
        if ($_GET["ID"] != $row["ID"]) {
            header("location: index.php");
        }
    }
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

<body id="account_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main class="main">
        <div class="konto_section">
            <?php
            require("../mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM banking WHERE ID=$_GET[ID]");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $pay_format = number_format($row["GUTHABEN"], 2, '.', ',');
                $vban_format = number_format($row["VBAN"], 0, '', ' ');
            ?>
                <div id="infos">
                    <p>
                        <?php echo $row["INHABER"] ?>
                    </p>
                    <p id="guthaben">
                        <?php echo "$" . $pay_format ?>
                    </p>
                    <p>
                        <?php echo "VBAN des Kontoinhabers: " . $vban_format ?>
                    </p>
                </div>

                <?php
                if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == CARADMIN || getRank($userLogin) == ADMIN) {
                    echo "<a href=\"withdraw.php?ID=$row[ID]\">" ?><p class="abheben">GELD ABHEBEN</p></a>
                <?php
                } else {
                ?>
                    <p class="abheben" style="text-align: center;">DU KANNST KEIN GELD ABHEBEN<br>MELDE DICH BEI EINEM SYSTEMADMIN</p>
                <?php
                }
                ?>

                <div class="verwendungen">
                    <table>
                        <?php
                        $stmt = $mysql->prepare("SELECT * FROM banktransaction WHERE KONTOID=$_GET[ID] ORDER BY DATUM DESC");
                        $stmt->execute();
                        echo "<tr>";
                        echo "<td>Datum</th>";
                        echo "<td>Von</th>";
                        echo "<td>Zu</th>";
                        echo "<td>Überweisungszweck</th>";
                        echo "<td>Betrag</th>";
                        echo "</tr>";
                        while ($row = $stmt->fetch()) {
                            echo "<tr>";
                            $datum_db = date("d.m.Y - H:i", $row["DATUM"]);
                            echo "<th>$datum_db</th>";
                            echo "<th>$row[VONBANK]</th>";
                            echo "<th>$row[ZUBANK]</th>";
                            echo "<th>$row[ZWECK]</th>";
                            $minusmoney = number_format($row["BETRAG"], 2, '.', ',');
                            if ($row["MINUSORNOT"] == 1) {
                                echo "<th style=\"color: red\">- $$minusmoney</th>";
                            } else {
                                echo "<th style=\"color: green\">+ $$minusmoney</th>";
                            }

                            echo "</tr>";
                        }
                        ?>
                    </table>

                </div>
            <?php
            }
            ?>
        </div>
    </main>

    <?php
    if (isset($_GET["withdrawSubmit"])) {
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == CARADMIN || getRank($userLogin) == ADMIN) {
            echo "Geld erfolgreich abgehoben";
            $system = "SYS-" . $_GET["ID"];
            $minusornot = 1;
            $time = time();
            $zweck = "$userLogin hat auf das hinterlegte Firmenkonto überwiesen. [GRANDBANKS AUSZAHLUNG]";
            $abmt = $mysql->prepare("INSERT INTO banktransaction (KONTOID, VONBANK, ZUBANK, BETRAG, DATUM, ZWECK, MINUSORNOT, GETUSER) VALUES (:kontoid, :von, :zu, :betrag, :datum, :zweck, :minusornot, :getuser)");
            $abmt->bindParam(":kontoid", $_GET["ID"]);
            $abmt->bindParam(":von", $system);
            $abmt->bindParam(":zu", $_GET["VBAN"]);
            $abmt->bindParam(":betrag", $_GET["validguthaben"]);
            $abmt->bindParam(":datum", $time);
            $abmt->bindParam(":zweck", $zweck);
            $abmt->bindParam(":minusornot", $minusornot);
            $abmt->bindParam(":getuser", $userLogin);
            $abmt->execute();

            $bankaccount = $mysql->prepare("SELECT * FROM banking WHERE ID = $_GET[ID]");
            $bankaccount->execute();
            while ($bankrow = $bankaccount->fetch()) {
                $bankkonto = $bankrow["GUTHABEN"];
                $bankminus = $bankkonto - $_GET["validguthaben"];
                if ($bankminus >= 0) {
                    $update = $mysql->prepare("UPDATE banking SET `GUTHABEN`=$bankminus WHERE ID = $_GET[ID]");
                    $update->execute();
                } else {
                    echo "Dein Bankguthaben ist nicht ausreichend gedeckt!";
                }
            }

            $id = $_GET["ID"];
            header("location: account.php?ID=$id");
        }
    }

    ?>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>