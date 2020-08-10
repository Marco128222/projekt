<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != RENTALMOD && getRank($userLogin) != RENTALADMIN && getRank($userLogin) != ADMIN && getRank($userLogin) != MOD) {
    header("location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member hinzufügen</title>
    <link rel="stylesheet" href="../../style/style_all.css">
</head>

<body id="addcustomer_body">
<header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside></aside>
    <main>
        <form action="index.php" method="get">
            <input type="text" name="user" placeholder="user" required><br>
            <input type="number" name="tel" placeholder="tel" required><br>
            <input type="number" name="vban" placeholder="vban" required><br>
            <button type="submit" name="submit">Erstellen</button>
        </form>
    </main>
    <script src="../../assets/javascript/backtoback.js"></script>
</body>

</html>