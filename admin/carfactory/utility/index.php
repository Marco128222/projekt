
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
    <title>Document</title>
    <style>
        th {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    require("../../mysql.php");
    if (isset($_GET["submit"])) {
        $stmt = $mysql->prepare("UPDATE utilities SET LAGER='$_GET[lager]' WHERE UTILITYNAME='$_GET[nam]'");
        $stmt->execute();
        header("Location: index.php");
    }

    $_sack_kunststoffgranulat = $mysql->prepare("SELECT price FROM pricelist WHERE id='1'");
    $_sack_kunststoffgranulat->execute();
    $price_sack_kunststoffgranulat = $_sack_kunststoffgranulat->fetch();

    $_elektronikbauteil = $mysql->prepare("SELECT price FROM pricelist WHERE id='2'");
    $_elektronikbauteil->execute();
    $price_elektronikbauteil = $_elektronikbauteil->fetch();

    $_eisenbarren = $mysql->prepare("SELECT price FROM pricelist WHERE id='3'");
    $_eisenbarren->execute();
    $price_eisenbarren = $_eisenbarren->fetch();

    $_stahlbarren = $mysql->prepare("SELECT price FROM pricelist WHERE id='4'");
    $_stahlbarren->execute();
    $price_stahlbarren = $_stahlbarren->fetch();


    $_gummi = $mysql->prepare("SELECT price FROM pricelist WHERE id='5'");
    $_gummi->execute();
    $price_gummi = $_gummi->fetch();

    $_rolle_stoff = $mysql->prepare("SELECT price FROM pricelist WHERE id='6'");
    $_rolle_stoff->execute();
    $price_rolle_stoff = $_rolle_stoff->fetch();

    $_rolle_pappe = $mysql->prepare("SELECT price FROM pricelist WHERE id='7'");
    $_rolle_pappe->execute();
    $price_rolle_pappe = $_rolle_pappe->fetch();

    $_kupferbarren = $mysql->prepare("SELECT price FROM pricelist WHERE id='8'");
    $_kupferbarren->execute();
    $price_kupferbarren = $_kupferbarren->fetch();

    $_platte_faser_kunststoff_verbund = $mysql->prepare("SELECT price FROM pricelist WHERE id='9'");
    $_platte_faser_kunststoff_verbund->execute();
    $price_platte_faser_kunststoff_verbund = $_platte_faser_kunststoff_verbund->fetch();

    $_sack_kohlefasern = $mysql->prepare("SELECT price FROM pricelist WHERE id='10'");
    $_sack_kohlefasern->execute();
    $price_sack_kohlefasern = $_sack_kohlefasern->fetch();

    $_holzbrett = $mysql->prepare("SELECT price FROM pricelist WHERE id='11'");
    $_holzbrett->execute();
    $price_holzbrett = $_holzbrett->fetch();

    $_leder = $mysql->prepare("SELECT price FROM pricelist WHERE id='12'");
    $_leder->execute();
    $price_leder = $_leder->fetch();

    $_sack_glasgranulat = $mysql->prepare("SELECT price FROM pricelist WHERE id='13'");
    $_sack_glasgranulat->execute();
    $price_sack_glasgranulat = $_sack_glasgranulat->fetch();

    $_seil = $mysql->prepare("SELECT price FROM pricelist WHERE id='14'");
    $_seil->execute();
    $price_seil = $_seil->fetch();

    $_tube_roter_farbstoff = $mysql->prepare("SELECT price FROM pricelist WHERE id='15'");
    $_tube_roter_farbstoff->execute();
    $price_tube_roter_farbstoff = $_tube_roter_farbstoff->fetch();

    $_tube_blauer_farbstoff = $mysql->prepare("SELECT price FROM pricelist WHERE id='16'");
    $_tube_blauer_farbstoff->execute();
    $price_tube_blauer_farbstoff = $_tube_blauer_farbstoff->fetch();

    $_tube_grüner_farbstoff = $mysql->prepare("SELECT price FROM pricelist WHERE id='17'");
    $_tube_grüner_farbstoff->execute();
    $price_tube_grüner_farbstoff = $_tube_grüner_farbstoff->fetch();

    $_silberbarren = $mysql->prepare("SELECT price FROM pricelist WHERE id='18'");
    $_silberbarren->execute();
    $price_silberbarren = $_silberbarren->fetch();

    $_goldbarren = $mysql->prepare("SELECT price FROM pricelist WHERE id='19'");
    $_goldbarren->execute();
    $price_goldbarren = $_goldbarren->fetch();

    $_diamant = $mysql->prepare("SELECT price FROM pricelist WHERE id='20'");
    $_diamant->execute();
    $price_diamant = $_diamant->fetch();

    $_rubin = $mysql->prepare("SELECT price FROM pricelist WHERE id='21'");
    $_rubin->execute();
    $price_rubin = $_rubin->fetch();

    $_carbon = $mysql->prepare("SELECT price FROM pricelist WHERE id='22'");
    $_carbon->execute();
    $price_carbon = $_carbon->fetch();


    $stmt = $mysql->prepare("SELECT * FROM utilities WHERE TYPE = 0");
    $stmt->execute();
    $array = array("", "", "");
    echo "<table>";
    $price = 0;
    while ($row = $stmt->fetch()) {
        echo "<tr class='under-border'>";
        echo "<th>" . $row["UTILITYNAME"] . "</th>";
        echo "<th>" . $row["LAGER"] . "</th>";
        $GLOBALS['price'] = ($row["Sack_Kunststoffgranulat"] * $price_sack_kunststoffgranulat["price"])
            + ($row["Eisenbarren"] * $price_eisenbarren["price"])
            + ($row["Elektronikbauteil"] * $price_elektronikbauteil["price"])
            + ($row["Stahlbarren"] * $price_stahlbarren["price"])
            + ($row["Gummi"] * $price_gummi["price"])
            + ($row["Rolle_Stoff"] * $price_rolle_stoff["price"])
            + ($row["Rolle_Pappe"] * $price_rolle_pappe["price"])
            + ($row["Kupferbarren"] * $price_kupferbarren["price"])
            + ($row["Carbon"] * $price_carbon["price"])
            + ($row["Platte_Faser_Kunststoff_Verbund"] * $price_platte_faser_kunststoff_verbund["price"])
            + ($row["Sack_Kohlefasern"] * $price_sack_kohlefasern["price"])
            + ($row["Holzbrett"] * $price_holzbrett["price"])
            + ($row["Leder"] * $price_leder["price"])
            + ($row["Sack_Glasgranulat"] * $price_sack_glasgranulat["price"])
            + ($row["Seil"] * $price_seil["price"])
            + ($row["Tube_roter_Farbstoff"] * $price_tube_roter_farbstoff["price"])
            + ($row["Tube_blauer_Farbstoff"] * $price_tube_blauer_farbstoff["price"])
            + ($row["Tube_grüner_Farbstoff"] * $price_tube_grüner_farbstoff["price"]);
        echo "<th>$" . $GLOBALS['price'] . "</th>";
        echo "<th><a  href=\"edit.php?UTILITYNAME=$row[UTILITYNAME]\">Edit</a></th>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>