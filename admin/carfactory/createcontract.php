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
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code hinzufügen</title>
</head>

<body>
    <button><a href="../homepage.php">Startseite</a></button>

    <form action="preparecontract.php" method="post" autocomplete="off">
        <div class="autocomplete" style="width:300px;">
            <input type="text" id="name" placeholder="Vorname_Nachname / Firma" name="name">
            <input id="carnames" type="text" name="carname" placeholder="Autoname">
            <input id="maxmotor" type="number" name="maxmotor" placeholder="Maximale Motorkosten">
            <input style="z-index: 1;" id="giveDiamonds" type="number" name="giveDiamonds" placeholder="Diamanten abgegeben? wieviele">
            <input style="z-index: 1;" id="giveRubys" type="number" name="giveRubys" placeholder="Rubine abgegeben? wieviele">
            <select name="rabatt" id="rabatt">
                <option value="0p">0%</option>
                <option value="5p">5%</option>
                <option value="10p">10%</option>
            </select>
            <select name="motorsize" id="motorsize">
                <option value="h4">4 Stufe</option>
                <option value="h3">3 Stufe</option>
                <option value="h2">2 Stufe</option>
                <option value="h1">1 Stufe</option>
            </select>
            <select name="status" id="status">
                <option value="status1">offen</option>
                <option value="status2">Warte auf Motor</option>
                <option value="status3">Warteschlange</option>
                <option value="status4">In Bau</option>
                <option value="status5">Abholbereit</option>
                <option value="status6">Abgeschlossen</option>
            </select>
        </div>

        <input type="submit" value="Erstellen" name="submit" >
    </form>

    <?php
    
    ?>


    <script>
        var cars = ['Karin 190z', 'Volvo 242 1983', 'Nissan 350z', 'BMW 750i 1995', 'Pfister 811', 'Obey 9F', 'Obey 9F Cabrio', 'Audi A4 Quattro 2017', 'Truffade Adder', 'Brute Airport Bus', 'Albany Alpha', 'Brute Ambulance', 'Maxwell Asbo', 'Declasse Asea', 'Karin Asterope', 'Överflöd Autarch', 'Liberty City Cycles Avarus', 'Western Motorcycle Company Bagger', 'Gallivanter Baller', 'Gallivanter Baller (Sport)', 'Gallivanter Baller LE', 'Gallivanter Baller LE LWB', 'Bravado Banshee', 'Bravado Banshee 900R (Racing)', 'Pegassi Bati 800/Bati Custom', 'Karin BeeJay XL', 'Vapid Benson', 'Grotti Bestia GTS', 'HVY Biff', 'BF Bifta', 'Bravado Bison', 'Vapid Blade', 'Dinka Blista Kanjo', 'Dinka Blista Monkey', ' BMX', 'Vapid Bobcat XL', 'Canis Bodhi', 'Brute Boxville', 'Brute Brute Boxville Postal', 'Coil Brawler', 'Grotti Brioso R/A', 'Albany Buccaneer', 'Albany Buccaneer Custom', 'Bravado Buffalo (Race)', 'Bravado Buffalo S', 'Vapid Bullet', 'Declasse Burrito', 'Brute Bus', 'Mercedes Benz C63s AMG 2017', 'Chevrolet Camaro SS 2016', 'Brute Camper', 'Vapid Caracara 4x4', 'Nagasaki Carbon RS', 'Grotti Carbonizzare', 'Lampadati Casco', 'Albany Cavalcade 2nd Gen', 'Albany Cavalcade', 'Rune Cheburek', 'Grotti Cheetah', 'Grotti Cheetah Classic', 'Nagasaki Chimera', 'Vapid Chino', 'Vapid Chino Custom', 'Renault Clio 1993', 'Vapid Clique', 'Enus Cognoscenti', 'Enus Cognoscenti 55', 'Enus Cognoscenti Cabrio', 'Pfister Comet', 'Pfister Comet Retro Custom', 'Pfister Comet Safari', 'Pfister Comet SR', 'Invetero Coquette', 'Invetero Coquette BlackFin', 'Invetero Coquette Classic', ' Cruiser', 'Coil Cyclone', 'Western Motorcycle Company Daemon', 'Brute Dashound', 'Shitzu Defiler', 'Ducati Desmosedici RR', 'Schyster Deviant', 'Karin Dilettante', 'Nagasaki Dinghy', 'Vapid Dominator (Race)', 'Vapid Dominator', 'Vapid Dominator GTX', 'Obey Drafter', 'Declasse Drift Tampa (Racing)', 'Benefactor Dubsta 6x6', 'Benefactor Dubsta Sport Matt', 'Imponte Dukes', 'Bravado Duneloader', 'Weeny Dynasty', 'Annis Elegy Retro Custom', 'Annis Elegy RH8', 'Vapid Ellie', 'Progen Emerus', 'Albany Emperor', 'Albany Emperor Vintage', ' Endurex Race Bike', 'Dinka Enduro (Race)', 'Överflöd Entity XF', 'Överflöd Entity XXR', 'Pegassi Esskey', 'Emperor ETR1 (Racing)', 'Dewbauchee Exemplar', 'Ocelot F620', 'Willard Faction', 'Willard Faction Custom', 'Vulcar Fagaloa', 'Pegassi Faggio Modern', 'Principe Faggio Newschool', 'Principe Faggio Oldschool', 'Pegassi FCR 1000', 'Lampadati Felon', 'Lampadati Felon GT', 'Benefactor Feltzer', 'Bravado FIB Buffalo Unmarked', 'Stanley Fieldmaster', ' Fieldmaster Graintrailer', ' Fixter', 'Vapid FlashGT', 'MLT Flatbed', 'Vapid FMJ', 'Vapid FMJ', ' Formula', 'Fathom FQ 2', 'Cheval Fugitive', 'Grotti Furia', 'Lampadati Furore GT', 'Schyster Fusilade', 'Karin Futo', 'Mercedes Benz G65 AMG', 'Bravado Gauntlet', 'Bravado Gauntlet (Race)', 'Bravado Gauntlet Classic', 'Bravado Gauntlet Hellfire', 'Vapid GB200', 'Benefactor Glendale', 'VW Golf 2er 1983', 'VW Golf 7er 2012', 'Progen GP1', 'Declasse Granger', 'Declasse Granger Undercover SUV', 'Bravado Gresley', 'Lexus GS 350 2014 Medic', 'Porsche GT3 RS 2015', 'Grotti GT500', 'Vapid Guardian', 'Emperor Habanero', 'Shitzu Hakuchou', 'Jobuilt Hauler', 'Annis Hellion', 'Albany Hermes', 'Liberty City Cycles Hexer', 'Nagasaki Hot Rod Blazer', ' Hotring (Racing)', 'Enus Huntley S', 'Vapid Hustler', 'BMW i8 2019', 'Överflöd Imorgon', 'Chevrolet Impala SS Hard Top 1964', 'Declasse Impaler', 'Pegassi Infernus', 'Pegassi Infernus Classic', 'Vulcar Ingot', 'Vulcar Ingot', 'BF Injection', 'Karin Intruder', 'Weeny Issi Classic', 'Weeny Issi Sport', 'Progen Itali GTB', 'Progen Itali GTB Custom', 'Grotti Itali GTO', 'Ocelot Jackal', 'Dewbauchee JB7002', 'Dinka Jester', 'Dinka Jester (Racing)', 'Dinka Jester Classic', 'Mini John Cooper Works 2013', 'Zirconium Journey', 'Ocelot Jugular', 'Canis Kalahari', 'Canis Kamacho', 'Hijak Khamelion', 'Karin Kuruma', 'Ferrari LaFerrari 2015', 'Mitshubishi Lancer EVO 9', 'Dundreary Landstalker', 'Principe Lectro', 'Ocelot Locust', 'Ocelot Lynx', 'BMW M5 2018', 'Declasse Mamba', 'Albany Manana', 'Dewbauchee Massacro', 'Dewbauchee Massacro (Racing)', 'Canis Mesa/Merryweather Mesa', 'Lampadati Komoda', 'Lampadati Michelli', 'Vapid Minivan', 'Vapid Minivan Custom', 'HVY Mixer', 'Pegassi Monroe', 'Declasse Moonbeam', 'Declasse Moonbeam Custom', 'McLaren MP4 12C (Police)', 'Maibatsu Mule', 'Maibatsu Mule 2', 'Maibatsu Mule Special', 'Ford Mustang Boss 302 1969', 'Ford Mustang GT 2015', 'Ford Mustang GT Police 2015', 'Principe Nemesis', 'Vysser Neo', 'Pfister Neon', 'Truffade Nero', 'Truffade Nero Custom', 'Liberty Chop Chop Nightblade', 'Imponte Nightshade', 'Lampadati Novak', 'MTL Öl Tanker 2000', 'Obey Omnis', 'Übermacht Oracle', 'Übermacht Oracle XS', 'Pegassi Osiris', 'Nagasaki Outlaw', 'MTL Packer', 'Benefactor Panto', 'Bravado Paradise', 'Enus Paragon R', 'Ocelot Pariah', 'Declasse Park Ranger', 'Mammoth Patriot', 'Mammoth Patriot Stretch', 'Ocelot Penetrator', 'Maibatsu Penumbra', 'Vapid Peyote', 'Jobuilt Phantom', 'Jobuilt Phantom Custom', 'Imponte Phoenix', 'Cheval Picador', 'Lampadati Pigalle', 'Western Motorcycle Company Police Bike', 'Bravado Police Cruiser (Buffalo)', 'Vapid Police Cruiser', 'Vapid Police Cruiser Unmarked', 'Vapid Police Interceptor', 'Vapid Police Prison Bus', 'Declasse Police Rancher (Winter)', 'Brute Police Riot', 'Albany Police Roadcruiser (Winter)', 'Declasse Police Transporter', 'Brute Pony', 'MTL Pounder', 'Bollokan Prairie', 'Declasse Premier', 'Albany Primo Custom', 'Fiat Punto 2010', 'Vapid Radius', 'Coil Raiden', 'Dodge Ram 1500 2016', 'Declasse Rancher XL', 'Dewbauchee Rapid GT', 'Dewbauchee Rapid GT Cabrio', 'Dewbauchee Rapid GT Classic', 'BF Raptor', 'Western Motorcycle Company Rat Bike', 'Bravado Rat-Truck', 'Annis RE-7B (Racing)', 'Pegassi Reaper', 'Übermacht Rebla GTS', 'Dundreary Regina', 'Vapid Retinue', 'Vapid Retinue MK2', 'Übermacht Revolter', 'Declasse Rhapsody', 'Vapid Riata', 'Obey Rocoto', 'Chariot Romero Hearse', 'Albany Roosevelt', 'Albany Roosevelt Valor', 'Audi RS7 2015', 'Jobuilt Rubble', 'Pegassi Ruffian', 'Imponte Ruiner', 'Bravado Rumpo Custom', 'Hijak Ruston', 'Karin Rusty Rebel & Rebel', 'Mercedes Benz S500 2014', 'Mercedes Benz S600 220 1998', 'Declasse Sabre Turbo Custom', 'Vapid Sadler', 'Maibatsu Corporation Sanchez (Racing)', 'Liberty City Cycles Sanctus', 'Vapid Sandking SWB', 'Vapid Sandking', 'Annis Savestra', 'Übermacht SC1', 'Benefactor Schafter', 'Benefactor Schafter LWB', 'Benefactor Schafter V12', 'Benefactor Schlagen', 'Benefactor Schwartzer', ' Scorcher', 'Speedophile Seashark', 'Canis Seminole', 'Übermacht Sentinel', 'Übermacht Sentinel Classic', 'Übermacht Sentinel XS', 'Benefactor Serrano', 'Dewbauchee Seven-70', 'Ford Shelby Mustang GT500 1967', 'Vapid Sheriff Cruiser', 'Declasse Sheriff SUV', 'Nissan Skyline GT-R BNR34', 'Vapid Slamvan', 'Vapid Slamvan Custom', 'Western Motorcycle Company Sovereign', 'Dewbauchee Specter', 'Dewbauchee Specter Custom', 'Vapid Speedo', 'Declasse Stallion', 'Declasse Stallion (Race)', 'Vapid Stanier', 'Grotti Stinger', 'Grotti Stinger GT', 'Benefactor Stirling GT', 'Brute Stockade', 'Zirconium Stratum', 'Nagasaki Street Blazer', 'Benefactor Streiter', 'Albany Stretch', 'Dinka Sugoi', 'Karin Sultan', 'Karin Sultan Classic', 'Karin Sultan RS', 'Enus Super Diamond', 'Toyota Supra', 'Benefactor Surano', 'BF Surfer', 'Cheval Surge', 'Ocelot Swinger', 'Progen T20', 'Brute Taco Van', 'Obey Tailgater', 'Cheval Taipan', 'Declasse Tampa', ' Tanker 2', ' Tanker', 'Vapid Taxi', 'Pegassi Tempesta', 'Pegassi Tezeract', 'Vapid The Liberator (Racing)', 'Truffade Thrax', 'Dinka Thrust', 'Brute Tipper Second Generation', 'Pegassi Torero', 'Declasse Tornado', 'Declasse Tornado Custom', 'Pegassi Toros', 'Vapid Towtruck (Small)', 'Vapid Towtruck Large', ' Trailer Large', ' Trailer Logs', 'Jobuilt Trashmaster', ' Tri-Cycles Race Bike', 'Lampadati Tropos Rallye', 'Buckingham Tug', 'Declasse Tulip', 'Grotti Turismo Classic', 'Grotti Turismo R', 'Överflöd Tyrant', 'Progen Tyrus', 'Albany V-STR', 'Pegassi Vacca', 'Dewbauchee Vagner', 'Maxwell Vagrant', 'Declasse Vamos', 'Bravado Verlierer', 'Declasse Vigero', 'Dinka Vindicator', 'Albany Virgo', 'Dundreary Virgo Classic', 'Dundreary Virgo Classic Custom', 'Lampadati Viseris', 'Lampadati Viseris', 'Grotti Visione', 'Coil Voltic', 'Declasse Voodoo', 'Declasse Voodoo Custom', 'Pegassi Vortex', 'RCV Wasserwerfer / Räumung Police', ' Whippet Race Bike', 'Enus Windsor', 'Enus Windsor Drop', 'Grotti X80 Proto', 'Ocelot XA-21', 'Benefactor XLS', 'Declasse Yosemite', 'Bravado Youga', 'Truffade Z-Type', 'BMW Z4 2012', 'Pegassi Zentorno', 'Übermacht Zion', 'Übermacht Zion Cabrio', 'Übermacht Zion Classic', 'Pegassi Zorrusso'];

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
    </script>
    <script>
        autocomplete(document.getElementById("carnames"), cars);
    </script>

    <?php

    ?>
</body>

</html>