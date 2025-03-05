<?php
// inceput de sesiune, conectare la baza de date si navbar inclus in toate paginile
session_start();
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despre Eli's Cinemax</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <style>
        .outer {
            margin: auto;
            margin-top: 20px;
            max-width: 53%;
            padding: 30px;
            text-align: justify;
            border-radius: 10px;
            border: 2px solid white;
            background-color: transparent;
            backdrop-filter: blur(12px);
        }

        .content {
            max-width: 90%;
            margin: auto;
            color: white;
        }

        @media (max-width: 1200px) {
            .outer {
                max-width: 80%;
            }

            p {
                font-size: 16px;
            }

            h2 {
                font-size: 24px;
            }

            .title {
                font-size: 28px;
            }
        }

        .title {
            color: red;
            font-size: 30px;
            font-weight: 400;
        }
    </style>
</head>

<body style="background-color: black;">
<div class="outer">
        <div class="content">
            <h2>Bun venit la<span class="titlu"> Eli's Cinemax</span></h2>
            <p>Intra intr-o lume unde magia filmelor a fermecat generatii intregi. Pasiunea pentru cinematografie transforma fiecare vizionare intr-o experienta memorabila. Descopera povestea noastra, traditia si dedicarea de a oferi momente de neuitat.</p>

            <h2>O mostenire cinematografica unica</h2>
            <p>Fa o incursiune in trecutul nostru si descopera cum a inceput povestea noastra. Inspirati de dragostea pentru povesti, am devenit un reper al cinematografiei. Mostenirea noastra continua sa modeleze experientele culturale si de divertisment locale.</p>

            <h2>In inima Romaniei</h2>
            <p>Avem radacinile in inima vibranta a Bucurestiului, oferind un loc de intalnire pentru iubitorii de filme de toate varstele. Alege dintr-o selectie variata de filme, de la cele mai noi lansari la capodoperele clasice, intr-un cadru care celebreaza arta cinematografica.</p>

            <h2>Experiente cinematografice deosebite</h2>
            <p>Aici, fiecare detaliu conteaza. Bucura-te de imagini spectaculoase si sunet realist care te transpun direct in mijlocul actiunii. Cu tehnologia noastra de ultima generatie, fiecare vizita devine o aventura de neuitat.</p>

            <h2>Mai mult decat filme</h2>
            <p>Suntem mai mult decat un cinematograf - suntem un loc de conectare si bucurie. Fie ca te intalnesti cu prietenii sau petreci timp cu familia, aici creezi amintiri speciale. Venim in intampinarea dorintelor tale cu o atmosfera primitoare si experiente care inspira.</p>

            <h2>Angajamentul nostru pentru tine</h2>
            <p>Ne mandrim cu o echipa dedicata care se asigura ca fiecare vizita este impecabila. Indiferent daca esti un cinefil experimentat sau descoperi magia filmelor pentru prima data, aici vei gasi intotdeauna un loc unde esti binevenit.</p>

            <h2>Multumim ca faci parte din povestea noastra</h2>
            <p>Suntem recunoscatori ca ai ales sa faci parte din universul nostru. Continuam sa lucram pentru a aduce cele mai bune momente cinematografice in viata ta. Relaxeaza-te, bucura-te de spectacol si lasa magia filmelor sa-ti inspire imaginatia.</p>
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
            <p class="text-center text-white">© <?php echo date("Y"); ?> Eli's Cinemax</p>
            </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
