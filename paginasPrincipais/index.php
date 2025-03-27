<?php
$BASE_URL = "http://".$_SERVER['SERVER_NAME']."/Disc-ing/";
include_once("../config/db.php");

// if (usuario não logado)
//header("Location: " . $BASE_URL . "html/login.html");
?>


<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>Disc-ing</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    </head>

    <body onload="addAgeClassificacao();">
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="../img/LogoDisc-ing.png" width="90" alt="Logo Disc-ing" class="d-inline-block">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Esconder a navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="ms-auto">
                            <ul class="navbar-nav ml-auto mb-2 mb-lh-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="sobre.html">Sobre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.html">Perfil</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="headerShadow"></div>
        </header>
        <div class="bannerContainer">
            <img class="col-12" id="welcomeBanner" src="../img/welcomeBanner.png" alt="Banner de boas vindas">
        </div>
        <main class="d-flex flex-column justify-content-center m-0 contentContainerIndex">
            <section class="sectionJogosPopulares col-12 container text-align-center pt-5">
                <div class="container-fluid sm-h-75 d-flex flex-column align-items-center justify-content-center mt-5">
                    <div class="tituloContainer col-6 mb-3">
                        <div class="d-flex justify-content-center p-2 align-items-center">
                            <h1 class="h3">Populares no momento:</h1>
                        </div>
                    </div>
                    <div class="jogosPopContainer d-flex align-items-center swiper col-10">
                        <div class="cardWrapper">
                            <ul class="cardList  d-flex align-items-center swiper-wrapper">


                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="explorarJogos container col-12 d-flex justify-content-center text-align-center">
                <div class="explorarJogosContainer col-10 d-flex flex-column align-items-center justify-content-center">
                    <div class="explorarTitulo d-flex justify-content-center mt-2 col-4">
                        <h1>Explorar</h1>
                    </div>
                    <div class="filtrosJogos">
                        <button type="button" class="filtrosBtn btn btn-outline-light d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalFiltros">Filtros
                            <div id="filtrosBtnIcon">
                                <span class="material-symbols-outlined">filter_alt_off</span>
                            </div>
                        </button>
                    </div>
                    <div class="jogosContainerContent d-flex flex-column align-items-center col-12">
                        <div class="cardContainer d-flex justify-content-center">

                        </div>
                    </div>
                </div>

                <!-- Modal de seleção de filtros -->
                <div class="modal fade" id="modalFiltros">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Seleção de filtros:</h1>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form class="formFiltros">
                                    <h4>filtrar por classificação indicativa:</h2>
                                    <div class="row flex-column">
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age0">
                                            <label for="age0">Livre</label>
                                        </div>
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age10">
                                            <label for="age10">10 anos</label>
                                        </div>
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age12">
                                            <label for="age12">12 anos</label>
                                        </div>
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age14">
                                            <label for="age14">14 anos</label>
                                        </div>
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age16">
                                            <label for="age16">16 anos</label>
                                        </div>
                                        <div>
                                            <input class="checkAge" type="checkbox" id="age18">
                                            <label for="age18">18 anos</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="filtrarModal">Filtrar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </main>
        <footer>
            <div class="footerContainer container d-flex flex-column align-items-center justify-content-center">
                <div class="footerIconContainer col-md-4 col-sm-10 col-12 mt-3 d-flex justify-content-around">
                    <div class="footerIconBtn p-3">
                        <a href="https://www.instagram.com/discing_ofc?igsh=ZDZqcGkwZXppcWVv" id="instagramLink">
                            <img class="footerIcon" src="../img/icons/instagramIcon.png" alt="ícone Instagram">
                        </a>
                    </div>
                    <div class="footerIconBtn p-3">
                        <a href="#" id="facebookLink">
                            <img class="footerIcon" src="../img/icons/facebookIcon.png" alt="ícone Facebook">
                        </a>
                    </div>
                    <div class="footerIconBtn p-3">
                        <a href="https://github.com/Programetes" id="githubIcon">
                        <img class="footerIcon" src="../img/icons/githubIcon.png" alt="ícone Twitter">
                        </a>
                    </div>
                </div>
                <div class="footerLinksContainer">
                    <ul class="footerLinkList">
                        <li class="footerLink">
                            <a href="#welcomeBanner">Home</a>
                        </li>
                        <li class="footerLink">
                            <a href="sobre.html">Sobre</a>
                        </li>
                        <li class="footerLink">
                            <a href="login.html">Perfil</a>
                        </li>
                        <li class="footerLink">
                            <a href="erros.html">Erros</a>
                        </li>
                    </ul>
                </div>
                <div class="footerEmailContainer">
                    <p class="footerEmail">
                        <a href="mailto:programetes.cqtt@gmail.com">programetes.cqtt@gmail.com</a>&copy;
                    </p>
                </div>
            </div>
        </footer>
        <script>
            console.log("<?= $username ?>")
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="../javascript/index.js"></script>
    </body>

</html>