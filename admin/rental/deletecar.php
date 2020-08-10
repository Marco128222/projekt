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

<body id="deletecar_body">
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
            if ($row["ISRENTAL"] == 0) {
                echo "<form method=\"post\" action=\"index.php\">\n";
                echo "<br><input type=\"number\" name=\"id\" readonly value=\"$row[ID]\" style=\"display: none\" >\n";
                echo "<br><br><input type=\"submit\" name=\"delete_eingabe\" value=\"Willst du das Auto wirklich löschen? KLICKE HIER\">\n";
                echo "</form>\n";
            } else {
                echo "<p>Das Auto kann nur gelöscht werden, wenn es nicht verliehen ist!</p>";
            }
        } else
            echo "Fehler: Matrikelnummer $_GET[ID] nicht vorhanden\n";
        ?>
    </main>

    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>