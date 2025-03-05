<!-- ACEASTA PAGINA CONTINE BARA DE NAVIGARE, UTILIZATA IN FIECARE PAGINA A SITE-ULUI, PENTRU CA UTILIZATORUL SA O POATA VIZUALIZA -->

<!DOCTYPE html>
<html lang="en">

<!-- TOATE LINK-URILE SE INTRODUC INTRE TAG-URILE HEAD -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eli's Cinemax</title>
    <link rel="icon" type="image/x-icon" href="../imagini/logo.png"><!--Favicon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/navBar.css">
</head>

<body>

    <!-- CREAREA BAREI DE NAVIGARE -->
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid cf1">
            <div class="logo">
                <a class="navbar-brand" href=""> 
                    <a href="../fisiere_utilizator/acasa.php">
                        <img src="../../imagini/logocine.png" alt="logo" width="150px;" style="display: flex;">
                    </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Comuta navigarea">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="nav-container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="home">
                        <ul class="nav-list">
                            <a href="./acasa.php" class="link left">
                                <li>ACASA</li>
                            </a>
                        </ul>
                    </div>

                    <div class="about">
                        <ul class="nav-list">
                            <a href="./despre.php" class="link leftT">
                                <li>DESPRE</li>
                            </a>
                        </ul>
                    </div>

                    <!-- BARA DE CAUTARE -->
                    <div class="wrapper">
                        <form action="cautare.php" method="get">
                            <input type="text" name="movie_name" placeholder="Cauta un film...">
                            <button class="searchbtn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <div class="contact">
                        <ul class="nav-list">
                            <a href="./contact.php" class="link rightT">
                                <li>CONTACT</li>
                            </a>
                        </ul>
                    </div>
                    <div class="register">
                        <ul class="nav-list">
                            <?php
                            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                echo "<li class='right'><a href='profil.php' class='link'>PROFIL</a></li>";
                            } else {
                                echo "<li class='right'><a href='autentificare.php' class='link'>AUTENTIFICARE</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <?php
    /*
    Verifica daca formularul de cautare a fost trimis si daca campul movie_name nu este gol, 
    daca este valid, utilizatorul este redirectionat la pagina numita details prin intermediul paginii search. 
    Pagina de cautare contine cod care verifica daca filmul exista in baza de date; daca da, 
    utilizatorul este redirectionat catre pagina details cu filmul cautat.
    */

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["movie_name"])) {
        $movieName = $_GET["movie_name"];

        if (!empty($movieName)) {
            header("Location: cautare.php?movie_name=" . urlencode($movieName));
            exit();
        } else {
            echo 'cautare invalida';
        }
    }
    ?>

</body>

</html>
