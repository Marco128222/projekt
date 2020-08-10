<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != RENTALADMIN && getRank($userLogin) != ADMIN) {
    header("location: ../index.php");
    exit;
}
?>
<?php
if (isset($_POST["submit"])) {
    require("../mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
    $stmt->bindParam(":username", $_POST["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count == 0) {

        //User anlegen
        $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, RANKGROUP) VALUES (:username, :passwort, :ranks)");
        $stmt->bindParam(":username", $_POST["username"]);
        $stmt->bindParam(":ranks", $_POST["ranks"]);
        $hash = password_hash($_POST["passwort"], PASSWORD_BCRYPT);
        $stmt->bindParam(":passwort", $hash);
        $stmt->execute();
    } else {
    }
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

<body id="adduser_body">
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside>
        <p class="recht" style="border-bottom: 3px solid #881238;">RECHTEGRUPPEN</p>
        <p class="recht">0 = DEFAULT</p>
        <p class="recht">1 = RENTALMOD</p>
        <p class="recht">2 = RENTALADMIN</p>
        <p class="recht">3 = CARMOD</p>
        <p class="recht">4 = CARADMIN</p>
        <p class="recht">5 = TAXIMOD</p>
        <p class="recht">6 = TAXIADMIN</p>
        <p class="recht">13 = MOD</p>
        <p class="recht">24 = ADMIN</p>
    </aside>
    <main>
        <form action="adduser.php" method="post">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="passwort" placeholder="passwort" required>
            <input type="number" name="ranks" placeholder="rechte" required>
            <button type="submit" name="submit">Erstellen</button>
        </form>
    </main>
    <script src="../assets/javascript/backtoback.js"></script>
</body>

</html>