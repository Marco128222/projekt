<?php

session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
require("../mysql.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style_all.css">
</head>

<body id="rental_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <main class="fullpage">
        <form action="index.php" method="get" id="formular">
            <input id="carnames" type="text" name="carname" placeholder="Autoname" required>
            <input id="dayprice" type="number" name="dayprice" placeholder="dayprice" required>
            <input id="weekprice" type="number" name="weekprice" placeholder="weekprice" required>
            <input id="kennzeichen" type="text" name="kennzeichen" placeholder="kennzeichen" required>
            <input id="besitzer" type="text" name="besitzer" placeholder="besitzer" required>
            <input id="image" type="text" name="image" placeholder="image" required>
            <select name="hp" id="hp" required>
                <option value="o4">4. Stufe</option>
                <option value="o3">3. Stufe</option>
                <option value="o2">2. Stufe</option>
                <option value="o1">1. Stufe</option>
            </select>
            <input type="submit" value="Bestätigen" name="submit">
        </form>
        <?php

        // list of all rental cars
        $stmtTop = $mysql->prepare("SELECT * FROM rental");
        $stmtTop->execute();
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>AUTONAME</th>";
        echo "<th>PFERDESTÄRKEN</th>";
        echo "<th>AUSGELIEHEN</th>";
        echo "<th>TAGESPREIS</th>";
        echo "<th>WOCHENPREIS</th>";
        echo "<th>AUSGELIEHEN BIS</th>";
        echo "<th>AUSGELIEHEN AM</th>";
        echo "<th>KENNZEICHEN</th>";
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == RENTALMOD || getRank($userLogin) == MOD || getRank($userLogin) == ADMIN) {
            echo "<th>AUSLEIHEN</th>";
        }
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == ADMIN) {
            echo "<th>BEARBEITEN</th>";
            echo "<th>LÖSCHEN</th>";
        }
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == RENTALMOD || getRank($userLogin) == MOD || getRank($userLogin) == ADMIN) {
            echo "<th>INFORMATIONEN</th>";
        }
        echo "</tr>";
        while ($row = $stmtTop->fetch()) {
            echo "<tr>";
            echo "<td>$row[ID]</td>";
            echo "<td>$row[CARNAME]</td>";
            echo "<td>$row[HORSEPOWER]</td>";
            echo "<td>$row[ISRENTAL]</td>";
            echo "<td>$row[DAYT]</td>";
            echo "<td>$row[WEEK]</td>";
            if ($row["ISRENTAL"] == 0) {
                echo "<td></td>";
                echo "<td></td>";
            } else {
                $until = $mysql->prepare("SELECT * FROM memberrental WHERE CARID = $row[ID]");
                $until->execute();
                $beginSetter;
                $endSetter;
                while ($untilRow = $until->fetch()) {
                    $beginnDatum = $untilRow["LENTTO"];
                    $beginSetter = date("d.m.y", $beginnDatum);
                    $endDatum = $untilRow["LENTEND"];
                    $endSetter = date("d.m.y", $endDatum);
                }
                echo "<td>$endSetter</td>";
                echo "<td>$beginSetter</td>";
            }

            echo "<td>$row[MARK]</td>";
            if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == RENTALMOD || getRank($userLogin) == MOD || getRank($userLogin) == ADMIN) {
                echo "<td><a href=\"rentalsetinput.php?ID=$row[ID]\">ausleihen</td>";
            }
            if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == ADMIN) {
                echo "<td><a href=\"editcar.php?ID=$row[ID]\">bearbeiten</td>";
                echo "<td><a href=\"deletecar.php?ID=$row[ID]\">löschen</td>";
            }
            if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == RENTALMOD || getRank($userLogin) == MOD || getRank($userLogin) == ADMIN) {
                echo "<td><a href=\"informations.php?ID=$row[ID]\">informationen</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
        ?>
    </main>




    <?php
    require("../mysql.php");
    // commit a new car submit
    if (isset($_GET["submit"])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            $checkUser = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
            $checkUser->bindParam(":user", $_GET["besitzer"], PDO::PARAM_STR);
            $checkUser->execute();
            $count = $checkUser->rowCount();
            if ($count == 0) {
                header("location: index.php");
            } else {
                $fullcar = $_GET["carname"];
                $informations = $mysql->prepare("SELECT * FROM carlist WHERE Fullcar = '$fullcar'");
                $informations->execute();
                $stmt = $mysql->prepare("INSERT INTO rental (CARNAME, HORSEPOWER, IMAGET, DAYT, WEEK, MARK, BESITZER) VALUES (:carname, :horsepower, :imageT, :dayT, :week, :kennzeichen, :besitzer)");
                $stmt->bindParam(":carname", $_GET["carname"], PDO::PARAM_STR);
                while ($hpRow = $informations->fetch()) {
                    if ($_GET["hp"] == "o4") {
                        $stmt->bindParam(":horsepower", $hpRow["HP4"], PDO::PARAM_INT);
                    } else if ($_GET["hp"] == "o3") {
                        $stmt->bindParam(":horsepower", $hpRow["HP3"], PDO::PARAM_INT);
                    } else if ($_GET["hp"] == "o2") {
                        $stmt->bindParam(":horsepower", $hpRow["HP2"], PDO::PARAM_INT);
                    } else if ($_GET["hp"] == "o1") {
                        $stmt->bindParam(":horsepower", $hpRow["HP1"], PDO::PARAM_INT);
                    }
                }
                $stmt->bindParam(":imageT", $_GET["image"], PDO::PARAM_STR);
                $stmt->bindParam(":dayT", $_GET["dayprice"], PDO::PARAM_INT);
                $stmt->bindParam(":week", $_GET["weekprice"], PDO::PARAM_INT);
                $stmt->bindParam(":kennzeichen", $_GET["kennzeichen"], PDO::PARAM_STR);
                $stmt->bindParam(":besitzer", $_GET["besitzer"], PDO::PARAM_STR);
                $stmt->execute();
                header("location: index.php");
            }
        }
    }
    // send  submit
    if (isset($_POST['submit_eingabe'])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != RENTALMOD && getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            $newstmt = $mysql->prepare("UPDATE rental SET DAYT='$_POST[day]', WEEK='$_POST[week]', MARK='$_POST[mark]' WHERE ID=$_POST[id]");
            $newstmt->execute();
            header("location: index.php");
        }
    }
    // delete a car submit
    if (isset($_POST['delete_eingabe'])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != RENTALMOD && getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            $delstmt = $mysql->prepare("DELETE FROM rental WHERE ID=$_POST[id]");
            $delstmt->execute();
            header("location: index.php");
        }
    }
    // delete a contract
    if (isset($_POST['kill_vertrag'])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            $delstmt1 = $mysql->prepare("UPDATE rental SET `ISRENTAL`=0 WHERE ID=$_POST[carid]");
            $delstmt1->execute();
            $delstmt = $mysql->prepare("DELETE FROM memberrental WHERE ID=$_POST[id]");
            $delstmt->execute();
            header("location: index.php");
        }
    }
    // expand a carrental
    if (isset($_POST['expand_car'])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != RENTALMOD && getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            if ($_POST["days"] >= 7) {
                header("location: informations.php?ID=$_POST[carid]");
            } else {
                $newstmt = $mysql->prepare("UPDATE memberrental SET LENTEND = '$_POST[enddate]', OTD = '$_POST[otd]', USERPAYMENT = '$_POST[inspayment]' WHERE CARID='$_POST[carid]'");
                $newstmt->execute();
                $payment = $_POST["payment"];
                $fullbank = $payment;
                $steuerbank = $payment * 0.08;
                $userbank = $fullbank - $steuerbank;
                $userAccount = $_POST["besitzer"];
                $baninf = $mysql->prepare("SELECT * FROM banking WHERE INHABER = '$userAccount'");
                $baninf->execute();

                $guthabenVorher;
                $kontoidUser;
                $kontovban;
                while ($barow = $baninf->fetch()) {
                    $guthabenVorher = $barow["GUTHABEN"];
                    $kontoidUser = $barow["ID"];
                    $kontovban = $barow["VBAN"];
                }
                $steuerVorher;
                $kontoidSteuer;
                $steuervban;
                $hkinf = $mysql->prepare("SELECT * FROM banking WHERE INHABER = 'HandelskammerRental'");
                $hkinf->execute();
                while ($barow = $hkinf->fetch()) {
                    $steuerVorher = $barow["GUTHABEN"];
                    $kontoidSteuer = $barow["ID"];
                    $steuervban = $barow["VBAN"];
                }


                $guthabenNachher = $guthabenVorher + $userbank;
                $steuerNachher = $steuerVorher + $steuerbank;

                $bankstmt = $mysql->prepare("UPDATE banking SET GUTHABEN = '$guthabenNachher' WHERE INHABER = '$userAccount'");
                $bankstmt->execute();
                $steuerstmt = $mysql->prepare("UPDATE banking SET GUTHABEN = '$steuerNachher' WHERE INHABER = 'HandelskammerRental'");
                $steuerstmt->execute();

                $time = time();
                $minusornot = 0;
                $grund = $userLogin . " Hat dein Auto verlängert";
                // userpayment
                $setUseraccountStatus = $mysql->prepare("INSERT INTO banktransaction (KONTOID, VONBANK, ZUBANK, BETRAG, DATUM, ZWECK, MINUSORNOT, GETUSER) VALUES (:kontoid, :von, :zu, :betrag, :datum, :zweck, :minusornot, :getuser)");
                $setUseraccountStatus->bindParam(":kontoid", $kontoidUser);
                $setUseraccountStatus->bindParam(":von", $userLogin);
                $setUseraccountStatus->bindParam(":zu", $kontovban);
                $setUseraccountStatus->bindParam(":betrag", $userbank);
                $setUseraccountStatus->bindParam(":datum", $time);
                $setUseraccountStatus->bindParam(":zweck", $grund);
                $setUseraccountStatus->bindParam(":minusornot", $minusornot);
                $setUseraccountStatus->bindParam(":getuser", $userLogin);
                $setUseraccountStatus->execute();

                // HandelskammerRentalpayment
                $grund = $userLogin . " Hat das Auto von $userAccount verlängert";
                $setSteueraccountStatus = $mysql->prepare("INSERT INTO banktransaction (KONTOID, VONBANK, ZUBANK, BETRAG, DATUM, ZWECK, MINUSORNOT, GETUSER) VALUES (:kontoid, :von, :zu, :betrag, :datum, :zweck, :minusornot, :getuser)");
                $setSteueraccountStatus->bindParam(":kontoid", $kontoidSteuer);
                $setSteueraccountStatus->bindParam(":von", $userLogin);
                $setSteueraccountStatus->bindParam(":zu", $steuervban);
                $setSteueraccountStatus->bindParam(":betrag", $steuerbank);
                $setSteueraccountStatus->bindParam(":datum", $time);
                $setSteueraccountStatus->bindParam(":zweck", $grund);
                $setSteueraccountStatus->bindParam(":minusornot", $minusornot);
                $setSteueraccountStatus->bindParam(":getuser", $userLogin);
                $setSteueraccountStatus->execute();
                header("location: index.php");
            }
        }
    }
    // rental a car
    if (isset($_POST['rental_car'])) {
        if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != RENTALMOD && getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
            header("location: index.php");
            exit;
        } else {
            $checkUser = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
            $checkUser->bindParam(":user", $_POST["rentuser"], PDO::PARAM_STR);
            $checkUser->execute();
            $count = $checkUser->rowCount();

            if ($count != 0) {
                $besitzerstmt = $mysql->prepare("SELECT * FROM rental WHERE ID=$_POST[id]");
                $besitzerstmt->execute();
                $rowb = $besitzerstmt->fetch();
                $userAccount = $rowb["BESITZER"];
                $bankinfostmt = $mysql->prepare("SELECT * FROM banking WHERE INHABER = $userAccount");
                $bankinfostmt->execute();
                $bankcount = $bankinfostmt->rowCount();
                if ($bankcount == 0) {
                    $stmtPrices = $mysql->prepare("SELECT * FROM rental WHERE ID=$_POST[id]");
                    $stmtPrices->execute();
                    $inputRental = $mysql->prepare("INSERT INTO memberrental (USERID, DISCOUNT, CARID, LENTTO, LENTEND, DAYPRICE, WEEKPRICE, OTD, DAYPAY, WEEKPAY, USERPAYMENT) VALUES (:userid, :discount, :carid, :lentto, :lentend, :dayprice, :weekprice, :otd, :daypay, :weekpay, :payment)");
                    while ($checkUser->fetch()) {
                        $inputRental->bindParam(":userid", $_POST["rentuser"]);
                    }
                    $inputRental->bindParam(":discount", $_POST["discount"]);
                    $inputRental->bindParam(":carid", $_POST["id"]);
                    $inputRental->bindParam(":dayprice", $_POST["days"]);
                    $inputRental->bindParam(":weekprice", $_POST["weeks"]);
                    $payment;
                    $daysValue = ($_POST["weeks"] * 7) + $_POST["days"];
                    while ($setPriceRow = $stmtPrices->fetch()) {
                        $inputRental->bindParam(":daypay", $setPriceRow["DAYT"]);
                        $inputRental->bindParam(":weekpay", $setPriceRow["WEEK"]);
                        $dayprice = $setPriceRow["DAYT"];
                        $weekprice = $setPriceRow["WEEK"];
                        $days = $_POST["days"];
                        $weeks = $_POST["weeks"];
                        $insDays = $dayprice * $days;
                        $insWeeks = $weekprice * $weeks;
                        $rabatt = (100 -  $_POST["discount"]) / 100;
                        $payment = ($insDays + $insWeeks) * $rabatt;
                    }
                    $time = time();
                    $beginnDatum = $time;
                    $beginSetter = date("d.m.y", $beginnDatum);
                    $enddatum = $beginnDatum + ($daysValue * (3600 * 24));

                    $inputRental->bindParam(":lentto", $time);
                    $inputRental->bindParam(":lentend", $enddatum);

                    $inputRental->bindParam(":otd", $daysValue);

                    $inputRental->bindParam(":payment", $payment);
                    $inputRental->execute();
                    // set isrental = 1; 
                    $bestmt = $mysql->prepare("SELECT * FROM rental WHERE ID=$_POST[id]");
                    $bestmt->execute();
                    if ($row = $bestmt->fetch()) {

                        if ($row["ISRENTAL"] == 0) {
                            $updateRental = $mysql->prepare("UPDATE rental SET `ISRENTAL`=1 WHERE ID=$_POST[id]");
                            $updateRental->execute();

                            // Set money to bankaccount


                            $fullbank = $payment;
                            $steuerbank = $payment * 0.08;
                            $userbank = $fullbank - $steuerbank;

                            $baninf = $mysql->prepare("SELECT * FROM banking WHERE INHABER = '$userAccount'");
                            $baninf->execute();

                            $guthabenVorher;
                            $kontoidUser;
                            $kontovban;
                            while ($barow = $baninf->fetch()) {
                                $guthabenVorher = $barow["GUTHABEN"];
                                $kontoidUser = $barow["ID"];
                                $kontovban = $barow["VBAN"];
                            }
                            $steuerVorher;
                            $kontoidSteuer;
                            $steuervban;
                            $hkinf = $mysql->prepare("SELECT * FROM banking WHERE INHABER = 'HandelskammerRental'");
                            $hkinf->execute();
                            while ($barow = $hkinf->fetch()) {
                                $steuerVorher = $barow["GUTHABEN"];
                                $kontoidSteuer = $barow["ID"];
                                $steuervban = $barow["VBAN"];
                            }


                            $guthabenNachher = $guthabenVorher + $userbank;
                            $steuerNachher = $steuerVorher + $steuerbank;

                            $bankstmt = $mysql->prepare("UPDATE banking SET GUTHABEN = $guthabenNachher WHERE INHABER = '$userAccount'");
                            $bankstmt->execute();
                            $steuerstmt = $mysql->prepare("UPDATE banking SET GUTHABEN = $steuerNachher WHERE INHABER = 'HandelskammerRental'");
                            $steuerstmt->execute();

                            $time = time();
                            $minusornot = 0;
                            $grund = $userLogin . " Hat dein Auto vermietet";
                            // userpayment
                            $setUseraccountStatus = $mysql->prepare("INSERT INTO banktransaction (KONTOID, VONBANK, ZUBANK, BETRAG, DATUM, ZWECK, MINUSORNOT, GETUSER) VALUES (:kontoid, :von, :zu, :betrag, :datum, :zweck, :minusornot, :getuser)");
                            $setUseraccountStatus->bindParam(":kontoid", $kontoidUser);
                            $setUseraccountStatus->bindParam(":von", $userLogin);
                            $setUseraccountStatus->bindParam(":zu", $kontovban);
                            $setUseraccountStatus->bindParam(":betrag", $userbank);
                            $setUseraccountStatus->bindParam(":datum", $time);
                            $setUseraccountStatus->bindParam(":zweck", $grund);
                            $setUseraccountStatus->bindParam(":minusornot", $minusornot);
                            $setUseraccountStatus->bindParam(":getuser", $userLogin);
                            $setUseraccountStatus->execute();

                            // HandelskammerRentalpayment
                            $grund = $userLogin . " Hat das Auto von $userAccount vermietet";
                            $setSteueraccountStatus = $mysql->prepare("INSERT INTO banktransaction (KONTOID, VONBANK, ZUBANK, BETRAG, DATUM, ZWECK, MINUSORNOT, GETUSER) VALUES (:kontoid, :von, :zu, :betrag, :datum, :zweck, :minusornot, :getuser)");
                            $setSteueraccountStatus->bindParam(":kontoid", $kontoidSteuer);
                            $setSteueraccountStatus->bindParam(":von", $userLogin);
                            $setSteueraccountStatus->bindParam(":zu", $steuervban);
                            $setSteueraccountStatus->bindParam(":betrag", $steuerbank);
                            $setSteueraccountStatus->bindParam(":datum", $time);
                            $setSteueraccountStatus->bindParam(":zweck", $grund);
                            $setSteueraccountStatus->bindParam(":minusornot", $minusornot);
                            $setSteueraccountStatus->bindParam(":getuser", $userLogin);
                            $setSteueraccountStatus->execute();

                            echo ("<script>console.log('PHP: " . $fullbank . "<br>');</script>");
                            echo ("<script>console.log('PHP: " . $steuerbank . "<br>');</script>");
                            echo ("<script>console.log('PHP: " . $userbank . "<br>');</script>");
                            echo ("<script>console.log('PHP guthabenVorher: " . $guthabenVorher . "<br>');</script>");
                            echo ("<script>console.log('PHP guthabenNachher: " . $guthabenNachher . "<br>');</script>");
                        }
                    }
                } else {
                }
            } else {
            }
            header("location: index.php");
        }
    }
    ?>
    <script src="../assets/javascript/carfile.js"></script>
    <script>
        autocomplete(document.getElementById("carnames"), cars);
    </script>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>