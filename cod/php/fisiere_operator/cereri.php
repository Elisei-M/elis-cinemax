<?php
session_start(); // Pornirea sesiunii pentru a retine starea utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/Operator1.php";

// Afișăm doar cererile noi (status = 1)
$sql = "SELECT 
            u.id AS user_id,
            u.firstname, 
            u.lastname, 
            u.email, 
            m.title, 
            s.showtime, 
            t.seat_number, 
            b.booking_time, 
            tk.customer_name, 
            tk.customer_lname, 
            tk.customer_email, 
            tk.customer_phone,
            b.booking_id
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN movies m ON b.movie_id = m.movie_id
        JOIN showtimes s ON b.showtime_id = s.showtime_id
        JOIN seats t ON b.seat_id = t.seat_id
        JOIN tickets tk ON b.booking_id = tk.booking_id
        WHERE b.status = 1"; // Doar cererile noi

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cereri</title>
    <link rel="stylesheet" type="text/css" href="../../css/woker1.css">
    <style>
        .form-div-request {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            width: 90%;
            margin: auto;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .form-div-request strong {
            color: #333;
            font-size: 1.1em;
        }

        .accept,
        .decline {
            padding: 10px 20px;
            border: none;
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }

        .accept {
            background-color: #4CAF50;
        }

        .decline {
            background-color: #f44336;
        }

        .accept:hover,
        .decline:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <h1>Cereri Noi</h1>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='form-div-request'>";
            echo "<form action='' method='post'>";
            echo "<strong>Informatii despre contul utilizatorului:</strong><br>";
            echo "Nume: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
            echo "Email: " . $row["email"] . "<br><br>";
            echo "<strong>Informatii despre rezervare:</strong><br>";
            echo "Film: " . $row["title"] . "<br>";
            echo "Ora: " . $row["showtime"] . "<br>";
            echo "Loc: " . $row["seat_number"] . "<br>";
            echo "Data rezervarii: " . $row["booking_time"] . "<br>";
            echo "<input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>";
            echo "<input type='submit' name='action' value='Accepta' class='accept'>";
            echo "<input type='submit' name='action' value='Respinge' class='decline'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<h2>Nu exista cereri noi.</h2>";
    }

    // Procesare cereri
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['booking_id'])) {
            $bookingId = intval($_POST['booking_id']);
            $newStatus = ($_POST['action'] === 'Accepta') ? 2 : 3;

            $sqlUpdate = "UPDATE bookings SET status = $newStatus WHERE booking_id = $bookingId";
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "<p>Cererea a fost actualizata cu succes.</p>";
            } else {
                echo "<p>Eroare la actualizarea cererii: " . $conn->error . "</p>";
            }

            header("Location: cereri.php");
            exit();
        }
    }
    ?>
</body>

</html>
