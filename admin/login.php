<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Document</title>
</head>

<body>
    
    <main>
        <?php
        if (isset($_GET["submit"])) {
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
            $stmt->bindParam(":username", $_GET["username"]);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 1) {
                $row = $stmt->fetch();
                if (password_verify($_GET["pw"], $row["PASSWORD"])) {
                    session_start();
                    $_SESSION["username"] = $row["USERNAME"];
                    header("Location: index.php");
                } else {
                    header("Location: login.php");
                }
            } else {
                header("Location: login.php");
            }
        }
        ?>
        <form action="login.php" method="get" class="login-form">
            <div class="input-group">
                <label id="label-1">Username</label>
                <input type="text" name="username" onkeyup="checkLabel('label-1', this)" onkeydown="checkLabel('label-1', this)" id="input-1" required>
            </div>
            <div class="input-group">
                <label id="label-2">Passwort</label>
                <input type="password" name="pw" onkeyup="checkLabel('label-2', this)" onkeydown="checkLabel('label-2', this)" id="input-2" id="input-password" required>
            </div>
            <br>
            <button type="submit" onklick="addInputErrorAnim()" name="submit">Einloggen</button>
        </form>
    </main>
    <script>
        function checkLabel(labelID, input) {
            let label = document.getElementById(labelID);
            input = input;
            if (input.value != "") {
                if (!label.classList.contains("label-active"))
                    label.classList.add("label-active");
            } else {
                label.classList.remove("label-active");
            }
        }
        window.addEventListener("scroll", function() {
            let mainSeach = document.getElementById("seachbar");

            if (window.pageYOffset > 0) {
                mainSeach.classList.add("is-sticky");
                mainSeach.style.backgroundColor = "blue";
            } else {
                mainSeach.classList.remove("is-sticky");
            }
        });
    </script>
</body>

</html>