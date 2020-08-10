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

<body id="rentalsubmitter_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main>
        <?php
        require("../mysql.php");
        if (isset($_POST["subRentsetter"])) {
            if ($_POST["days"] >= 7) {
                header("location: rentalsetinput.php?ID=$_POST[id]");
                echo "fehler";
            } else {
                $checkUser = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
                $checkUser->bindParam(":user", $_POST["rentuser"], PDO::PARAM_STR);
                $checkUser->execute();
                $count = $checkUser->rowCount();
                $daysValue = ($_POST["weeks"] * 7) + $_POST["days"];
                $time = time();
                $timestamp = strtotime("+$daysValue days");
                $datum = date("d.m.y", $time);
                $datum2 = date("d.m.y", $timestamp);
                if ($count == 0) {
                    header("location: rentalsetinput.php?ID=$_POST[id]");
                } else {
                    $payment;
                    $stmtPrices = $mysql->prepare("SELECT * FROM rental WHERE ID=$_POST[id]");
                    $stmtPrices->execute();
                    while ($setPriceRow = $stmtPrices->fetch()) {
                        $dayprice = $setPriceRow["DAYT"];
                        $weekprice = $setPriceRow["WEEK"];
                        $days = $_POST["days"];
                        $weeks = $_POST["weeks"];
                        $insDays = $dayprice * $days;
                        $insWeeks = $weekprice * $weeks;
                        $rabatt = (100 -  $_POST["discount"]) / 100;
                        $payment = ($insDays + $insWeeks) * $rabatt;
                    }
                    $vertragCarmiete = "BLA BLA BLA\n$_POST[rentuser]\nBLA BLA BLA\n$datum BLA BLA BLA $datum2 BLA BLA BLA";
                    echo "<form method=\"post\" action=\"index.php\">";
                    echo "<p><input type=\"number\" name=\"id\" style=\"display: none\" readonly value=\"$_POST[id]\"></p>";
                    echo "<p>RABATT: <input type=\"number\" name=\"discount\" readonly value=\"$_POST[discount]\">%</p>";
                    echo "<p>Kundenname: <input type=\"text\" name=\"rentuser\" readonly value=\"$_POST[rentuser]\"></p>";
                    echo "<p>Tage ausgeliehen: <input type=\"number\" value=\"$_POST[days]\" readonly name=\"days\"></p>";
                    echo "<p>Wochen ausgeliehen: <input type=\"number\" value=\"$_POST[weeks]\" readonly name=\"weeks\"></p>";
                    echo "<p id=\"vertragP\">Vertrag:</p>";
        ?>
                    <textarea cols="45" rows="15" readonly><?php echo $vertragCarmiete; ?></textarea>
        <?php
                    echo "<p class=\"pay\">Kunde zahlt $$payment auf der VBAN 123 456</p>";
                    echo "<p class=\"pay\">Kunde hat bezahlt und Vertrag wurde bestätigt <input type=\"checkbox\" required></p>";
                    echo "<p><input type=\"submit\" name=\"rental_car\" readonly value=\"Auto verleihen\"></p>";
                    echo "</form>";
                }
            }
        }
        ?>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>