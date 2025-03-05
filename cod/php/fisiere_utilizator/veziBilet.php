<?php
session_start(); // Pornirea sesiunii pentru a retine ID-ul si numele complet al utilizatorului

require "../Tables-MakeDB/makeDBConnection.php";

// Redirectionare daca utilizatorul nu este autentificat
if (!isset($_SESSION['userid'])) {
    header("Location: autentificare.php");
    exit;
}

$userId = $_SESSION['userid'];
// Afisarea unui bilet daca exista, pe baza interogarii. Cautam o rezervare unde toate campurile se potrivesc cu numele filmului, locul, sala, ora etc.
$stmt = $conn->prepare("SELECT b.*, m.title, s.showtime, r.RoomName 
                        FROM bookings b
                        JOIN movies m ON b.movie_id = m.movie_id
                        JOIN showtimes s ON b.showtime_id = s.showtime_id
                        JOIN rooms r ON b.rooms_id = r.rooms_id
                        WHERE b.user_id = ?
                        ORDER BY b.booking_id DESC
                        LIMIT 1");

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$bookingStatus = '';

if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();

    if ($booking['status'] == 0) { //acceptat
        header("Location: profil.php");
        exit;
    }

    $bookingStatus = $booking['status'];
} else {
    $bookingStatus = 'declined'; // Nicio inregistrare gasita = respins
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10;url=acasa.php">
    <title>Biletele Tale</title>
</head>

<body>

    <?php
    if ($bookingStatus === 'declined') {
        echo '<h1>Biletul tau a fost respins</h1>';
        echo '<p>Din pacate, rezervarea ta pentru biletul de film a fost respinsa. Te rugam sa vizitezi profilul tau pentru mai multe detalii sau sa faci o alta rezervare.</p>';
        echo "<a href='acasa.php'>Vezi Filme</a>";
    } else {
        echo '<h1>In asteptare...</h1>';
        echo '<h2>Vei fi redirectionat catre profilul tau imediat ce rezervarea este acceptata.</h2>';
    }
    ?>
</body>

</html>
