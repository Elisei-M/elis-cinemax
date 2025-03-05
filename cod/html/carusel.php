<!-- ACEASTA PAGINA INCLUDE INTREGUL CAROUSEL SI BUTOANELE SALE -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eli's Cinemax</title>

    <link rel="icon" type="image/x-icon" href="../imagini/logo.png"><!--Favicon-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> <!--Bootstrap5-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Iconita bara de cautare -->

    <link rel="stylesheet" href="../css/style.css"> <!-- link catre style.css-->
</head>

<body>

    <!-- Clase Bootstrap pentru a crea CAROUSEL -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">


<!-- Clip 1 -->
<div class="carousel-item active">
    <iframe width="100%" height="500" src="https://www.youtube.com/embed/ZzelhiKI7gs?si=nfl_XJTNFvYcciDD&controls=0&start=1&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    <div class="carousel-caption d-md-block">
        <form action="maiMulteFilme2.php">
            <button class="button">cumpara bilet</button>
        </form>
    </div>
</div>

<!-- Clip 2 -->
<div class="carousel-item">
    <iframe width="100%" height="500" src="https://www.youtube.com/embed/z-1n5rCp61o?si=NKgJyPw8Mu6dE1H2&controls=0&start=8&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <div class="carousel-caption d-md-block">
        <form action="maiMulteFilme2.php">
            <button class="button">cumpara bilet</button>
        </form>
    </div>
</div>

<!-- Clip 3 -->
<div class="carousel-item">
    <iframe width="100%" height="500" src="https://www.youtube.com/embed/xvRC1SmsQOE?si=PxCcb28LYRFaPx4q&controls=0&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <div class="carousel-caption d-md-block">
        <form action="maiMulteFilme2.php">
            <button class="button">cumpara bilet</button>
        </form>
    </div>
</div>



        <!-- BUTOANE CAROUSEL din libraria Bootstrap -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Urmator</span>
        </button>
    </div>

    <div class="container drop">
        <div class="btn-group mt-5">
        <a href="../fisiere_utilizator/maiMulteFilme2.php" class="btn btn-secondary btn-lg downButton" role="button">
            TOATE FILMELE
        </a>
    </div>
</div>

    <!-- Creare SPATIU -->
    <div style="margin-top:150px ;">
    </div>

    <!-- conectare bst -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    const myCarouselElement = document.querySelector('#carouselExampleAutoplaying')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
        interval: 10000,  // Trecerea la următorul slide se va face la fiecare 10 secunde
        touch: false      
    })
</script>

</body>

</html>
