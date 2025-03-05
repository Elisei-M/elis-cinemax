<?php
session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "../../html/navBar.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/profile.css">

    <title>Profil</title>
</head>

<body>
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $userId = $_SESSION["userid"];
        echo "<h2 class='profile'><b>PROFIL</b></h2>";

        $stmt = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='profile-container'>";
                echo "<p><b>Nume:</b> " . htmlspecialchars($row["firstname"]) . " " . htmlspecialchars($row["lastname"]) . "</p>";
                echo "<p><b>Email:</b> " . htmlspecialchars($row["email"]) . "</p>";
                echo "<a href='deconectare.php' class='logout'>Deconectare</a>";
                echo "</div>";
            }
        } else {
            echo "Niciun rezultat gasit.";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Trebuie sa fii autentificat pentru a accesa aceasta pagina.'); window.location.href = 'autentificare.php';</script>";
    }
    ?>

    <div class="container">
        <div class="ticket-wrapper">
            <?php
            $userId = $_SESSION['userid'];

            $stmt = $conn->prepare("SELECT u.firstname, u.lastname, m.title, s.showtime, r.RoomName, st.seat_number 
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN movies m ON b.movie_id = m.movie_id
            JOIN showtimes s ON b.showtime_id = s.showtime_id
            JOIN rooms r ON b.rooms_id = r.rooms_id
            JOIN seats st ON b.seat_id = st.seat_id
            WHERE b.user_id = ? AND b.status = 0"); // status 0 inseamna rezervat

            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='ticket' onclick='openModal(" . htmlspecialchars($row['title']) . ", " . htmlspecialchars($row['RoomName']) . ", " . htmlspecialchars($row['showtime']) . ", " . htmlspecialchars($row['firstname']) . ", " . htmlspecialchars($row['lastname']) . ", " . htmlspecialchars($row['seat_number']) . ")'>";
                    echo "<h3>Film: " . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p>Ora: " . htmlspecialchars($row['showtime']) . "</p>";
                    echo "<p>Sala: " . htmlspecialchars($row['RoomName']) . "</p>";
                    echo "<p>Loc: " . htmlspecialchars($row['seat_number']) . "</p>";
                    echo "<p><b> " . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</b></p>";
                    echo "</div>";
                }
            } else {
                echo "Nicio rezervare gasita.";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalContent" class="modal-content"></div>
    </div>

    <script>
        function openModal(title, room, showtime, firstname, lastname, seatNumber) {
            var modal = document.getElementById('myModal');
            var modalContent = document.getElementById("modalContent");
            modal.style.display = "block";
            modalContent.innerHTML = "<div class='modal-ticket'>" + "<h3>" + title + "</h3>" + "<p>" + showtime + "</p>" + "<p>" + room + "</p>" + "<p>Loc: " + seatNumber + "</p>" + "<h3 style='color:black'><b>" + firstname + " " + lastname + "</b></h3>" + "</div>";
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = "none";
        }
    </script>

    <div class="container" style="margin-top: 150px;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
