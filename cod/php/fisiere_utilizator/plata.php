<?php
session_start(); // Inceperea sesiunii pentru a retine ID-ul si numele complet al utilizatorului
require "../Tables-MakeDB/makeDBConnection.php";
require "efectuarePlata.php";
require "../../html/navBar.php";

// Aceasta pagina va fi afisata utilizatorului doar daca este autentificat
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';
    $showtime = isset($_GET['showtime']) ? htmlspecialchars($_GET['showtime']) : '';
    $room = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : '';
    $seat = isset($_GET['seat']) ? htmlspecialchars($_GET['seat']) : '';

    echo "<div class='info'>";
    echo "<h2>Rezervarea Ta:</h2>";
    echo "<p>Film: $title</p>";
    echo "<p>Ora: $showtime</p>";
    echo "<p>Sala: $room</p>";
    echo "<p>Loc: $seat</p>";
    echo "</div>";
}
?>

<html>

<head>
    <title>Pagina de Plata</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/navBar.css">

    <style>
        .checkoutBtn {
            width: 120px;
            background-color: grey;
            color: white;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkoutBtn:hover {
            background-color: #555 !important;
        }

        .checkoutBtn:active {
            background-color: #545254 !important;
        }

        .form-control {
            width: 300px;
        }

        .paymentbox {
            margin-top: 30px;
            background-color: #efefef;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .split {
            display: inline-block;
            margin-right: 50px;
            padding-left: 15px;
        }

        .split label {
            display: block;
        }

        .info {
            color: white;
            margin-left: 150px;
        }

        .w-container {
            padding-bottom: 20px;
            background-color: #efefef;
            padding-top: 10px;
            border-radius: 10px;
        }

        .st>.split {
            margin-right: 55px;
        }
    </style>
</head>

<body style="background-color:black">
    <div class="form-container" style="margin-top:10px;">
        <div class="w-container" style="max-width:750px;; margin:auto">
            <h3 style="text-align: center; margin-bottom:40px"><b>Completati toate campurile pentru a continua achizitia</b></h3>
            <form action="" method="GET">
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="showtime" value="<?php echo $showtime; ?>">
                <input type="hidden" name="room" value="<?php echo $room; ?>">
                <input type="hidden" name="seat" value="<?php echo $seat; ?>">

                <div class="st">
                    <div class="split">
                        <p>
                            <label>Prenume</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName">
                        </p>
                    </div>
                    <div class="split">
                        <p>
                            <label>Nume</label>
                            <input type="text" class="form-control" id="LastName" name="LastName">
                        </p>
                    </div>
                    <div class="split">
                        <p>
                            <label>Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="Email">
                        </p>
                    </div>
                    <div class="split">
                        <p>
                            <label>Adresa</label>
                            <input type="text" class="form-control" id="HouseAddress" name="HouseAddress">
                        </p>
                    </div>
                    <div class="split">
                        <p>
                            <label>Cod Postal</label>
                            <input type="text" class="form-control" id="ZipCode" name="ZipCode">
                        </p>
                    </div>
                    <div class="split">
                        <p>
                            <label>Numar Telefon</label>
                            <input type="text" class="form-control" id="PhoneNum" name="PhoneNum">
                        </p>
                    </div>
                </div>
                <div class="paymentbox ">
                    <div class="w-container paybox">
                        <h3 style="text-align:center; margin-bottom:40px;"><b>Informatii pentru plata</b></h3>
                        <div class="split">
                            <p>
                                <label>Numar Card</label>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" id="CardNum" name="CardNum">
                            </p>
                        </div>
                        <div class="split">
                            <p>
                                <label>Data Expirarii</label>
                                <input type="text" class="form-control" placeholder="MM/YY" id="ExpireDate" name="ExpireDate">
                            </p>
                        </div>
                        <div class="split">
                            <p>
                                <label>Numele detinatorului</label>
                                <input type="text" class="form-control" id="NameOnCard" name="NameOnCard">
                            </p>
                        </div>
                        <div class="split">
                            <p>
                                <label>Cod Securitate (CVV/CVC)</label>
                                <input type="text" class="form-control" placeholder="123" id="SecCode" name="SecCode">
                            </p>
                        </div>
                        <br><br>
                        <button type="submit" name="submit" class="btn btn-outline-secondary checkoutBtn" style="border-radius: 10px;">
                            Cumpara
                        </button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <section style="margin-top: 70px;">
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
    </section>
</body>

<?php
} else {
    echo "<p>Bine ai venit, vizitator! <a href='autentificare.php'>Logheaza-te</a> sau <a href='inregistrare.php'>inregistreaza-te</a> pentru mai multe functionalitati.</p>";
}
?>
