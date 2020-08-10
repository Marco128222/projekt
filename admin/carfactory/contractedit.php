<?php
require("../mysql.php");
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
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
    $stmt = $mysql->prepare("SELECT * FROM ordernumber WHERE ID=$_GET[ID]");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo $row["auftrag"];


    ?>
        <form action="contractlist.php" method="post">
            <input type="number" name="ID" style="display: none;" readonly value="<?php echo $row["ID"] ?>">
            <select name="status" id="status">
                <option value="status1">offen</option>
                <option value="status2">Warte auf Motor</option>
                <option value="status3">Warteschlange</option>
                <option value="status4">In Bau</option>
                <option value="status5">Abholbereit</option>
                <option value="status6">Abgeschlossen</option>
            </select>
            <input type="submit" value="Ändern" name="edit">
        </form>
    <?php
    }
    ?>
</body>

</html>