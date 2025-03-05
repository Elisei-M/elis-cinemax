<?php
// inceput de sesiune, conectare la baza de date si navbar inclus in toate paginile
session_start();
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";

?>

<head>
    <title>Detalii Film</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="stylesheet" href="../../css/imagesStyle.css">

    <style>
        .view_title {
            text-align: center;
            margin-bottom: 55px;
            margin-top: 35px;
            color: white;
        }

        .movie-details {
            margin: 2% 10%;
            padding: 20px;
            color: white;
            display: flex;
            gap: 20px;
            background-color: #909090;
            border-radius: 10px;
        }

        .movie-image {
            flex-shrink: 0;
            width: 260px;
            height: 340px;
            margin-top: 2%;
        }

        .movie-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            flex-grow: 1;
            text-align: justify;
        }

        .movie-meta {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 968px) {
            .movie-details {
                flex-direction: column;
                align-items: center;
            }

            .movie-image {
                margin-top: 0;
            }

            .movie-info {
                text-align: center;
                align-items: center;
            }
        }
    </style>

</head>

<?php

// Setarea variabilelor
$movieId = null;
$movieTitle = null;

//folosesc metoda GET pentru a nu pierde detalii la refresh

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['title'])) {
    $movieTitle = $_GET['title'];

    $sql = "SELECT movies.*, rooms.RoomName, GROUP_CONCAT(DISTINCT showtimes.showtime ORDER BY showtimes.showtime SEPARATOR ', ') AS ShowTimes
                FROM movies
                JOIN rooms ON movies.movie_id = rooms.movie_id
                JOIN showtimes ON movies.movie_id = showtimes.movie_id
                WHERE movies.title = ?
                GROUP BY movies.movie_id";
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("s", $movieTitle); 
    $stmt->execute(); 
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $showtimes = explode(', ', $row["ShowTimes"]);

// Fiecare film intr-un div pentru stilizare
            echo "<div class='movie-details'>"; 
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Imagine Film' class='movie-image'>";
            echo "<div class='movie-info'>";
            echo "<h1>" . htmlspecialchars($row["title"]) . "</h1>";
            echo "<div class='movie-description'>Descriere: " . htmlspecialchars($row["description"]) . "</div>";

            echo "<div class='movie-meta'>";
            echo "<p>Pret: " . htmlspecialchars($row["movie_price"]) . "</p>";
            echo "<p>Sala: " . htmlspecialchars($row["RoomName"]) . "</p>";
            echo "<p>Disponibilitate:</p>";
            foreach ($showtimes as $showtime) {
                echo "<form action='asezariScaune.php' method='get' class='showtime-form'>";
                echo "<input type='hidden' name='title' value='" . htmlspecialchars($row['title']) . "'>";
                echo "<input type='hidden' name='showtime' value='" . htmlspecialchars($showtime) . "'>";
                echo "<input type='hidden' name='room' value='" . htmlspecialchars($row['RoomName']) . "'>";
                echo "<input type='hidden' name='image' value='" . htmlspecialchars($row['image_path']) . "'>";
                echo "<button type='submit' class='showtime-button'>" . htmlspecialchars($showtime) . "</button>";
                echo "</form>";
            }
            echo "</div>"; // Inchiderea movie-meta
            echo "</div>"; // Inchiderea movie-info
            echo "<div style='clear:both;'></div>"; // Resetare float
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div>Niciun film gasit</div>";
    }
} else {
    echo "<div>Parametrul 'title' lipseste sau este invalid.</div>";
}

if ($conn->connect_error) {
    die("Conexiunea a esuat: " . $conn->connect_error);
}

// Vizualizarea altor filme
echo "<h2 class='view_title'>VEZI SI</h2>";

$sql = "SELECT movie_id, title, image_path
FROM movies
ORDER BY RAND()
LIMIT 8;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='grid-container container'>";

    while ($row = $result->fetch_assoc()) {
        echo "<div class='movie-card'>";
        echo "<form action='detalii.php' method='get'>";
        echo "<input type='hidden' name='title' value='" . htmlspecialchars($row["title"]) . "'>";
        echo "<div class='movie-img-container'>";
        echo "<button type='submit' class='movie_img'>";
        echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Imagine Film'>";
        echo "</button>";
        echo "<div>" . htmlspecialchars($row["title"]) . "</div>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<div>Nu s-au gasit rezultate</div>";
}
?>

<!-- FOOTER -->

<body style="background-color: black;">

    <div class="container">
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
