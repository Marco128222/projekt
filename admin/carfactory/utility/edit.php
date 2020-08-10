<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../../login.php");
    exit;
}
// require("../../rankmanager.php");
// if (getRank($userLogin) != MOD && getRank($userLogin) != ADMIN) {
//     header("location: index.php");
//     exit;
// }
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
    require("../../mysql.php");
    $get = $_GET["UTILITYNAME"];
    $stmt = $mysql->prepare("SELECT * FROM utilities WHERE UTILITYNAME='$get'");
    $stmt->execute();
    $row = $stmt->fetch(); 
    ?>
    <form action="index.php" method="get">
        <input type="text" name="nam" id="nam" value="<?php echo $row["UTILITYNAME"] ?>">
        <input type="number" name="lager" id="lager" value="<?php echo $row["LAGER"] ?>">
        <input type="submit" value="Bestätigen" name="submit">
    </form>
</body>

</html>