<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_all.css">
    <title>Document</title>
</head>

<body>
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside>
        <a href="addcustomer.php" class="a_customer"><button>Kunde hinzufügen</button></a>
    </aside>
    <main>
        <table class="customer_table">
            <tr id="top">
                <th>ID</th>
                <th>NAME</th>
                <th>TELEFON</th>
                <th>VBAN</th>
                <th>EDIT</th>
            </tr>


            <?php
            require("../../mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM member");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
            ?><tr class="customers"><?php
                                        ?><td><?php echo $row["id"] . "<br>"; ?></td><?php
                                                                ?><td><?php echo $row["spielername"] . "<br>"; ?></td><?php
                                                                        ?><td><?php echo "1822-" . $row["telefonnummer"] . "<br>"; ?></td><?php
                                                                                    ?><td><?php echo number_format($row["vban"], 0, '', ' ') . "<br>"; ?></td><?php
                                                                                            ?><td>
                        <?php
                        $id = $row["id"];
                        $edit = $mysql->prepare("SELECT * FROM member WHERE ID = '$id'");
                        $edit->execute();
                        $erow = $edit->fetch();
                        ?><a href="edit.php?id=<?php echo $erow["id"] ?>">Edit</a><?php
                                                                                    ?>
                    </td><?php
                            ?></tr><?php
                    }
                    if (isset($_GET["submit"])) {
                        require("../../mysql.php");
                        $stmt = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
                        $stmt->bindParam(":user", $_GET["user"]);
                        $stmt->execute();
                        $count = $stmt->rowCount();
                        if ($count == 0) {
                            $stmt = $mysql->prepare("INSERT INTO member (spielername, telefonnummer, vban) VALUES (:user, :tel, :vban)");
                            $stmt->bindParam(":user", $_GET["user"]);
                            $stmt->bindParam(":tel", $_GET["tel"]);
                            $stmt->bindParam(":vban", $_GET["vban"]);
                            $stmt->execute();
                        } else {
                        }
                        header("Location: index.php");
                    }
                    if (isset($_GET["edit_submit"])) {
                        require("../../mysql.php");
                        $stmt = $mysql->prepare("UPDATE member SET spielername = '$_GET[name]', telefonnummer = '$_GET[tel]', vban = '$_GET[vban]' WHERE id = '$_GET[id]'");
                        $stmt->execute();

                        header("Location: index.php");
                    }
                        ?>


        </table>

    </main>
    <script src="../../assets/javascript/backtoback.js"></script>
</body>

</html>