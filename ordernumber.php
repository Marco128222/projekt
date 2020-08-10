<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="stylesheet" href="assets/style/ordernumber.css">
    <title>GrandBanks | Auftragsverfolgung</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="filterBody"></div>
    <!-- Header -->
    <div class="header">
        <li><a href="index.php">STARTSEITE</a></li>
        <a href="index.php"><img src="assets/images/logo.png" alt="" class="logo"></a>
        <li><a href="contact.php">KONTAKT</a></li>
    </div><!-- end of Header -->
    <!-- Main-section -->
    <main>
        <?php
        require("admin/mysql.php");
        $auftragsnummer = $_GET["id"];
        $stmt = $mysql->prepare("SELECT * FROM ordernumber WHERE auftrag = '$auftragsnummer'");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) {
            // Auto vorhanden
            while ($row = $stmt->fetch()) {
        ?>
                <div style="color: white;">
                    <article style="margin-top: 3vw;width: 100%; text-align: center; position: relative; display: flex; justify-content: center;">
                        <div class="tpas" style="position: relative; width: 40vw; ">
                            <h1 id="carnameH1" style="position: absolute;"><span class="gbName"><?php echo $row["Autoname"] ?></span> <span class="gbNumber"><?php echo $row["auftrag"] ?></span></h1>
                            <?php
                            $carfull = $row["Autoname"];
                            $car = $mysql->prepare("SELECT * FROM carlist WHERE fullcar = '$carfull'");
                            $car->execute();
                            while ($carlist = $car->fetch()) {
                                $img = $carlist["Bilds"];
                            ?>
                                <img src="<?php echo $img ?>" alt="" class="image">
                                <?php
                                if ($row["motorsize"] == "h4") {
                                ?>
                                    <h1 class="motorSize"><?php echo $carlist["HP4"] ?>PS</h1>
                                <?php
                                } else if ($row["motorsize"] == "h3") {
                                ?>
                                    <h1 class="motorSize"><?php echo $carlist["HP3"] ?>PS</h1>
                                <?php
                                } else if ($row["motorsize"] == "h2") {
                                ?>
                                    <h1 class="motorSize"><?php echo $carlist["HP2"] ?>PS</h1>
                                <?php
                                } else if ($row["motorsize"] == "h1") {
                                ?>
                                    <h1 class="motorSize"><?php echo $carlist["HP1"] ?>PS</h1>
                            <?php
                                }
                            }
                            ?>
                            <div style="top: -0.5vw; font-family: Arial, Helvetica, sans-serif; padding: 10px; position: relative; font-size: 1.2vw; background-color: #881238; display: flex; justify-content: space-between;">
                                <h3 style="position: relative;">Kunde:<?php echo $row["spielername"] ?></h3>
                                <h3 style="position: relative; right: 0;">Bearbeiter: Arturo_Gonzalez</h3>
                            </div>

                        </div>

                    </article>
                    <article class="rechnung" style="margin: auto; margin-top: 5vw; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 1.3em; position: relative; display: inline-block; width: 35vw; left: 22.5vw;">
                        <div style="box-shadow: 0 0 20px 5px rgba(0, 0, 0, .65);">
                            <h4>Diamanten dazugegeben: <?php echo $row["playerdiamonds"] ?></h4>
                            <h4 class="border">Rubine dazugegeben: <?php echo $row["playerrubys"] ?></h4>
                        </div>

                        <div style="box-shadow: 0 0 20px 5px rgba(0, 0, 0, .65);">
                            <h4>Max. Motor-Preis: <?php echo $row["maxmotor"] ?>$</h4>
                            <h4>Motor-Preis: <?php echo $row["motor"] ?>$</h4>
                            <h4 class="border">Differenz: <?php echo ($row["maxmotor"] - $row["motor"]) ?>$</h4>
                        </div>

                        <div style="box-shadow: 0 0 20px 5px rgba(0, 0, 0, .65);">
                            <h4>Edelsteinpreis:
                                <?php
                                $_diamant = $mysql->prepare("SELECT price FROM pricelist WHERE id='20'");
                                $_diamant->execute();
                                $price_diamant = $_diamant->fetch();

                                $_rubin = $mysql->prepare("SELECT price FROM pricelist WHERE id='21'");
                                $_rubin->execute();
                                $price_rubin = $_rubin->fetch();
                                $diamondfull = ($row["diamonds"] - $row["playerdiamonds"]);
                                $rubyfull = ($row["rubys"] - $row["playerrubys"]);
                                $diaprice = $diamondfull * $price_diamant["price"];;
                                $rubyprice = $rubyfull * $price_rubin["price"];;

                                echo ($diaprice + $rubyprice) . "$";

                                ?>
                            </h4>
                            <h4 class="border">Baupreis: <?php echo ($row["preis"] . "$") ?></h4>
                        </div>

                        <div style="box-shadow: 0 0 20px 5px rgba(0, 0, 0, .65);">
                            <h4 class="border">Gesamt: <?php echo ($row["preis"] + ($diaprice + $rubyprice) . "$"); ?></h4>
                        </div>

                    </article>



                    <article class="statusCount" style="left: 7.5vw;">
                        <?php if ($row["baustatus"] == "status1") {
                        ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle" style="left: 15%;"></div>
                            <div class="line" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle" style="left: 30%;"></div>
                            <div class="line" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle" style="left: 45%;"></div>
                            <div class="line" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle" style="left: 60%;"></div>
                            <div class="line" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        } else if ($row["baustatus"] == "status2") {
                        ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle circleActive" style="left: 15%;"></div>
                            <div class="line lineActive" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle" style="left: 30%;"></div>
                            <div class="line" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle" style="left: 45%;"></div>
                            <div class="line" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle" style="left: 60%;"></div>
                            <div class="line" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        } else if ($row["baustatus"] == "status3") {
                        ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle circleActive" style="left: 15%;"></div>
                            <div class="line lineActive" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle circleActive" style="left: 30%;"></div>
                            <div class="line lineActive" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle" style="left: 45%;"></div>
                            <div class="line" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle" style="left: 60%;"></div>
                            <div class="line" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        } else if ($row["baustatus"] == "status4") {
                        ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle circleActive" style="left: 15%;"></div>
                            <div class="line lineActive" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle circleActive" style="left: 30%;"></div>
                            <div class="line lineActive" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle circleActive" style="left: 45%;"></div>
                            <div class="line lineActive" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle" style="left: 60%;"></div>
                            <div class="line" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        } else if ($row["baustatus"] == "status5") {
                        ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle circleActive" style="left: 15%;"></div>
                            <div class="line lineActive" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle circleActive" style="left: 30%;"></div>
                            <div class="line lineActive" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle circleActive" style="left: 45%;"></div>
                            <div class="line lineActive" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle circleActive" style="left: 60%;"></div>
                            <div class="line lineActive" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        } else if ($row["baustatus"] == "status6") {   ?>
                            <!-- Offen -->
                            <div class="circle circleActive" style="left: 0%;" id="tp"></div>
                            <div class="line lineActive" style="left: 4%;"></div>
                            <!-- Warte auf Motor -->
                            <div class="circle circleActive" style="left: 15%;"></div>
                            <div class="line lineActive" style="left: 19%;"></div>
                            <!-- Warteschlange -->
                            <div class="circle circleActive" style="left: 30%;"></div>
                            <div class="line lineActive" style="left: 34%;"></div>
                            <!-- In Bau -->
                            <div class="circle circleActive" style="left: 45%;"></div>
                            <div class="line lineActive" style="left: 49%;"></div>
                            <!-- Abholbereit -->
                            <div class="circle circleActive" style="left: 60%;"></div>
                            <div class="line lineActive" style="left: 64%;"></div>
                            <!-- Abgeschlossen -->
                            <div class="circle circleActive" style="left: 75%;"></div>
                            <div style="height: 5vw;"></div>
                        <?php
                        }
                        ?>
                        <ul class="infoBox">
                            <li style="left: 7%; position: relative;">Offen</li>
                            <li style="left: 0.7%; position: relative;">Warte auf Motor</li>
                            <li style="left: -10%; position: relative;">Warteschlange</li>
                            <li style="left: -20%; position: relative;">Im Bau</li>
                            <li style="left: -27.5%; position: relative;">Abholbereit</li>
                        </ul>
                    </article>
                </div>
            <?php
            }
        }

        ?>
    </main>
</body>

</html>