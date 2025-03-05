<?php
session_start();

require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/Operator1.php";
require "modificaRol.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['movie_title']) && !empty($_POST['description']) && !empty($_POST['showtimes']) && !empty($_FILES['fileToUpload']['name']) && !empty($_POST['room_name']) && !empty($_POST['movie_price'])) {
        
        $movieTitle = mysqli_real_escape_string($conn, $_POST['movie_title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $showtimes = explode(',', $_POST['showtimes']);
        $roomName = mysqli_real_escape_string($conn, $_POST['room_name']);
        $moviePrice = floatval($_POST['movie_price']);

        $targetDir = "../../imagini/filme/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
        if (file_exists($targetFile)) {
            $fileInfo = pathinfo($targetFile);
            $targetFile = $fileInfo['dirname'] . '/' . $fileInfo['filename'] . '_' . uniqid() . '.' . $fileInfo['extension'];
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $sqlMovie = "INSERT INTO movies (title, description, image_path, movie_price) VALUES ('$movieTitle', '$description', '$targetFile', '$moviePrice')";
            if (mysqli_query($conn, $sqlMovie)) {
                $movieId = mysqli_insert_id($conn);

                $sqlRoom = "INSERT INTO rooms (RoomName, movie_id) VALUES ('$roomName', '$movieId')";
                if (mysqli_query($conn, $sqlRoom)) {
                    $roomId = mysqli_insert_id($conn);

                    foreach ($showtimes as $showtime) {
                        $showtime = mysqli_real_escape_string($conn, trim($showtime));
                        $sqlShowtime = "INSERT INTO showtimes (movie_id, room_id, showtime) VALUES ('$movieId', '$roomId', '$showtime')";
                        mysqli_query($conn, $sqlShowtime);
                    }
                    echo "<p style='color: green;'>Film adaugat cu succes!</p>";
                } else {
                    echo "<p style='color: red;'>Eroare la inserarea salii.</p>";
                }
            } else {
                echo "<p style='color: red;'>Eroare la inserarea filmului.</p>";
            }
        } else {
            echo "<p style='color: red;'>Eroare la incarcarea imaginii.</p>";
        }
    } else {
        echo "<p style='color: red;'>Toate campurile sunt obligatorii!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga Filme</title>
    <link rel="stylesheet" type="text/css" href="../../css/woker1.css">
</head>
<body>
    <div class="form-container">
        <h2 style="text-align: center;">Introduceti filme</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label for="movie_title" class="form-label">Titlu film:</label>
            <input type="text" id="movie_title" name="movie_title" class="form-input" required><br>
            <label for="description" class="form-label">Descriere:</label>
            <textarea rows="4" cols="50" name="description" class="form-textarea" required></textarea><br>
            <label for="showtimes" class="form-label">Ore (separate prin virgula):</label>
            <input type="text" id="showtimes" name="showtimes" class="form-input" required placeholder="2024-01-26 15:30:00"><br>
            <label for="fileToUpload" class="form-label">Selectati imaginea:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-file" required><br>
            <label for="room_name" class="form-label">Numele salii:</label>
            <input type="text" id="room_name" name="room_name" class="form-input" required><br>
            <label for="movie_price" class="form-label">Pret bilet:</label>
            <input type="text" id="movie_price" name="movie_price" class="form-input" required><br>
            <input type="submit" value="Incarca" name="button2" class="form-submit">
        </form>
    </div>

    <table style="border:1px; border-style:solid; border-color:black">
        <div class="table-container">
            <?php
            $sql = "SELECT 
                movies.movie_id, 
                movies.title, 
                movies.movie_price, 
                movies.image_path, 
                movies.description, 
                rooms.RoomName,
                GROUP_CONCAT(showtimes.showtime SEPARATOR ', ') AS Showtimes 
            FROM movies 
            JOIN rooms ON movies.movie_id = rooms.movie_id 
            LEFT JOIN showtimes ON movies.movie_id = showtimes.movie_id 
            GROUP BY movies.movie_id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='movie-card'>";
                    echo "<img src='" . $row["image_path"] . "' alt='Imagine Film'>";
                    echo "<div class='movie-info'><strong>ID Film:</strong> " . $row["movie_id"] . "</div>";
                    echo "<div class='movie-info'><strong>Titlu:</strong> " . $row["title"] . "</div>";
                    echo "<div class='movie-info'><strong>Ore:</strong> " . $row["Showtimes"] . "</div>";
                    echo "<div class='movie-info'><strong>Sala:</strong> " . $row["RoomName"] . "</div>";
                    echo "<div class='movie-info'><strong>Pret:</strong> &euro;" . $row["movie_price"] . "</div>";
                    echo "<div class='movie-info'><strong>Descriere:</strong> " . $row["description"] . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nu s-au gasit filme.</p>";
            }
            ?>
        </div>
    </table>
</body>
</html>
