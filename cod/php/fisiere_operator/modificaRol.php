<?php

require "../Tables-MakeDB/makeDBConnection.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($conn->connect_error) {
    die("Conexiunea a esuat: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieTitle = test_input($_POST["movie_title"]);
    $description = test_input($_POST["description"]);
    $movie_price = test_input($_POST["movie_price"]);
    $room_name = test_input($_POST["room_name"]);

    // Verificare daca fisierul a fost incarcat cu succes
    if (!empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] === 0) {
        // Setarea directorului unde vrem sa salvam fisierul incarcat
        $uploadDir = '../../imagini/';

        // Accesarea numelui fisierului si mutarea acestuia in directorul specificat
        $imgPath = $uploadDir . basename($_FILES['fileToUpload']['name']);

        // Testare daca fisierul incarcat este o imagine
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($imgPath, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            echo "Eroare: Fisierul nu este o imagine.";
            $uploadOk = 0;
        }

        // Verificare daca fisierul exista deja
        if (file_exists($imgPath)) {
            echo "Eroare: Fisierul exista deja.";
            $uploadOk = 0;
        }

        // Verificare dimensiune fisier
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Eroare: Fisierul este prea mare.";
            $uploadOk = 0;
        }

        // Doar tipuri de imagini specifice pot fi incarcate
        $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedImageTypes)) {
            echo "Eroare: Doar fisiere JPG, JPEG, PNG & GIF sunt permise.";
            $uploadOk = 0;
        }

        // Daca $uploadOk este inca 1, mutam fisierul in directorul specificat
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imgPath);

            // Inserare in baza de date
            if (!empty($movieTitle) && !empty($description) && !empty($_POST['showtimes']) && !empty($_POST["room_name"]) && !empty($_POST["movie_price"])) {

                $sqlInsertMovie = "INSERT INTO movies (title, description, image_path, movie_price) VALUES ('$movieTitle', '$description', '$imgPath','$movie_price')";

                if ($conn->query($sqlInsertMovie) === TRUE) {
                    $movieID = $conn->insert_id;

                    $sqlInsertRooms = "INSERT INTO rooms (movie_id, Roomname) VALUES ($movieID, '$room_name')";

                    if ($conn->query($sqlInsertRooms) === TRUE) {
                        $room_id = $conn->insert_id;
                    }

                    // Daca avem mai multe ore de spectacol, le diferentiem folosind explode
                    $showtimes = explode(',', $_POST["showtimes"]);
                    foreach ($showtimes as $time) {
                        $sqlInsertShowtime = "INSERT INTO showtimes (movie_id, room_id, showtime) VALUES ($movieID, $room_id, '$time')";
                        $conn->query($sqlInsertShowtime);
                    }

                    echo "Datele au fost inserate cu succes.";
                } else {
                    echo "Eroare la inserarea datelor: " . $conn->error;
                }
            } else {
                echo "Toate campurile formularului sunt obligatorii. Va rugam completati toate campurile.";
            }
        } else {
            echo "Eroare la incarcarea fisierului.";
        }
    } else {
        echo "Eroare la incarcarea fisierului sau fisierul nu a fost selectat.";
    }
}
