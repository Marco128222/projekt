<!-- BANK TYPE 0 = RENTAL -->
<!-- BANK TYPE 1 = TAXI -->
<!-- BANK TYPE 2 = CARFACTORY/PRODUCIOM -->

<?php


session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}

require("../rankmanager.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style_all.css">
</head>

<body id="banking_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main class="main">
        <?php
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == CARADMIN || getRank($userLogin) == ADMIN) {
        ?>
            <form action="index.php" method="post">
                <label for="inhaber">Kontoinhaber<input type="text" name="inhaber" id=""></label>
                <label for="vban">Geschäftskonto (VBAN)<input type="number" name="vban" id=""></label>
                <input type="number" name="guthaben" value="0" style="display: none;"></label>
                <select name="type" id="type">
                    <option value="rental">Vermietung</option>
                    <option value="taxi">Taxi</option>
                    <option value="factory">Fahrzeugherstellung</option>
                </select>
                <input type="submit" name="createBank" value="Konto erstellen">
            </form>
        <?php
        }
        ?>
        <!-- Create Bankingaccount -->
        <?php
        require("../mysql.php");
        if (isset($_POST["createBank"])) {
            // Checking user
            if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == CARADMIN || getRank($userLogin) == ADMIN) {
                $checkUser = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
                $checkUser->bindParam(":user", $_POST["inhaber"], PDO::PARAM_STR);
                $checkUser->execute();
                $count = $checkUser->rowCount();
                if ($count != 0) {
                    $checkBank = $mysql->prepare("SELECT * FROM banking WHERE INHABER = :inhaber");
                    $checkBank->bindParam(":inhaber", $_POST["inhaber"], PDO::PARAM_STR);
                    $checkBank->execute();
                    $countBank = $checkBank->rowCount();
                    if ($countBank == 0) {
                        $create = $mysql->prepare("INSERT INTO banking (INHABER, VBAN, GUTHABEN, TYPE) VALUES (:inhaber, :vban, :guthaben, :type)");
                        $create->bindParam(":inhaber", $_POST["inhaber"]);
                        $create->bindParam(":vban", $_POST["vban"]);
                        $create->bindParam(":guthaben", $_POST["guthaben"]);
                        $types;
                        if ($_POST["type"] == "rental") {
                            $types = 0;
                        } else if ($_POST["type"] == "taxi") {
                            $types = 1;
                        } else if ($_POST["type"] == "factory") {
                            $types = 2;
                        }
                        $create->bindParam(":type", $types);
                        $create->execute();
                        header("location: index.php");
                    } else {
                        echo $_POST["inhaber"] . " hat bereits ein Konto!";
                    }
                } else {
                    echo "Der Benutzer ist nicht im Hauptverzeichnis eingetragen!";
                }
            } else {
                header("location: index.php");
            }
        }
        ?>
        <!-- Show Bankingaccounts -->
        <?php
        require("../mysql.php");
        if (getRank($userLogin) == RENTALADMIN || getRank($userLogin) == CARADMIN || getRank($userLogin) == ADMIN) {
            $stmt = $mysql->prepare("SELECT * FROM banking ORDER BY ID ASC");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $pay_format = number_format($row["GUTHABEN"], 2, '.', ',');
                $bankstyle = $row["TYPE"];
                if ($bankstyle == 0) {
        ?>
                    <div class="bankkonto" style="background-image: url('https://pic.statev.de/i/RJuR.jpg')">
                    <?php
                } else if ($bankstyle == 1) {
                    ?>
                        <div class="bankkonto" style="background-image: url('https://pic.statev.de/i/R1j0.jpg')">
                        <?php
                    } else if ($bankstyle == 2) {
                        ?> <div class="bankkonto" style="background-image: url('https://pic.statev.de/i/REbB.jpg')">
                            <?php
                        } else
                            ?>

                            <?php echo "<a class=\"href\" href=\"account.php?ID=$row[ID]\">" ?>
                            <div class="bottom">
                                <p><?php echo $row["INHABER"] ?></p>
                                <p><?php echo "$" . $pay_format ?></p>
                            </div>
                            <?php echo "</a>"; ?>
                            </div>
                        <?php
                    }
                } else {
                    $stmt = $mysql->prepare("SELECT * FROM banking WHERE INHABER = '$userLogin' ORDER BY ID DESC");
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        $pay_format = number_format($row["GUTHABEN"], 2, '.', ',');
                        ?>

                            <div class="bankkonto">
                                <?php echo "<a class=\"href\" href=\"account.php?ID=$row[ID]\">" ?>
                                <div class="bottom">
                                    <p><?php echo $row["INHABER"] ?></p>
                                    <p><?php echo "$" . $pay_format ?></p>
                                </div>
                                <?php echo "</a>"; ?>
                            </div>
                    <?php
                    }
                }

                    ?>
    </main>

    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>