<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandBanks</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/style/rentallist.css">
</head>

<body>
    <!-- Header -->
    <div class="header">
        <nav id="nav-1">
            <ul>
                <li onclick="sendTo('index.php')">STARTSEITE</li>
                <li onclick="sendTo('cars.php')">FAHRZEUGSUCHE</li>
                <li>ÜBER UNS</li>
            </ul>
        </nav>
        <nav id="nav-2">
            <ul>
                <li>Inhaber</li>
                <li>Zertifiziert</li>
                <li>Unser Standort</li>
            </ul>
        </nav>
    </div><!-- end of Header -->
    <!-- Main-section -->
    <section class="titleGame">
        <div class="filter"></div>
        <img id="logo" src="assets/images/logo.png" alt="">
        <div class="game" onclick="sendTo('game.php')">
            <h1>Lorem ipsum dolor sit amet consectetur,<br>adipit quibusdam, diadja<br>diajdad kdaodka dkaoka foafao fkaof.<br>1822 123 456 78</h1>
        </div>
    </section>
    <main>
        <?php
        require("admin/mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM rental");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $carname = $row["CARNAME"];
            $slctCar = $mysql->prepare("SELECT * FROM carlist WHERE Fullcar = '$carname'");
            $slctCar->execute();
            $fetchCar = $slctCar->fetch();
        ?>
            <div class="carsect">
                <div class="cardiv">
                    <h1 class="carname"><?php echo $row["CARNAME"] . " / " . $row["HORSEPOWER"] ?>PS <span class="carspan">oder vergleichbar</span></h1>
                    <h1 class="carkategorie"><?php echo $fetchCar["Kategorie"] ?></h1>
                    <div class="img" style="background-image: url(<?php echo $row["IMAGET"] ?>);"></div>
                </div>
                <ul class="carinfos">
                    <li class="coa"><?php echo $fetchCar["Kofferraum"] ?> KG</li>
                    <li class="col"></li>
                    <li class="coa"><?php echo $fetchCar["Sitzanzahl"] ?> Sitze</li>
                    <li class="col"></li>
                    <li class="coa"><?php echo $fetchCar["Tank"] ?> Liter / <?php echo $fetchCar["Kraftstoff"] ?></li>
                </ul>
                <ul class="rentalinfos">
                    <?php
                    if ($row["ISRENTAL"] == 0) {
                    ?>
                        <li>Abholort:<span><br>O.O.T. am Pier</span></li>
                    <?php
                    } else {
                        $until = $mysql->prepare("SELECT * FROM memberrental WHERE CARID = $row[ID]");
                        $until->execute();
                        $endSetter;
                        while ($untilRow = $until->fetch()) {
                            $endDatum = $untilRow["LENTEND"];
                            $endSetter = date("d.m.Y", $endDatum);
                        }
                    ?>
                        <li>Wieder Verfügbar:<span><br><?php echo $endSetter ?></span></li>
                    <?php
                    }
                    ?>
                    <li>Tankregelung:<span><br>Voll - Voll</span></li>
                    <li>Kilometeranzahl:<span><br>Unbegrenzt</span></li>
                </ul>
                <div class="price">
                    <h3 class="week">$<?php echo $row["WEEK"] ?> pro Woche</h3>
                    <h3 class="day">$<?php echo $row["DAYT"] ?> / Tagespreis</h3>
                </div>
                <div class="status">
                    <?php
                    if ($row["ISRENTAL"] == 0) {
                    ?>
                        <span class="state verfügbar"><span class="text">Verfügbar</span>
                            <div class="triangle-up-left o"></div>
                        </span>

                    <?php
                    } else {
                    ?>
                        <span class="state vergeben"><span class="text">Vergeben</span>
                            <?php
                            ?>
                            <div class="triangle-up-left t"></div>
                        </span>
                    <?php
                    }

                    ?>

                </div>

            </div>
        <?php
        }
        ?>
    </main>
    <script>
        function sendTo(site) {
            window.location.href = site;
        }
    </script>
</body>

</html>