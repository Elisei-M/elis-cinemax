<?php
session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Plan scaunuri Cinema</title>

    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="stylesheet" href="../../css/imagesStyle.css">

<body style="background-color: black;">

    <style>
        .seating-plan {
            display: grid;
            grid-template-columns: repeat(8, calc((100% - 70px) / 8));
            gap: 10px;
            max-width: 600px;
            margin: 0 auto;
            background-color: lightgray;
            padding: 10px;
            grid-template-rows: repeat(4, 1fr);
            position: relative;
            margin-top: 80px;
            border-radius: 6px;
        }

        .seat {
            display: none;
        }

        .seat+label {
            appearance: none;
            padding: 10px;
            text-align: center;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            cursor: pointer;
            display: inline-bscaunk;
            margin: 0;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seat+label:hover {
            background-color: #a8a8a8;
        }

        .seat:checked+label {
            background-color: #a0a0f0;
        }

        .Isle {
            visibility: hidden;
        }

        .view_title {
            text-align: center;
            margin-bottom: 55px;
            margin-top: 35px;
            color: white;
        }

        .movie-details {
            color: white;
            margin-left: 90px;
        }

        .seating-plan {
            position: relative;
            margin-top: 80px;
        }

        .seating-plan::before {
            content: 'Ecran';
            position: absolute;
            top: -60px;
            left: 0;
            right: 0;
            height: 50px;
            line-height: 40px;
            background-color: #333;
            border-radius: 50%;
            color: #fff;
            text-align: center;
            font-size: 28px;
            z-index: -1;
        }

        @media (max-width: 600px) {
            .seating-plan {
                width: 95%;
            }

            .seat+label {
                padding: 5px;
                font-size: 13px;
            }
        }

        .seatbtn {
            margin-top: 17px;
            margin-bottom: 10px;
            background-color: #333;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .seatbtn:hover {
            background-color: #555;
        }
    </style>

    </head>

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';
            $showtime = isset($_GET['showtime']) ? htmlspecialchars($_GET['showtime']) : '';
            $room = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : '';

            echo "<div class='movie-details'>";
            echo "<h2 class='movie-title'>Rezervare pentru: $title</h2>";
            echo "<p class='movie-showtime'>Ora: $showtime</p>";
            echo "<p class='movie-room'>Sala: $room</p>";
            echo "</div>";
        }
    ?>

        <form action="plata.php" method="get" id="bookingForm" onsubmit="return validateForm()">

            <input type="hidden" name="title" value="<?php echo $title; ?>">
            <input type="hidden" name="showtime" value="<?php echo $showtime; ?>">
            <input type="hidden" name="room" value="<?php echo $room; ?>">

            <div class="seating-plan">

                <?php
                $seats = array(
                    "scaun 1", "scaun 2", "scaun 3", "Isle", "Isle", "scaun 4", "scaun 5", "scaun 6",
                    "scaun 7", "scaun 8", "scaun 9", "Isle", "Isle", "scaun 10", "scaun 11", "scaun 12",
                    "scaun 13", "scaun 14", "scaun 15", "Isle", "Isle", "scaun 16", "scaun 17", "scaun 18",
                    "scaun 19", "scaun 20", "scaun 21", "Isle", "Isle", "scaun 22", "scaun 23", "scaun 24"
                );

                foreach ($seats as $index => $seat) {
                    if ($seat == "Isle") {
                        echo "<div class='isle-seat'></div>";
                    } else {
                        echo "<input type='radio' id='seat$index' class='seat' name='seat' value='$seat'>";
                        echo "<label for='seat$index'>$seat</label>";
                    }
                }

                ?>
                <div class="seatbtn-container">
                    <input type="submit" name="submit" class="seatbtn">
                </div>
            </div>
        </form>

    <?php
    } else {
        echo "<script>alert('Trebuie sa fii autentificat pentru a rezerva un bilet!'); window.scaunation.href = 'autentificare.php';</script>";
        echo "<p>Bine ai venit, vizitator! <a href='autentificare.php'>Autentifica-te</a> sau <a href='inregistrare.php'>Inregistreaza-te</a> pentru mai multe functionalitati.</p>";
    }

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
            echo "<div class='movie-title'>" . htmlspecialchars($row["title"]) . "</div>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div>Nu s-au gasit rezultate</div>";
    }

    ?>

    <script>
        function validateForm() {
            var seats = document.querySelectorAll('.seat');
            for (var i = 0; i < seats.length; i++) {
                if (seats[i].checked) {
                    return true;
                }
            }
            alert('Va rugam selectati un scaun inainte de a trimite!');
            return false;
        }
    </script>

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

</html>
