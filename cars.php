<?php
header('Content-Type: text/html; charset=utf-8');
require("admin/mysql.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/style/carlist.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <style>

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Header -->
    <header>
        <nav id="nav-1">
            <ul>
                <li onclick="sendTo('index.php')">STARTSEITE</li>
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
    <section class="titleGame">
        <div class="filter"></div>
        <img id="logo" src="assets/images/logo.png" alt="">
        <div class="game" onclick="sendTo('game.php')">
            <h1>Du hast es satt nach STVO zu<br>fahren? Spiele jetzt <span class="playgame">SPEEDY DRIVE</span>!<br><span class="playnow">JETZT SPIELEN</span></h1>
        </div>
    </section>
    <div id="navi">
        <div class="input-group" id="seach-form">
            <label id="labels" style="z-index: 999;">Fahrzeugname </span><span class="pointes">. . .</span></label>
            <input type="text" id="seach-input" class="form-control" aria-autocomplete="list" style="z-index: 990;" spellcheck="false" autocomplete="off" type="text" name="id" onkeyup="checkLabel('labels', this)" onkeydown="checkLabel('labels', this)">
        </div>
        <div class="wrapper">
            <select class="select" id="select1" onchange="comboFunction()" data-select2-id="sitze" tabindex="-1" aria-hidden="true">
                <option value="" data-select2-id="4">alle Sitzplätze</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
            </select>
            <select class="select" id="select2" onchange="comboFunction()" data-select2-id="treibstoff" tabindex="-1" aria-hidden="true">
                <option value="" data-select2-id="6">jeder Kraftstoff</option>
                <option value="benzin">Benzin</option>
                <option value="diesel">Diesel</option>
            </select>
            <select class="select" id="select3" onchange="comboFunction()" data-select2-id="kategorie" tabindex="-1" aria-hidden="true">
                <option value="" data-select2-id="8">alle Kategorien</option>
                <option value="Anhänger">Anhänger</option>
                <option value="Boote">Boote</option>
                <option value="Coupes">Coupes</option>
                <option value="Emergency">Einsatzfahrzeuge</option>
                <option value="Fahrrad">Fahrräder</option>
                <option value="Hybrid">Hybrid</option>
                <option value="Kompaktfahrzeug">Kompaktfahrzeuge</option>
                <option value="Limousine">Limousine</option>
                <option value="LKW">LKW</option>
                <option value="Motorrad">Motorräder</option>
                <option value="Muscle Car">Muscle Car</option>
                <option value="Off-Road">Off-Road</option>
                <option value="PKW">PKW</option>
                <option value="Roller">Roller</option>
                <option value="Service">Service</option>
                <option value="Sport Klassik">Sport Klassiker</option>
                <option value="Sportwagen">Sport Fahrzeuge</option>
                <option value="Super Sportler">Super Sportler</option>
                <option value="SUV">SUV's</option>
                <option value="Utility">Nutzfahrzeuge</option>
                <option value="Van">Van's</option>
            </select>
        </div>
    </div>

    <main>
        <article id="main">

        </article>
    </main>
    <script src="assets/javascript/input.js"></script>
    <script>
        var myArray = [
            <?php
            $insertCars = $mysql->prepare("SELECT * FROM carlist ORDER BY Carname ASC");
            $insertCars->execute();
            while ($insertRow = $insertCars->fetch()) {
            ?> {
                    'carname': '<?php echo $insertRow["Fullcar"] ?>',
                    'kraftstoff': '<?php echo $insertRow["Kraftstoff"] ?>',
                    'kategorie': '<?php echo $insertRow["Kategorie"] ?>',
                    'ps1': '<?php echo $insertRow["HP1"] ?>',
                    'ps2': '<?php echo $insertRow["HP2"] ?>',
                    'ps3': '<?php echo $insertRow["HP3"] ?>',
                    'ps4': '<?php echo $insertRow["HP4"] ?>',
                    'kofferraum': '<?php echo $insertRow["Kofferraum"] ?>',
                    'sitzanzahl': '<?php echo $insertRow["Sitzanzahl"] ?>',
                    'tankvolumen': '<?php echo $insertRow["Tank"] ?>',
                    'geschwindigkeit': '<?php echo $insertRow["Geschwindigkeit"] ?>',
                    'bild': '<?php echo $insertRow["Bilds"] ?>'
                },
            <?php
            }
            ?>
        ]
        var inter;

        function nachladen() {
            $("#seach-input").on("keyup", function() {
                if ($("#seach-input").val() == "") {
                    var value = utf8_encode($string);
                    var data = seachTable(value, myArray);
                    buildTable(data, 410);
                } else {
                    var value = $("#seach-input").val();
                    var data = seachTable(value, myArray);
                    buildTable(data, 150);
                }
            });
            $(".select").on("change", function() {
                if ($("#seach-input").val() == "") {
                    var value = $("#seach-input").val();
                    var data = seachTable(value, myArray);
                    buildTable(data, value.length);
                } else if ($("#seach-input").val() != "") {
                    var value = $("#seach-input").val();
                    var data = seachTable(value, myArray);
                    buildTable(data, 150);
                }

            });
            var main = document.getElementById('main');

            function seachTable(value, data) {
                var filteredData = [];

                for (let i = 0; i < data.length; i++) {
                    value = value.toLowerCase();
                    var name = data[i].carname.toLowerCase();
                    var sitz = data[i].sitzanzahl.toLowerCase();
                    var kraftstoff = data[i].kraftstoff.toLowerCase();
                    var katego = data[i].kategorie.toLowerCase();

                    var sitzvalue = $("#select1").val();
                    var kraftstoffvalue = $("#select2").val();
                    var kategorievalue = $("#select3").val().toLowerCase();
                    if (name.includes(value) && sitz.includes(sitzvalue) && !sitz.includes(-1) && kraftstoff.includes(kraftstoffvalue) && katego.includes(kategorievalue)) {
                        filteredData.push(data[i]);
                    }


                }
                return filteredData;
            }

            function loa() {
                var value = $("#seach-input").val();
                var data = seachTable(value, myArray);
                buildTable(data, 410);
            }
            loa();
        };

        function buildTable(data, load) {
            clearInterval(inter);
            main.innerHTML = '';
            let i = 0;
            inter = setInterval(function() {
                if (i < data.length) {
                    if (data[i].kofferraum == undefined) {
                        return false;
                    }
                    if (data[i].kofferraum == -1) {
                        data[i].kofferraum = "Unbekannt";
                    }
                    if (data[i].sitzanzahl == -1) {
                        data[i].sitzanzahl = "Unbekannt";
                    }
                    if (data[i].tankvolumen == -1) {
                        data[i].tankvolumen = "Unbekannt";
                    }
                    if (data[i].kraftstoff == -1) {
                        data[i].kraftstoff = "Unbekannt";
                    }
                    if (data[i].geschwindigkeit == -1 || data[i].geschwindigkeit == undefined || data[i].geschwindigkeit == "") {
                        data[i].geschwindigkeit = "Unbekannt";
                    }
                    if (data[i].geschwindigkeit == -2) {
                        data[i].geschwindigkeit = "So schnell wie deine Beine können";
                    }
                    if (data[i].ps1 == 0) {
                        data[i].ps1 = "";
                    }
                    if (data[i].ps2 == 0) {
                        data[i].ps2 = "";
                    }
                    if (data[i].ps3 == 0) {
                        data[i].ps3 = "";
                    }
                    if (data[i].ps4 == 0) {
                        data[i].ps4 = "";
                    }
                    var row = `<div class='car'>
                    <aside class="imgs" style=" background-image: url('${data[i].bild}')" alt=""></aside>
                          
                        <p class="info0">${data[i].carname}</p>
                        <p class="info1">Kraftstoff: ${data[i].kraftstoff}</p>
                        <p class="info1">Kategorie: ${data[i].kategorie}</p>
                        <div class="carinfo">
                        <p>Kofferraum: ${ data[i].kofferraum }</p>
                        <p>Sitze: ${data[i].sitzanzahl}</p>
                        <p>Tank: ${data[i].tankvolumen} </p>
                        <p>KMH (~): ${data[i].geschwindigkeit}</p>
                        </div>    
                        <ul class="motor">
                        <li>${data[i].ps1}</li>
                        <li>${data[i].ps2}</li>
                        <li>${data[i].ps3}</li>
                        <li>${data[i].ps4}</li>
                        </ul>
                        

                        
                        
        
                        
                   </div>`
                    i++;
                    main.innerHTML += row;
                } else {
                    i = 0;
                    clearInterval(inter);

                }
            }, 0.1);

        }
        nachladen();
    </script>
    <script>
        function sendTo(site) {
            window.location.href = site;
        }
    </script>
</body>

</html>