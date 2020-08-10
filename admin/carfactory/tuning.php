<?php
session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: ../login.php");
    exit;
}
require("../rankmanager.php");
if (getRank($userLogin) != ADMIN && getRank($userLogin) != MOD) {
    header("location: index.php");
    exit;
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?
            $fahrzeugschloss;
            $spoiler;
            $body_kit_front;
            $body_kit_heck;
            $body_kit_seitenschweller;
            $auspuffanlage_sport;
            $motorhaube_sport;
            $kotflügel;
            $bremsanlage_sport;
            $felgen;
            $felgenbereifung;
            $lenkrad;
            $hydraulik_system;
            $luftfilter;
            $folie_scheibentönung;
            $fahrzeug_folierung;
            $schalthebel;
            $zierleisten;
            $xenon_lichter;
            $interior_kit;
            $domstrebe;
            $led_unterbodenbeleuchtung;
            $sportfederung;
        ?>
    </main>
</body>
</html>