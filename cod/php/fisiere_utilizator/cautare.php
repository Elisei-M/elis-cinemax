<?php 
session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .Error {
            color: white;
            text-align: center;
            font-size: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }

        .return {
            float: right;
            margin-right: 30%;
            font-size: 20px;
            margin-top: -6px;
        }
    </style>

    <title>Cautare</title>
</head>

<body style="background-color: black;">

    <?php
    require "../Tables-MakeDB/makeDBConnection.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movie_name'])) {
        $movieName = trim($_GET['movie_name']);

        if (!empty($movieName)) {
            $movieName = $conn->real_escape_string($movieName);

            $sql = "SELECT movie_id, title FROM movies WHERE title LIKE ?";
            $stmt = $conn->prepare($sql);
            $searchTerm = '%' . $movieName . '%';
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                header("Location: detalii.php?title=" . urlencode($row['title']));
                exit();
            } else {
                echo "<div class='Error'>Niciun film gasit cu acest nume.</div>";
            }
        } else {
            header("Location: acasa.php");
            exit();
        }
    }
    ?>

    <div class="nav-container">
        <div class="wrapper">
            <form action="search.php" method="get">
                <input type="text" name="movie_name" placeholder="Cauta un film...">
                <button class="searchbtn" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <a href="acasa.php" class="return">Inapoi</a>

    <section style="margin-top:60px">

    </section>
    <?php
    if ($conn->connect_error) {
        die("Conexiunea a esuat: " . $conn->connect_error);
    }

    $sql = "SELECT movie_id, title, image_path FROM movies ORDER BY RAND() LIMIT 8";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='grid-container container'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='movie-card'>";
            echo "<form action='detalii.php' method='get'>";
            echo "<input type='hidden' name='title' value='" . htmlspecialchars($row["title"]) . "'>";
            echo "<button type='submit' class='movie_img'>";
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Imagine Film'>";
            echo "<div>" . htmlspecialchars($row["title"]) . "</div>";
            echo "</button>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div>Niciun rezultat gasit</div>";
    }
    ?>
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

</html>
