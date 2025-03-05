<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Incarcare</title>
    <link rel="icon" type="image/x-icon" href="../imagini/logo.png"><!--Favicon-->

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <!-- Bara de navigare -->
    <nav class="navbar navbar-expand-lg lower-navbar">
        <div class="container">

            <div class="logo">
                <a class="navbar-brand" href="">
                    <a href="../fisiere_operator/operator.php">
                        <img src="../../imagini/logocine.png" alt="Bootstrap" width="130px;">
                    </a>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="../fisiere_operator/operator.php" class="nav-link">ACASA</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisiere_operator/update.php" class="nav-link">ACTUALIZARE</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisiere_operator/stergereForm.php" class="nav-link">STERGERE</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisiere_operator/cereri.php" class="nav-link">CERERI</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisiere_operator/inregistrareOperator.php" class="nav-link">INREGISTRARE</a>
                    </li>
                    <li class="nav-item">
                        <a href="../fisiere_operator/admin.php" class="nav-link">ADMIN</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="../fisiere_utilizator/deconectare.php" class="nav-link logout-nav">DECONECTARE</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cod JavaScript pentru bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
