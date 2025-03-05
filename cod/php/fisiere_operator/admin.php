<?php
session_start(); // Pornirea sesiunii pentru a retine starea utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/Operator1.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/woker1.css">

    <title>Rezervari Procesate</title>
    <style>
        * {
            font-size: 20px;
            text-align: center;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Rezervari Procesate</h1>
    <a href="cereri.php">Vezi Cererile Noi</a>
    <br><br>

    <?php
    $sql = "SELECT 
                b.booking_id,
                u.firstname, 
                u.lastname, 
                m.title, 
                s.showtime, 
                t.seat_number, 
                b.booking_time,
                b.status
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN movies m ON b.movie_id = m.movie_id
            JOIN showtimes s ON b.showtime_id = s.showtime_id
            JOIN seats t ON b.seat_id = t.seat_id
            WHERE b.status IN (2, 3)";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID Rezervare</th><th>Nume Client</th><th>Film</th><th>Ora</th><th>Loc</th><th>Data</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['booking_id'] . "</td>";
            echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["showtime"] . "</td>";
            echo "<td>" . $row["seat_number"] . "</td>";
            echo "<td>" . $row["booking_time"] . "</td>";
            echo "<td>" . ($row['status'] == 2 ? "Acceptat" : "Respins") . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Nu exista rezervari procesate.</h2>";
    }
    ?>
</body>

</html>
