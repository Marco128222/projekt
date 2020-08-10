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
    <title>Document</title>
</head>

<body>
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <?php
    require("../../mysql.php");
    $id = $_GET["id"];
    $stmt = $mysql->prepare("SELECT * FROM member WHERE ID='$id'");
    $stmt->execute();
    $row = $stmt->fetch();
    ?>
    <form action="index.php" method="get">
        <input type="number" name="id" id="id" value="<?php echo $row["id"] ?>" readonly>
        <input type="text" name="name" id="name" value="<?php echo $row["spielername"] ?>" required>
        <input type="number" name="tel" id="tel" value="<?php echo $row["telefonnummer"] ?>" required>
        <input type="number" name="vban" id="vban" value="<?php echo $row["vban"] ?>" required>
        <input type="submit" value="Edit" name="edit_submit">
    </form>
</body>

</html>