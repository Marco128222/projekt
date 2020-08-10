var carnames = ['Karin 190z', 'Volvo 242 1983', 'Nissan 350z', 'BMW 750i 1995', 'Pfister 811', 'Obey 9F', 'Obey 9F Cabrio', 'Audi A4 Quattro 2017', 'Truffade Adder', 'Brute Airport Bus', 'Albany Alpha', 'Brute Ambulance', 'Maxwell Asbo', 'Declasse Asea', 'Karin Asterope', 'Överflöd Autarch', 'Liberty City Cycles Avarus', 'Western Motorcycle Company Bagger', 'Gallivanter Baller', 'Gallivanter Baller (Sport)', 'Gallivanter Baller LE', 'Gallivanter Baller LE LWB', 'Bravado Banshee', 'Bravado Banshee 900R (Racing)', 'Pegassi Bati 800/Bati Custom', 'Karin BeeJay XL', 'Vapid Benson', 'Grotti Bestia GTS', 'HVY Biff', 'BF Bifta', 'Bravado Bison', 'Vapid Blade', 'Dinka Blista Kanjo', 'Dinka Blista Monkey', ' BMX', 'Vapid Bobcat XL', 'Canis Bodhi', 'Brute Boxville', 'Brute Brute Boxville Postal', 'Coil Brawler', 'Grotti Brioso R/A', 'Albany Buccaneer', 'Albany Buccaneer Custom', 'Bravado Buffalo (Race)', 'Bravado Buffalo S', 'Vapid Bullet', 'Declasse Burrito', 'Brute Bus', 'Mercedes Benz C63s AMG 2017', 'Chevrolet Camaro SS 2016', 'Brute Camper', 'Vapid Caracara 4x4', 'Nagasaki Carbon RS', 'Grotti Carbonizzare', 'Lampadati Casco', 'Albany Cavalcade 2nd Gen', 'Albany Cavalcade', 'Rune Cheburek', 'Grotti Cheetah', 'Grotti Cheetah Classic', 'Nagasaki Chimera', 'Vapid Chino', 'Vapid Chino Custom', 'Renault Clio 1993', 'Vapid Clique', 'Enus Cognoscenti', 'Enus Cognoscenti 55', 'Enus Cognoscenti Cabrio', 'Pfister Comet', 'Pfister Comet Retro Custom', 'Pfister Comet Safari', 'Pfister Comet SR', 'Invetero Coquette', 'Invetero Coquette BlackFin', 'Invetero Coquette Classic', ' Cruiser', 'Coil Cyclone', 'Western Motorcycle Company Daemon', 'Brute Dashound', 'Shitzu Defiler', 'Ducati Desmosedici RR', 'Schyster Deviant', 'Karin Dilettante', 'Nagasaki Dinghy', 'Vapid Dominator (Race)', 'Vapid Dominator', 'Vapid Dominator GTX', 'Obey Drafter', 'Declasse Drift Tampa (Racing)', 'Benefactor Dubsta 6x6', 'Benefactor Dubsta Sport Matt', 'Imponte Dukes', 'Bravado Duneloader', 'Weeny Dynasty', 'Annis Elegy Retro Custom', 'Annis Elegy RH8', 'Vapid Ellie', 'Progen Emerus', 'Albany Emperor', 'Albany Emperor Vintage', ' Endurex Race Bike', 'Dinka Enduro (Race)', 'Överflöd Entity XF', 'Överflöd Entity XXR', 'Pegassi Esskey', 'Emperor ETR1 (Racing)', 'Dewbauchee Exemplar', 'Ocelot F620', 'Willard Faction', 'Willard Faction Custom', 'Vulcar Fagaloa', 'Pegassi Faggio Modern', 'Principe Faggio Newschool', 'Principe Faggio Oldschool', 'Pegassi FCR 1000', 'Lampadati Felon', 'Lampadati Felon GT', 'Benefactor Feltzer', 'Bravado FIB Buffalo Unmarked', 'Stanley Fieldmaster', ' Fieldmaster Graintrailer', ' Fixter', 'Vapid FlashGT', 'MLT Flatbed', 'Vapid FMJ', 'Vapid FMJ', ' Formula', 'Fathom FQ 2', 'Cheval Fugitive', 'Grotti Furia', 'Lampadati Furore GT', 'Schyster Fusilade', 'Karin Futo', 'Mercedes Benz G65 AMG', 'Bravado Gauntlet', 'Bravado Gauntlet (Race)', 'Bravado Gauntlet Classic', 'Bravado Gauntlet Hellfire', 'Vapid GB200', 'Benefactor Glendale', 'VW Golf 2er 1983', 'VW Golf 7er 2012', 'Progen GP1', 'Declasse Granger', 'Declasse Granger Undercover SUV', 'Bravado Gresley', 'Lexus GS 350 2014 Medic', 'Porsche GT3 RS 2015', 'Grotti GT500', 'Vapid Guardian', 'Emperor Habanero', 'Shitzu Hakuchou', 'Jobuilt Hauler', 'Annis Hellion', 'Albany Hermes', 'Liberty City Cycles Hexer', 'Nagasaki Hot Rod Blazer', ' Hotring (Racing)', 'Enus Huntley S', 'Vapid Hustler', 'BMW i8 2019', 'Överflöd Imorgon', 'Chevrolet Impala SS Hard Top 1964', 'Declasse Impaler', 'Pegassi Infernus', 'Pegassi Infernus Classic', 'Vulcar Ingot', 'Vulcar Ingot', 'BF Injection', 'Karin Intruder', 'Weeny Issi Classic', 'Weeny Issi Sport', 'Progen Itali GTB', 'Progen Itali GTB Custom', 'Grotti Itali GTO', 'Ocelot Jackal', 'Dewbauchee JB7002', 'Dinka Jester', 'Dinka Jester (Racing)', 'Dinka Jester Classic', 'Mini John Cooper Works 2013', 'Zirconium Journey', 'Ocelot Jugular', 'Canis Kalahari', 'Canis Kamacho', 'Hijak Khamelion', 'Karin Kuruma', 'Ferrari LaFerrari 2015', 'Mitshubishi Lancer EVO 9', 'Dundreary Landstalker', 'Principe Lectro', 'Ocelot Locust', 'Ocelot Lynx', 'BMW M5 2018', 'Declasse Mamba', 'Albany Manana', 'Dewbauchee Massacro', 'Dewbauchee Massacro (Racing)', 'Canis Mesa/Merryweather Mesa', 'Lampadati Komoda', 'Lampadati Michelli', 'Vapid Minivan', 'Vapid Minivan Custom', 'HVY Mixer', 'Pegassi Monroe', 'Declasse Moonbeam', 'Declasse Moonbeam Custom', 'McLaren MP4 12C (Police)', 'Maibatsu Mule', 'Maibatsu Mule 2', 'Maibatsu Mule Special', 'Ford Mustang Boss 302 1969', 'Ford Mustang GT 2015', 'Ford Mustang GT Police 2015', 'Principe Nemesis', 'Vysser Neo', 'Pfister Neon', 'Truffade Nero', 'Truffade Nero Custom', 'Liberty Chop Chop Nightblade', 'Imponte Nightshade', 'Lampadati Novak', 'MTL Öl Tanker 2000', 'Obey Omnis', 'Übermacht Oracle', 'Übermacht Oracle XS', 'Pegassi Osiris', 'Nagasaki Outlaw', 'MTL Packer', 'Benefactor Panto', 'Bravado Paradise', 'Enus Paragon R', 'Ocelot Pariah', 'Declasse Park Ranger', 'Mammoth Patriot', 'Mammoth Patriot Stretch', 'Ocelot Penetrator', 'Maibatsu Penumbra', 'Vapid Peyote', 'Jobuilt Phantom', 'Jobuilt Phantom Custom', 'Imponte Phoenix', 'Cheval Picador', 'Lampadati Pigalle', 'Western Motorcycle Company Police Bike', 'Bravado Police Cruiser (Buffalo)', 'Vapid Police Cruiser', 'Vapid Police Cruiser Unmarked', 'Vapid Police Interceptor', 'Vapid Police Prison Bus', 'Declasse Police Rancher (Winter)', 'Brute Police Riot', 'Albany Police Roadcruiser (Winter)', 'Declasse Police Transporter', 'Brute Pony', 'MTL Pounder', 'Bollokan Prairie', 'Declasse Premier', 'Albany Primo Custom', 'Fiat Punto 2010', 'Vapid Radius', 'Coil Raiden', 'Dodge Ram 1500 2016', 'Declasse Rancher XL', 'Dewbauchee Rapid GT', 'Dewbauchee Rapid GT Cabrio', 'Dewbauchee Rapid GT Classic', 'BF Raptor', 'Western Motorcycle Company Rat Bike', 'Bravado Rat-Truck', 'Annis RE-7B (Racing)', 'Pegassi Reaper', 'Übermacht Rebla GTS', 'Dundreary Regina', 'Vapid Retinue', 'Vapid Retinue MK2', 'Übermacht Revolter', 'Declasse Rhapsody', 'Vapid Riata', 'Obey Rocoto', 'Chariot Romero Hearse', 'Albany Roosevelt', 'Albany Roosevelt Valor', 'Audi RS7 2015', 'Jobuilt Rubble', 'Pegassi Ruffian', 'Imponte Ruiner', 'Bravado Rumpo Custom', 'Hijak Ruston', 'Karin Rusty Rebel & Rebel', 'Mercedes Benz S500 2014', 'Mercedes Benz S600 220 1998', 'Declasse Sabre Turbo Custom', 'Vapid Sadler', 'Maibatsu Corporation Sanchez (Racing)', 'Liberty City Cycles Sanctus', 'Vapid Sandking SWB', 'Vapid Sandking', 'Annis Savestra', 'Übermacht SC1', 'Benefactor Schafter', 'Benefactor Schafter LWB', 'Benefactor Schafter V12', 'Benefactor Schlagen', 'Benefactor Schwartzer', ' Scorcher', 'Speedophile Seashark', 'Canis Seminole', 'Übermacht Sentinel', 'Übermacht Sentinel Classic', 'Übermacht Sentinel XS', 'Benefactor Serrano', 'Dewbauchee Seven-70', 'Ford Shelby Mustang GT500 1967', 'Vapid Sheriff Cruiser', 'Declasse Sheriff SUV', 'Nissan Skyline GT-R BNR34', 'Vapid Slamvan', 'Vapid Slamvan Custom', 'Western Motorcycle Company Sovereign', 'Dewbauchee Specter', 'Dewbauchee Specter Custom', 'Vapid Speedo', 'Declasse Stallion', 'Declasse Stallion (Race)', 'Vapid Stanier', 'Grotti Stinger', 'Grotti Stinger GT', 'Benefactor Stirling GT', 'Brute Stockade', 'Zirconium Stratum', 'Nagasaki Street Blazer', 'Benefactor Streiter', 'Albany Stretch', 'Dinka Sugoi', 'Karin Sultan', 'Karin Sultan Classic', 'Karin Sultan RS', 'Enus Super Diamond', 'Toyota Supra', 'Benefactor Surano', 'BF Surfer', 'Cheval Surge', 'Ocelot Swinger', 'Progen T20', 'Brute Taco Van', 'Obey Tailgater', 'Cheval Taipan', 'Declasse Tampa', ' Tanker 2', ' Tanker', 'Vapid Taxi', 'Pegassi Tempesta', 'Pegassi Tezeract', 'Vapid The Liberator (Racing)', 'Truffade Thrax', 'Dinka Thrust', 'Brute Tipper Second Generation', 'Pegassi Torero', 'Declasse Tornado', 'Declasse Tornado Custom', 'Pegassi Toros', 'Vapid Towtruck (Small)', 'Vapid Towtruck Large', ' Trailer Large', ' Trailer Logs', 'Jobuilt Trashmaster', ' Tri-Cycles Race Bike', 'Lampadati Tropos Rallye', 'Buckingham Tug', 'Declasse Tulip', 'Grotti Turismo Classic', 'Grotti Turismo R', 'Överflöd Tyrant', 'Progen Tyrus', 'Albany V-STR', 'Pegassi Vacca', 'Dewbauchee Vagner', 'Maxwell Vagrant', 'Declasse Vamos', 'Bravado Verlierer', 'Declasse Vigero', 'Dinka Vindicator', 'Albany Virgo', 'Dundreary Virgo Classic', 'Dundreary Virgo Classic Custom', 'Lampadati Viseris', 'Lampadati Viseris', 'Grotti Visione', 'Coil Voltic', 'Declasse Voodoo', 'Declasse Voodoo Custom', 'Pegassi Vortex', 'RCV Wasserwerfer / Räumung Police', ' Whippet Race Bike', 'Enus Windsor', 'Enus Windsor Drop', 'Grotti X80 Proto', 'Ocelot XA-21', 'Benefactor XLS', 'Declasse Yosemite', 'Bravado Youga', 'Truffade Z-Type', 'BMW Z4 2012', 'Pegassi Zentorno', 'Übermacht Zion', 'Übermacht Zion Cabrio', 'Übermacht Zion Classic', 'Pegassi Zorrusso'];
var marke = ["Keiner", "Albany", "Annis", "Audi", "Benefactor", "BF", "BMW", "Bollokan", "Bravado", "Brute", "Buckingham", "Canis", "Chariot", "Cheval", "Chevrolet", "Coil", "Declasse", "Dewbauchee", "Dinka", "Dodge", "Ducati", "Dundreary", "Emperor", "Enus", "Fathom", "Ferrari", "Fiat", "Ford", "Gallivanter", "Grotti", "Hijak", "HVY", "Imponte", "Invetero", "Jobuild", "Karin", "Lampadati", "Lexus", "Liberty Chop Shop", "Liberty City Cycles", "Maibatsu", "Maibatsu Coporation", "Mammoth", "Maxwell", "McLaren", "Mercedes Benz", "Mini", "Mitsubishi", "MTL", "Nagasaki", "Nissan", "Obey", "Ocelot", "Överflöd", "Pegassi", "Pfister", "Porsche", "Principe", "Progen", "RCV", "Renault", "Rune", "Schyster", "Shitzu", "Speedophile", "Stanley", "Toyota", "Truffade", "Uebermacht", "Vap", "Vapid", "Volvo", "Vulcar", "VW", "Vysser", "Weeny", "Western Motorcycle Company", "Willard", "Ziconium"];
var sitzplatz = ["1", "2", "4", "6", "8"];
var kraftstoff = ["Diesel", "Benzin"];
var kategorie = ["Anhänger", "Boote", "Coupes", "Emergency", "Fahrrad", "Industrial", "Kompaktfahrzeuge", "Limousine", "LKW", "Motorrad", "Muscle Car", "Off-Road", "PKW", "Roller", "Service", "Sport Klassik", "Sportwagen", "Super Sportler", "SUV", "Utility", "Van"];

function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function (e) {
        if (this.value == "" ||this.value == undefined) {
            var a, b, i, val = this.value;
            closeAllLists();
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            for (let i = 0; i < arr.length; i++) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr.length; + "</strong>";
            }
        } else {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function (e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        }

    });
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}