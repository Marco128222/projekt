<?php
if (isset($_GET["seach-order"])) {
    require("admin/mysql.php");
            $auftragsnummer = $_GET["id"];
            $stmt = $mysql->prepare("SELECT * FROM ordernumber WHERE auftrag = '$auftragsnummer'");
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count != 0) {
                header("location: ordernumber.php?id=$auftragsnummer");
            }
            else {
                header("location: index.php");
            }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link rel="preload" href="assets/fonts/acura_bespoke-regular.woff" as="font" type="font/woff" crossorigin="anonymous">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/style/index.css">
    <link rel="stylesheet" href="assets/style/slider.css">
    <title>GrandBanks | Startseite</title>
</head>

<body style="overflow-x: hidden;">
    <!-- Header -->
    <header>
        <nav id="nav-1">
            <ul>
                <li onclick="sendTo('cars.php')">FAHRZEUGSUCHE</li>
                <li onclick="sendTo('rentallist.php')">VERMIETUNG</li>
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
    </header><!-- end of Header -->
    <!-- Main-section -->
    <div id="div">
        <img id="logo" src="assets/images/logo.png" alt="">
    </div>

    <main>
        <div class="head-section slideshow-container" id="slide">
            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="https://cdn.discordapp.com/attachments/632252009755574304/732665735389773835/image0.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="https://cdn.discordapp.com/attachments/632252009755574304/732689730885386414/ferrari_Screen_2184.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="https://cdn.discordapp.com/attachments/632252009755574304/732689132173787186/20200221203214_1-2.jpg" style="width:100%">
            </div>
        </div>

        <div class="center-section">
            <div class="wrapper-middle-items">
                <div class="item" id="item-1" onclick="sendTo('cars.php')">
                    <div class="shader" id="shader-1">
                        <h3 class="shadertext">alle Fahrzeuge</h3>
                    </div>
                    <p id="p1">alle Fahrzeuge</p>
                </div>
                <div class="item" id="item-2" onclick="sendTo('rentallist.php')">
                    <div class="shader" id="shader-2">
                        <h3 class="shadertext">Fahrzeugvermietung</h3>
                    </div>
                    <p id="p2">Fahrzeugvermietung</p>
                </div>
                <p class="p-head">BUILD A CAR</p>
                <div class="acr-underheading"></div>
                <h1 class="h1-head">Haben Sie einen Auftrag bei uns?</h1>
            </div>
        </div>
        <div class="order-section">
            <form action="index.php" method="get" id="seach-form" autocomplete="off">
                <div class="input-group" id="seachbar">
                    <label id="labels" style="z-index: 999;">Auftragsnummer eingeben </span><span class="pointes">. . .</span></label>
                    <input aria-autocomplete="list" style="z-index: 990;" class="autocomplete" spellcheck="false" autocomplete="off" type="text" name="id" onkeyup="checkLabel('labels', this)" onkeydown="checkLabel('labels', this)" id="inputs">
                    <input type="submit" value="🔍" name="seach-order" id="seach-order">
                </div>
            </form>
        </div>
        <div class="info-section" id="scroll">
            <div class="filter"></div>
            <img src="assets/images/kredit.jpg" alt="">
            <h1>Finanzierung gefällig?<br>Bei uns erhalten Sie eine<br>FAIRE und KOMPFORTABLE Finanzierung<br>für Ihr NEUES Auto!</h1>
        </div>
    </main>
    <!-- end of Main-section -->
    <footer>
        <h1>GRAND BANKS STEEL INC. | © 2020</h1>
    </footer>
    <script>
        function sendTo(site) {
            window.location.href = site;
        }
        window.addEventListener("scroll", function() {
            if (window.scrollY != 0) {
                document.getElementById("slide").style.opacity = "30%";
            } else {
                document.getElementById("slide").style.opacity = "100%";
            }
        });
    </script>
    <script src="assets/javascript/input.js"></script>
    <script src="assets/javascript/switchimages.js"></script>
    <script>
        setInterval(function() {
            currentSlide(1);

        }, 15000);
        setInterval(function() {
            currentSlide(2);

        }, 30000);
        setInterval(function() {
            currentSlide(3);

        }, 45000);
    </script>
</body>

</html>