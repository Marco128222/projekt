<?php
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
    <header>

    </header>
    <main>
        <a href=""><button>Auto verkaufen</button></a>
        <a href="contractlist.php"><button>Aufträge ansehen</button></a>
        <a href="createcontract.php"><button>Auto bauen</button></a>
        <a href=""><button>Motorpreis-Liste</button></a>
        <a href="calculator.php"><button>Autopreis ausrechnen</button></a>
        <a href=""><button>Tuningteile-Preisliste</button></a>
        <a href="carlist.php"><button>Autoliste</button></a>
        <a href="utility/index.php"><button>Autoteil liste</button></a>
    </main>
</body>

</html>