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
    <main>

        <form action="index.php" method="post">
            <input type="text" id="name" value="<?php echo $_POST["name"] ?>" name="name" readonly>
            <input id="carnames" type="text" name="carname" value="<?php  echo $_POST["carname"] ?>" readonly>
            <input id="maxmotor" type="number" name="maxmotor" value="<?php  echo $_POST["maxmotor"] ?>" readonly>
            <input style="z-index: 1;" id="giveDiamonds" value="<?php  echo $_POST["giveDiamonds"] ?>" type="number" name="giveDiamonds" readonly>
            <input style="z-index: 1;" id="giveRubys" value="<?php  echo $_POST["giveRubys"] ?>" type="number" name="giveRubys" readonly>
            <input type="text" name="rabatt" value="<?php  echo $_POST["rabatt"] ?>" readonly>
            <input type="text" name="motorsize" value="<?php  echo $_POST["motorsize"] ?>" readonly>
            <input type="text" name="status" value="<?php  echo $_POST["status"] ?>" readonly>
        </form>

        <form action="index.php">
            <?php 
                $vertrag = "BLA BLA \n BLA BLA";
            ?>
            <textarea name="" id="" cols="30" rows="10"><?php echo $vertrag ?></textarea>
        <label for="check"><input type="checkbox" name="check" id="check" required></label>
        <input type="submit" value="Bestätigen" name="vertrag">
        </form>



        <?php

        require("../mysql.php");
        $mysqli = $mysql;
        $random = 0;
        function randomCode()
        {
            $GLOBALS["random"] = random_int(100000, 999999);
            $stmt = $GLOBALS['mysqli']->prepare("SELECT auftrag FROM ordernumber WHERE 'auftrag'=" . "GB-" . $GLOBALS["random"] . "");
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 0) {
            } else {
                randomCode();
            }
        }
        randomCode();
        $numSe;
        $endprice_top = 0;
        if (isset($_POST["submit"])) {
            require("../mysql.php");
            $checkUser = $mysql->prepare("SELECT * FROM member WHERE spielername = :user");
            $checkUser->bindParam(":user", $_POST["name"], PDO::PARAM_STR);
            $checkUser->execute();
            $count = $checkUser->rowCount();
            $numSe = "GB-" . $GLOBALS["random"];
            if ($count != 0) {
                while ($check = $checkUser->fetch()) {
                    $userID = $mysql->prepare("INSERT INTO ordernumber (auftrag, spielername, bearbeiter, Autoname, Rabatt) VALUES (:auftrag, :spielername, :bearbeiter, :autoname, :rabatt)");
                    $userID->bindParam(":auftrag", $numSe, PDO::PARAM_STR);
                    $userID->bindParam(":spielername", $_POST["name"], PDO::PARAM_STR);
                    $userID->bindParam(":bearbeiter", $_SESSION["username"], PDO::PARAM_STR);
                    $userID->bindParam(":autoname", $_POST["carname"], PDO::PARAM_STR);
                    $userID->bindParam(":rabatt", $_POST["rabatt"], PDO::PARAM_INT);
                    $userID->execute();
                    require("../mysql.php");
                    $diamondfull = 0;
                    $rubyfull = 0;
                    $draufrechner = 1.18;
                    $steuern = 1.04;
                    $fullprice = 0;
                    $schreibkosten = 500;
                    if ($_POST["rabatt"] == "0p") {
                        $draufrechner = 1.18;
                    } else if ($_POST["rabatt"] == "5p") {
                        $draufrechner = 1.13;
                    }
                    else if ($_POST["rabatt"] == "10p") {
                        $draufrechner = 1.08;
                    }
                    else if ($_POST["rabatt"] == "20p") {
                        $draufrechner = 1.0;
                    }
                    else {
                        $draufrechner = 1.18;
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

                    function ge($name, $row, $hst, $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff)
                    {
                        $hst = $mysql->prepare("SELECT * FROM utilities WHERE UTILITYNAME='$name'");
                        $hst->execute();
                        while ($row = $hst->fetch()) {
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
                        }
                    }


                    $herstellung_utilityname;
                    $herstellung_sack_kunststoffgranulat;
                    $herstellung_eisenbarren;
                    $herstellung_elektronikbauteil;
                    $herstellung_stahlbarren;
                    $herstellung_gummi;
                    $herstellung_rolle_stoff;
                    $herstellung_rolle_pappe;
                    $herstellung_sack_glasgranulat;
                    $herstellung_kupferbarren;
                    $herstellung_platte_faser_kunststoff_verbund;
                    $herstellung_sack_kohlefasern;
                    $herstellung_holzbrett;
                    $herstellung_leder;
                    $herstellung_seil;
                    $herstellung_tube_roter_farbstoff;
                    $herstellung_tube_blauer_farbstoff;
                    $herstellung_tube_grüner_farbstoff;
                    $herstellung_carbon;

                    //


                    // 
                    $car = $_POST["carname"];
                    $stmtCar = $mysql->prepare("SELECT * FROM carlist WHERE Fullcar='$car'");
                    $stmtCar->execute();
                    ge("Fahrzeugsitz", "rowFahrzeugsitz", "hst_Fahrzeugsitz", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_fahrzeugsitz = $GLOBALS['price'];
                    ge("Carbon_Rennsitz", "rowCarbon_Rennsitz", "hst_Carbon_Rennsitz", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_carbon_rennsitz = $GLOBALS['price'];
                    ge("Glasscheibe", "rowGlasscheibe", "hst_Glasscheibe", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_glasscheibe = $GLOBALS['price'];
                    ge("Fahrzeugtür", "rowFahrzeugtür", "hst_Fahrzeugtür", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_fahrzeugtür = $GLOBALS['price'];
                    ge("Motorhaube", "rowMotorhaube", "hst_Motorhaube", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_motorhaube = $GLOBALS['price'];
                    ge("Kofferraumdeckel", "rowKofferraumdeckel", "hst_Kofferraumdeckel", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_kofferraumdeckel = $GLOBALS['price'];
                    ge("PKW_Reifen", "rowPKW_Reifen", "hst_PKW_Reifen", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_pkw_reifen = $GLOBALS['price'];
                    ge("LKW_Reifen", "rowLKW_Reifen", "hst_LKW_Reifen", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_lkw_reifen = $GLOBALS['price'];
                    ge("Stahlkarosserie_Teile", "rowStahlkarosserie_Teile", "hst_Stahlkarosserie_Teile", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_stahlkarosserie_teile = $GLOBALS['price'];
                    ge("Plastikkarosserie_Teile", "rowPlastikkarosserie_Teile", "hst_Plastikkarosserie_Teile", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_plastikkarosserie_teile = $GLOBALS['price'];
                    ge("Carbonkarosserie_Teile", "rowCarbonkarosserie_Teile", "hst_Carbonkarosserie_Teile", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_carbonkarosserie_teile = $GLOBALS['price'];
                    ge("Stahlfahrgestell_Teile", "rowStahlfahrgestell_Teile", "hst_Stahlfahrgestell_Teile", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_stahlfahrgestell_teile = $GLOBALS['price'];
                    ge("Carbonfahrgestell_Teile", "rowCarbonfahrgestell_Teile", "hst_Carbonfahrgestell_Teile", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_carbonfahrgestell_teile = $GLOBALS['price'];
                    ge("Turbolader", "rowTurbolader", "hst_Turbolader", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_turbolader = $GLOBALS['price'];
                    ge("Federung", "rowFederung", "hst_Federung", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_federung = $GLOBALS['price'];
                    ge("Spezialfederung", "rowSpezialfederung", "hst_Spezialfederung", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_spezialfederung = $GLOBALS['price'];
                    ge("Fahrzeugbatterie", "rowFahrzeugbatterie", "hst_Fahrzeugbatterie", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_fahrzeugbatterie = $GLOBALS['price'];
                    ge("Auspuff", "rowAuspuff", "hst_Auspuff", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_auspuff = $GLOBALS['price'];
                    ge("Carbon", "rowCarbon", "hst_Carbon", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_carbon = $GLOBALS['price'];
                    ge("schwerer_Rumpf", "rowschwerer_Rumpf", "hst_schwerer_Rumpf", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_schwerer_rumpf = $GLOBALS['price'];
                    ge("Schiffsrumpf", "rowSchiffsrumpf", "hst_Schiffsrumpf", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_schiffsrumpf = $GLOBALS['price'];
                    ge("schwerer_Bootsaufbau", "rowschwerer_Bootsaufbau", "hst_schwerer_Bootsaufbau", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_schwerer_bootsaufbau = $GLOBALS['price'];
                    ge("Schiffsaufbau", "rowSchiffsaufbau", "hst_Schiffsaufbau", $mysql, $price_sack_kunststoffgranulat, $price_eisenbarren, $price_elektronikbauteil, $price_stahlbarren, $price_gummi, $price_rolle_stoff, $price_rolle_pappe, $price_kupferbarren, $price_carbon, $price_platte_faser_kunststoff_verbund, $price_sack_kohlefasern, $price_holzbrett, $price_leder, $price_sack_glasgranulat, $price_seil, $price_tube_roter_farbstoff, $price_tube_blauer_farbstoff, $price_tube_grüner_farbstoff);
                    $endprice_schiffsaufbau = $GLOBALS['price'];
                    $GLOBALS['price'] = 0;

                    while ($rowCar = $stmtCar->fetch()) {
                        $bild = $rowCar["Bilds"];
                        #Sack_Kunststoffgranulat
                        if ($rowCar["Sack_Kunststoffgranulat"] != 0) {
                            $fullprice = $rowCar["Sack_Kunststoffgranulat"] * $price_sack_kunststoffgranulat["price"];
                        }
                        #Elektronikbauteil
                        if ($rowCar["Elektronikbauteil"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Elektronikbauteil"] * $price_elektronikbauteil["price"]);
                        }
                        #Eisenbarren
                        if ($rowCar["Eisenbarren"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Eisenbarren"] * $price_eisenbarren["price"]);
                        }
                        #Stahlbarren
                        if ($rowCar["Stahlbarren"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Stahlbarren"] * $price_stahlbarren["price"]);
                        }
                        #Gummi
                        if ($rowCar["Gummi"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Gummi"] * $price_gummi["price"]);
                        }
                        #Rolle_Stoff
                        if ($rowCar["Rolle_Stoff"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Rolle_Stoff"] * $price_rolle_stoff["price"]);
                        }
                        #Rolle_Pappe
                        if ($rowCar["Rolle_Pappe"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Rolle_Pappe"] * $price_rolle_pappe["price"]);
                        }
                        #Kupferbarren
                        if ($rowCar["Kupferbarren"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Kupferbarren"] * $price_kupferbarren["price"]);
                        }
                        #Holzbrett
                        if ($rowCar["Holzbrett"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Holzbrett"] * $price_holzbrett["price"]);
                        }
                        #Leder
                        if ($rowCar["Leder"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Leder"] * $price_leder["price"]);
                        }
                        #Sack_Glasgranulat
                        if ($rowCar["Sack_Glasgranulat"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Sack_Glasgranulat"] * $price_sack_glasgranulat["price"]);
                        }
                        #Seil
                        if ($rowCar["Seil"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Seil"] * $price_seil["price"]);
                        }
                        #Tube_roter_Farbstoff
                        if ($rowCar["Tube_roter_Farbstoff"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Tube_roter_Farbstoff"] * $price_tube_roter_farbstoff["price"]);
                        }
                        #Tube_blauer_Farbstoff
                        if ($rowCar["Tube_blauer_Farbstoff"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Tube_blauer_Farbstoff"] * $price_tube_blauer_farbstoff["price"]);
                        }
                        #Tube_grüner_Farbstoff
                        if ($rowCar["Tube_grüner_Farbstoff"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Tube_grüner_Farbstoff"] * $price_tube_grüner_farbstoff["price"]);
                        }
                        #Silberbarren
                        if ($rowCar["Silberbarren"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Silberbarren"] * $price_silberbarren["price"]);
                        }
                        #Goldbarren
                        if ($rowCar["Goldbarren"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Goldbarren"] * $price_goldbarren["price"]);
                        }
                        #Diamant
                        if ($rowCar["Diamant"] != 0) {
                            $diamondfull = $diamondfull + ($rowCar["Diamant"] * $price_diamant["price"]);
                            $diamo = $rowCar["Diamant"];
                            $playerDiamonds = $_POST["giveDiamonds"];
                            $numSes = "GB-" . $random;
                            $insertDiamonds = $mysql->prepare("UPDATE ordernumber SET diamonds = '$diamo', playerdiamonds = '$playerDiamonds' WHERE auftrag = '$numSes'");
                            $insertDiamonds->execute();
                        }
                        #Rubin
                        if ($rowCar["Rubin"] != 0) {
                            $rubi = $rowCar["Rubin"];
                            $playerRubys = $_POST["giveRubys"];
                            $insertRubys = $mysql->prepare("UPDATE ordernumber SET rubys = '$rubi', playerrubys = '$playerRubys' WHERE auftrag = '$numSes'");
                            $insertRubys->execute();
                            $rubyfull = $rubyfull + ($rowCar["Rubin"] * $price_rubin["price"]);
                        }
                        #Carbon
                        if ($rowCar["Carbon"] != 0) {

                            $fullprice = $fullprice + ($rowCar["Carbon"] * $endprice_carbon);
                        }
                        #Fahrzeugsitz
                        if ($rowCar["Fahrzeugsitz"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Fahrzeugsitz"] * $endprice_fahrzeugsitz);
                        }

                        #Carbon_Rennsitz
                        if ($rowCar["Carbon_Rennsitz"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Carbon_Rennsitz"] * $endprice_carbon_rennsitz);
                        }
                        #Glasscheibe
                        if ($rowCar["Glasscheibe"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Glasscheibe"] * $endprice_glasscheibe);
                        }
                        #Fahrzeugtür
                        if ($rowCar["Fahrzeugtür"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Fahrzeugtür"] * $endprice_fahrzeugtür);
                        }
                        #Motorhaube
                        if ($rowCar["Motorhaube"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Motorhaube"] * $endprice_motorhaube);
                        }
                        #Kofferraumdeckel
                        if ($rowCar["Kofferraumdeckel"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Kofferraumdeckel"] * $endprice_kofferraumdeckel);
                        }
                        #PKW_Reifen
                        if ($rowCar["PKW_Reifen"] != 0) {
                            $fullprice = $fullprice + ($rowCar["PKW_Reifen"] * $endprice_pkw_reifen);
                        }
                        #LKW_Reifen
                        if ($rowCar["LKW_Reifen"] != 0) {
                            $fullprice = $fullprice + ($rowCar["LKW_Reifen"] * $endprice_lkw_reifen);
                        }
                        #Stahlkarosserie_Teile
                        if ($rowCar["Stahlkarosserie_Teile"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Stahlkarosserie_Teile"] * $endprice_stahlkarosserie_teile);
                        }
                        #Plastikkarosserie_Teile
                        if ($rowCar["Plastikkarosserie_Teile"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Plastikkarosserie_Teile"] * $endprice_plastikkarosserie_teile);
                        }
                        #Carbonkarosserie_Teile
                        if ($rowCar["Carbonkarosserie_Teile"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Carbonkarosserie_Teile"] * $endprice_carbonkarosserie_teile);
                        }
                        #Stahlfahrgestell_Teile
                        if ($rowCar["Stahlfahrgestell_Teile"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Stahlfahrgestell_Teile"] * $endprice_stahlfahrgestell_teile);
                        }
                        #Carbonfahrgestell_Teile
                        if ($rowCar["Carbonfahrgestell_Teile"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Carbonfahrgestell_Teile"] * $endprice_carbonfahrgestell_teile);
                        }
                        #Turbolader
                        if ($rowCar["Turbolader"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Turbolader"] * $endprice_turbolader);
                        }
                        #Federung
                        if ($rowCar["Federung"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Federung"] * $endprice_federung);
                        }
                        #Spezialfederung
                        if ($rowCar["Spezialfederung"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Spezialfederung"] * $endprice_spezialfederung);
                        }
                        #Fahrzeugbatterie
                        if ($rowCar["Fahrzeugbatterie"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Fahrzeugbatterie"] * $endprice_fahrzeugbatterie);
                        }
                        #Auspuff
                        if ($rowCar["Auspuff"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Auspuff"] * $endprice_auspuff);
                        }
                        #schwerer_Rumpf
                        if ($rowCar["schwerer_Rumpf"] != 0) {
                            $fullprice = $fullprice + ($rowCar["schwerer_Rumpf"] * $endprice_schwerer_rumpf);
                        }
                        #Schiffsrumpf
                        if ($rowCar["Schiffsrumpf"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Schiffsrumpf"] * $endprice_schiffsrumpf);
                        }
                        #schwerer_Bootsaufbau
                        if ($rowCar["schwerer_Bootsaufbau"] != 0) {
                            $fullprice = $fullprice + ($rowCar["schwerer_Bootsaufbau"] * $endprice_schwerer_bootsaufbau);
                        }
                        #Schiffsaufbau
                        if ($rowCar["Schiffsaufbau"] != 0) {
                            $fullprice = $fullprice + ($rowCar["Schiffsaufbau"] * $endprice_schiffsaufbau);
                        }
                    }
                    $endprice_top = number_format(((($fullprice * $draufrechner) * $steuern) + 500), 2, ".", "");
                    $motorsize = $_POST["motorsize"];
                    $maxmotor = $_POST["maxmotor"];
                    $status = $_POST["status"];
                    $rRandom = "GB-" . $random;
                    $insert = $mysql->prepare("UPDATE ordernumber SET preis = '$endprice_top', motorsize = '$motorsize', maxmotor = '$maxmotor', baustatus = '$status' WHERE auftrag = '$rRandom'");
                    $insert->execute();
                    $rubyfull = 0;
                    $diamondfull = 0;
                    $fullprice = 0;
                }
            } else {
                echo "diese Person ist nicht im System hinterlegt!<br>";
                echo "<a href='membercard.php'>Klicke HIER zum hinzufügen</a>";
            }
        }
        echo $numSe . "<br>";
        echo $userLogin . "<br>";
        echo $_POST["name"] . "<br>";
        echo $_POST["carname"] . "<br>";
        echo $_POST["maxmotor"] . "<br>";
        echo $_POST["giveDiamonds"] . "<br>";
        echo $_POST["giveRubys"] . "<br>";
        echo $motorsize . "<br>";
        echo $endprice_top . "<br>";
        $endprice_top = 0;

        ?>
    </main>
</body>

</html>