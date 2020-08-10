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
    echo"<form action=\"account.php?ID=$_GET[ID]\" method=\"get\">" ?>
        <p><input type="text" name="ID" id="id" readonly value="<?php echo $_GET["ID"] ?>">*KontoID</p>
        <p><input type="text" name="VBAN" id="VBAN" readonly value="<?php echo $_GET["VBAN"] ?>">*VBAN des Kontoinhabers</p>
        <p><input type="text" name="guthabenalt" readonly value="<?php echo $_GET["validguthaben"] ?>">*Kontostand vorher</p>
        <p><input type="text" name="validguthaben" readonly value="<?php echo $_GET["guthaben"] ?>">*Betrag welches abgehoben wird</p>
        <p><input type="text" name="endguthaben" readonly value="<?php echo $_GET["validguthaben"] - $_GET["guthaben"] ?>">*Kontostand nachher</p>
        
        
        <?php
        require("../mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM banking WHERE ID=$_GET[ID]");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $inhaber = $row["INHABER"];
            echo "<p><input type=\"text\" name=\"benutzer\" readonly value=\"$inhaber\">*Kontoinhaber</p>";
            echo "<p>Du musst $$_GET[guthaben] an die VBAN $row[VBAN] überweisen.</p>";
        }
        ?>
        <p><input type="checkbox" name="check" id="" required>Ich habe das vorgegebene Geld an die vorgegebene VBAN überwiesen.</p>
        <p><input type="submit" value="Bestätigen" name="withdrawSubmit"></p>
    </form>
</body>

</html>