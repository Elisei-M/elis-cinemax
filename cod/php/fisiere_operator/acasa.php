<?php session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";
require "../../html/carusel.php";
?>

<head>
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="stylesheet" href="../../css/imagesStyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../imagini/clapperboard.png">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eli's Cinemax</title>
</head>

<body style="background-color: black;">

    <?php
    if ($conn->connect_error) {
        die("Conexiunea a esuat: " . $conn->connect_error);
    }

    // Primele 8 filme din baza de date
    $sql = "SELECT movie_id, title, image_path FROM movies LIMIT 8";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inceperea containerului pentru toate filmele
        echo "<div class='grid-container container'>";

        while ($row = $result->fetch_assoc()) {
            // Fiecare film are propriul card
            echo "<div class='movie-card'>";

            // Crearea formularelor pentru fiecare film
            echo "<form action='detalii.php' method='get'>";
            echo "<input type='hidden' name='title' value='" . htmlspecialchars($row["title"]) . "'>";

            // Container pentru imagine si titlu pentru o mai buna stilizare
            echo "<div class='movie-img-container'>";
            echo "<button type='submit' class='movie_img'>";
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Imagine Film'>";
            echo "</button>";
            echo "<div>" . htmlspecialchars($row["title"]) . "</div>";
            echo "</div>";

            echo "</form>";

            // Inchiderea div-ului pentru cardul filmului
            echo "</div>";
        }

        // Inchiderea div-ului pentru grid-container
        echo "</div>";
    } else {
        echo "<div>Nu s-au gasit rezultate</div>";
    }
    ?>

    <div class="num-container">
        <form action="acasa.php" method="GET">
            <button type="submit" class="num-button current" id="Page1">1</button>
        </form>

        <form action="maiMulteFilme2.php" method="GET">
            <button type="submit" class="num-button" id="Page2">2</button>
        </form>

        <form action="maiMulteFilme3.php" method="GET">
            <button type="submit" class="num-button" id="Page3">3</button>
        </form>
    </div>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="acasa.php" class="nav-link px-2 text-white">Acasa</a></li>
                <li class="nav-item"><a href="maiMulteFilme2.php" class="nav-link px-2 text-white">Filme</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-white">Contact</a></li>
                <li class="nav-item"><a href="despre.php" class="nav-link px-2 text-white">Despre noi</a></li>
            </ul>
            <p class="text-center text-white">&copy; <?php echo date("Y"); ?> Eli's Cinemax</p>
        </footer>
    </div>

    <?php
    // Verificare daca formularul de cautare a fost trimis si campul movie_name nu este gol
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["movie_name"])) {
        $movieName = $_GET["movie_name"];

        if (!empty($movieName)) {
            header("Location: cautare.php?movie_name=" . urlencode($movieName));
            exit();
        } else {
            echo 'Cautare invalida';
        }
    }
    ?>
</body>

</html>
