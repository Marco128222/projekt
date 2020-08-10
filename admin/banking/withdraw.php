<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != CARADMIN && getRank($userLogin) != ADMIN) {
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
</head>

<body>
    <?php
    require("../mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM banking WHERE ID=$_GET[ID]");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $moneyInput = number_format($row["GUTHABEN"], 2, '.', ',');
    ?>
        <form action="withdraw.php" method="get">
            <p><input type="text" value="<?php echo $_GET["ID"] ?>" name="ID" readonly>* KontoID</p>
            <p><input type="text" value="<?php echo $moneyInput ?>" name="validguthaben" readonly>* verfügbares Guthaben</p>
            <p><input type="text" name="guthaben" value="0.00">*Bitte geben Sie nur positive Zahlen an. Cent wird mit "." getrennt.</p>
            <p><input type="text" name="vban" readonly value="<?php echo number_format($row["VBAN"], 0, '', ' ') ?>" id=""><?php echo "*Bitte beachten Sie, dass diese VBAN beim erstellen des Kontos von $row[INHABER] angegeben wurde. Wenn Sie Ihre VBAN ändern wollen, sprechen Sie einen Systemadmin an. "; ?></p>
            <p><input type="submit" name="submit" value="Bestätigen"></p>
        </form>
    <?php

        if (isset($_GET["submit"])) {
            $money = number_format($row["GUTHABEN"], 2, '.', '');
            if (is_numeric($_GET["guthaben"])) {
                $takemoney = number_format($_GET["guthaben"], 2, '.', '');
                echo $money . "<br>";
                echo $takemoney . "<br>";

                if ($takemoney > $money) {
                    echo "Zu wenig Guthaben auf dein Konto";
                } else if ($takemoney <= 09.99) {
                    echo "Kein gültiger Überweisungsbetrag";
                } else {
                    header("location: submitwithdraw.php?ID=$_GET[ID]&VBAN=$_GET[vban]&&validguthaben=$_GET[validguthaben]&guthaben=$_GET[guthaben]&vban=$_GET[VBAN]");
                }
            } else {
                echo "Kein gültiger Überweisungsbetrag";
            }
        }
    }
    ?>
</body>

</html>