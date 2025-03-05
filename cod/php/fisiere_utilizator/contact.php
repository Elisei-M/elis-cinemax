<?php
// inceput de sesiune, conectare la baza de date si navbar inclus in toate paginile
session_start();
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .fa-phone,
        .fa-map-marker,
        .fa-envelope {
            color: #FD8F1E;
            font-size: 40px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin: auto;
            margin-top: 150px;
        }

        .box {
            background-color: white;
            margin: auto;
            text-align: center;
            border-radius: 10px;
            width: 280px;
            height: 180px;
        }

        .inner {
            margin-top: 30px;
        }

        .box1 {
            grid-column-start: 2;
        }

        .box2 {
            grid-column-start: 4;
        }

        .box3 {
            grid-column-start: 6;
        }

        #map {
            width: 700px;
            margin: auto;
            margin-top: 40px;
        }

        .leaflet-top,
        .leaflet-bottom {
            position: absolute;
            z-index: 500;
            pointer-events: none;
        }

        .box {
            margin-bottom: 20px;
        }

        @media screen and (max-width: 900px) {
            .contact-container {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(2, 1fr);
                gap: 10px;
            }

            .box1,
            .box2,
            .box3 {
                grid-column-start: auto;
            }

            #map {
                width: 80%;
                margin: auto;
                margin-top: 40px;
            }
        }

        @media screen and (max-width: 600px) {
            .contact-container {
                grid-template-columns: 1fr;
            }

            .box1,
            .box2,
            .box3 {
                grid-column-start: auto;
            }

            #map {
                width: 400px;
                margin: auto;
                margin-top: 40px;
            }
        }
    </style>
</head>

<body style="background-color: black;">
    <div id="map" style="height: 400px;"></div>

    <div class="contact-container">
        <div class="box box1">
            <div class="inner">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <h5 style="color: black;">Telefon</h5>
                <h6>0755 752 1954</h6>
            </div>
        </div>

        <div class="box box2">
            <div class="inner">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <h5 style="color: black;">Adresa</h5>
                <h6>Aleea Pravat nr 1, Bucuresti, Romania</h6>
            </div>
        </div>

        <div class="box box3">
            <div class="inner">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <h5 style="color: black;">Mail</h5>
                <h6>Eli's Cinemax@info.ro</h6>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 90px;">
        <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="acasa.php" class="nav-link px-2 text-white">Acasa</a></li>
                <li class="nav-item"><a href="maiMulteFilme2.php" class="nav-link px-2 text-white">Filme</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-white">Contact</a></li>
                <li class="nav-item"><a href="despre.php" class="nav-link px-2 text-white">Despre</a></li>
            </ul>
            <p class="text-center text-white">&copy; <?php echo date("Y"); ?> Eli's Cinemax</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([44.425294, 26.041090], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([44.425294, 26.041090]).addTo(map);
            marker.bindPopup('CineMax Bucuresti').openPopup();
        });
    </script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
