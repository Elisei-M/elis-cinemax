<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//  try-catch pentru a gestiona locurilor si erorilor
try {

    $title = test_input($_GET['title']); // cautare cu titlu de film
    $stmt = $conn->prepare("SELECT movie_id FROM movies WHERE title = ?");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movieId = $row['movie_id'];
    } else {
        echo "Eroare cu movie_id";
    }
    $stmt->close();

    $showtime = test_input($_GET['showtime']);
    // Interogare pentru obtinerea ID-ului intervalului orar
    $stmt = $conn->prepare("SELECT showtime_id FROM showtimes WHERE showtime = ?");
    $stmt->bind_param("s", $showtime);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $showtimeId = $row['showtime_id'];
    } else {
        echo "Eroare cu showtime_id";
    }
    $stmt->close();

    $room = test_input($_GET['room']);

    $stmt = $conn->prepare("SELECT rooms_id FROM rooms WHERE RoomName = ?");
    $stmt->bind_param("s", $room);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $roomId = $row['rooms_id'];
    } else {
        echo "Eroare cu rooms_id";
    }
    $stmt->close();

    $seat = test_input($_GET['seat']);

    $stmt = $conn->prepare("SELECT seat_id FROM seats WHERE seat_number = ?");
    $stmt->bind_param("s", $seat);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $seatId = $row['seat_id'];
    }
    $stmt->close();

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['submit'])) {

        // Setarea variabilelor din formularul de plata
        $firstName = isset($_GET['FirstName']) ? test_input($_GET['FirstName']) : '';
        $lastName = isset($_GET['LastName']) ? test_input($_GET['LastName']) : '';
        $email = isset($_GET['Email']) ? test_input($_GET['Email']) : '';
        $houseAddress = isset($_GET['HouseAddress']) ? test_input($_GET['HouseAddress']) : '';
        $zipCode = isset($_GET['ZipCode']) ? test_input($_GET['ZipCode']) : '';
        $phoneNum = isset($_GET['PhoneNum']) ? test_input($_GET['PhoneNum']) : '';
        $cardNum = isset($_GET['CardNum']) ? test_input($_GET['CardNum']) : '';
        $expireDate = isset($_GET['ExpireDate']) ? test_input($_GET['ExpireDate']) : '';
        $nameOnCard = isset($_GET['NameOnCard']) ? test_input($_GET['NameOnCard']) : '';
        $SecCode = isset($_GET['SecCode']) ? test_input($_GET['SecCode']) : '';

        if (
            empty($firstName) ||
            empty($lastName) ||
            empty($email) ||
            empty($houseAddress) ||
            empty($zipCode) ||
            empty($phoneNum) ||
            empty($cardNum) ||
            empty($expireDate) ||
            empty($nameOnCard) ||
            empty($SecCode)
        ) {
            echo "Completati toate campurile.";
        } else {
            $stmt = $conn->prepare("SELECT seat_id FROM seats WHERE seat_number = ? AND room_id = ?");
            $stmt->bind_param("si", $seat, $roomId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $status = 'available';
                $stmt = $conn->prepare("INSERT INTO seats (room_id, seat_number, status) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $roomId, $seat, $status);
                $stmt->execute();
                $seatId = $stmt->insert_id;
            } else {
                $row = $result->fetch_assoc();
                $seatId = $row['seat_id'];
            }
            $stmt->close();

            $userId = $_SESSION["userid"];
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_id, rooms_id, seat_id, showtime_id, booking_time, status) VALUES (?, ?, ?, ?, ?, NOW(), TRUE)");
            $stmt->bind_param("iiiii", $userId, $movieId, $roomId, $seatId, $showtimeId);

            if ($stmt->execute()) {
                $booking_id = $stmt->insert_id;

                $stmt = $conn->prepare("INSERT INTO tickets (booking_id, customer_name, customer_lname, customer_email, customer_phone, customer_address) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssss", $booking_id, $firstName, $lastName, $email, $phoneNum, $houseAddress);

                if ($stmt->execute()) {
                    header("Location: veziBilet.php");
                    exit;
                } else {
                    echo "Eroare: " . $stmt->error;
                }
            } else {
                echo "Eroare: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        echo "<script>alert('Eroare: Locul este deja rezervat. Alegeti alt loc.');</script>";
    } else {
        echo "Eroare: " . $e->getMessage();
    }
}
