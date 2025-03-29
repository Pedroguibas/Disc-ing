<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM jogo");
$stmt->execute();
$Jogos = $stmt->fetchAll();

// if (usuario não logado)
//header("Location: " . $BASE_URL . "paginasPrincipais/login.php");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Disc-ing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../assets/LogoDisc-ing.png" width="90" alt="Logo Disc-ing" class="d-inline-block">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent"
                    aria-expanded="false" aria-label="Esconder a navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto">
                        <ul class="navbar-nav ml-auto mb-2 mb-lh-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sobre.php">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="perfilDoUsuario.php">Perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="headerShadow"></div>
    </header>
    <main id="indexmain" class="d-flex justify-content-center">
        <section class="sectionJogosPopulares container">
            <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
                <div class="jogosPopContainer col-12 d-flex align-items-center swiper">
                    <div class="cardWrapper">
                        <ul class="cardList  d-flex align-items-center swiper-wrapper">

                            <?php
                            foreach ($Jogos as $Jogo) {
                                echo '
                                    <li class="cardItem swiper-slide">
                                        <button class="cardLink">
                                            <img class="cardImg w-100" src="../assets/Jogos/cover' . $Jogo['id'] . '.jpg" alt="Capa ' . $Jogo['nome'] . '">
                                            <h2 class="cardTitle">' . $Jogo['nome'] . '</h2>
                                        </button>
                                    </li> 
                                ';
                            }
                            ?>

                        </ul>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="../javascript/index.js"></script>
</body>

</html>