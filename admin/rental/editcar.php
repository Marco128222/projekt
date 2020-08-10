<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != ADMIN) {
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

<body id="editcar_body">
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
            echo "<form method=\"post\" action=\"index.php\">\n";
            echo "<p><input style=\"display: none\" type=\"number\" name=\"id\" readonly value=\"$row[ID]\"></p>";
            echo "<p>Auto: <input type=\"text\" name=\"carname\" readonly value=\"$row[CARNAME]\"></p>";
            echo "<p>Besitzer: <input type=\"text\" name=\"besitzer\" readonly value=\"$row[BESITZER]\"></p>";
            echo "<p>Tagespreis: <input type=\"number\" name=\"day\" value=\"$row[DAYT]\"></p>";
            echo "<p>Wochenpreis: <input type=\"number\" name=\"week\" value=\"$row[WEEK]\"></p>";
            echo "<p>Kennzeichen: <input type=\"text\" name=\"mark\" value=\"$row[MARK]\"></p>";
            echo "<p><input type=\"submit\" name=\"submit_eingabe\" value=\"Bearbeiten\"></p>";
            echo "</form>\n";
        } else
        ?>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>