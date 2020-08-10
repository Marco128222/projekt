<?php

session_start();
$userLogin = $_SESSION["username"];
if (!isset($userLogin)) {
    header("location: login.php");
    exit;
}
require("rankmanager.php");
require("mysql.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style_all.css">
</head>

<body>
    <header>
        <p id="backtoback">◀</p>
        <p id="startseite">Startseite</p>
    </header>
    <aside>
        <a class="a_home" href="banking/index.php"><button>Bankaccounts</button></a>
        <a class="a_home" href="rental/index.php"><button>Fahrzeugvermietung</button></a>
        <a class="a_home" href="carfactory/index.php"><button>Fahrzeugherstellung</button></a>
        <a class="a_home" href="system/adduser.php"><button>Loginbenutzer erstellen</button></a>
        <a class="a_home" href="system/customer/index.php"><button>Kundendaten aufnehmen</button></a>
    </aside>
    <main></main>
</body>

</html>

<?php

require("mysql.php");
$_sack_kunststoffgranulat = 0;
$_elektronikbauteil = 0;
$_eisenbarren = 0;
$_stahlbarren = 0;
$_gummi = 0;
$_rolle_stoff = 0;
$_rolle_pappe = 0;
$_kupferbarren = 0;
$_platte_faser_kunststoff_verbund = 0;
$_sack_kohlefasern = 0;
$_holzbrett = 0;
$_leder = 0;
$_sack_glasgranulat = 0;
$_seil = 0;
$_tube_roter_farbstoff = 0;
$_tube_blauer_farbstoff = 0;
$_tube_grüner_farbstoff = 0;
$_silberbarren = 0;
$_goldbarren = 0;
$_diamant = 0;
$_rubin = 0;
$_carbon = 0;
$price_sack_kunststoffgranulat = 0;
$price_elektronikbauteil = 0;
$price_eisenbarren = 0;
$price_stahlbarren = 0;
$price_gummi = 0;
$price_rolle_stoff = 0;
$price_rolle_pappe = 0;
$price_kupferbarren = 0;
$price_platte_faser_kunststoff_verbund = 0;
$price_sack_kohlefasern = 0;
$price_holzbrett = 0;
$price_leder = 0;
$price_sack_glasgranulat = 0;
$price_seil = 0;
$price_tube_roter_farbstoff = 0;
$price_tube_blauer_farbstoff = 0;
$price_tube_grüner_farbstoff = 0;
$price_silberbarren = 0;
$price_goldbarren = 0;
$price_diamant = 0;
$price_rubin = 0;
$price_carbon = 0;


$nameArray = array($_sack_kunststoffgranulat, $_elektronikbauteil,  $_eisenbarren, $_stahlbarren, $_gummi, $_rolle_stoff, $_rolle_pappe, $_kupferbarren, $_platte_faser_kunststoff_verbund, $_sack_kohlefasern, $_holzbrett, $_leder, $_sack_glasgranulat, $_seil, $_tube_roter_farbstoff, $_tube_blauer_farbstoff, $_tube_grüner_farbstoff, $_silberbarren, $_goldbarren, $_diamant, $_rubin, $_carbon);
$idArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22);
$priceArray = array($price_sack_kunststoffgranulat, $price_elektronikbauteil, $price_eisenbarren, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff, $price_silberbarren, $price_goldbarren, $price_diamant,        $price_rubin,        $price_carbon);

for ($i = 0; $i < 22; $i++) {
    $id_d = $idArray[$i];
    $stmt = $mysql->prepare("SELECT price FROM pricelist WHERE id='$id_d'");
    $stmt->execute();
    $priceArray[$i] = $stmt->fetch();
}


?>