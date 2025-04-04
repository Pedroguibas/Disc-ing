<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM jogo WHERE id = :id");
$stmt->execute([':id' => $_GET["gameID"]]);
$gameInfo = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM requisitosJogo WHERE id = :id");
$stmt->execute([':id' => $gameInfo['requisitosID']]);
$requisitos = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title><?= $gameInfo['nome'] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    </head>
    <body id="gamePageBody">
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="../assets/LogoDisc-ing.png" alt="Logo Disc-ing" class="d-inline-block w-100">
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
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
        <main>
            <div class="gamePageBanner col-12">
                <img src="<?= $BASE_URL . 'assets/Jogos/banner' . $gameInfo['id'] . '.jpg' ?>" alt="Banner <?= $gameInfo['nome'] ?>" class="gameBanner w-100">
                <div class="gameProfile d-flex align-items-center">
                    <img class="gamePageCover" src="<?= $BASE_URL . 'assets/Jogos/cover' . $gameInfo['id'] . '.jpg' ?>" alt="">
                    <h1 class="gamePageTitle"><?= $gameInfo['nome'] ?></h1>
                    <img src="<?= $BASE_URL . 'assets/Jogos/classificacao/age' . $gameInfo['classificacao'] . '.png' ?>" alt="Classificação indicativa <?= $gameInfo['classificacao'] ?>" class="gamePageClassificacao">
                </div>
            </div>
            <div class="gamePageInfoContainer container d-flex flex-column align-items-center">
                <section id="sinopse" class="col-10 m-2">
                    <div class="gameDropContainer">
                        <div class="gameDropdown">
                            <div class="buttonDrop col-12">
                                <button class="gameDropBtn d-flex align-items-center p-2">                                
                                    <h2>Sinopse</h2><i class="bi bi-caret-down-fill buttonIcon"></i>
                                </button>
                            </div>
                            <div class="gameDropContent gameDropHidden">
                                <div class="d-flex justify-content-center">
                                    <p class="col-11 mt-2"><?= $gameInfo['sinopse'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="requisitos" class="col-10 m-2">
                    <div class="gameDropContainer">
                        <div class="gameDropdown">
                            <div class="buttonDrop col-12">
                                <button class="gameDropBtn d-flex align-items-center p-2">
                                    <h2>Requisitos Mínimos</h2><i class="bi bi-caret-down-fill buttonIcon"></i>
                                </button>
                            </div>
                            <div class="gameDropContent gameDropHidden">
                                <div class="d-flex justify-content-center">
                                    <div class="col-11 mt-2">
                                        <p>Sistema Operacional: <?= $requisitos['so'] ?></p>
                                        <p>Processador: <?= $requisitos['cpu'] ?></p>
                                        <p>Placa de vídeo: <?= $requisitos['gpu'] ?></p>
                                        <p>Memória: <?= $requisitos['ram'] ?></p>
                                        <p>Armazenamento: <?= $requisitos['armazenamento'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="plataformasSection" class="col-10 m-2">
                    <div id="plataformasContainer" class="col-12">
                        <div id="plataformasTitleContainer" class="p-2">
                            <h2>Plataformas:</h2>
                        </div>
                        <div id="plataformas" class="d-flex justify-content-around m-3">
                            <?php   

                                if($gameInfo['nintendoSwitch'])
                                    echo '<i class="bi bi-nintendo-switch"></i>';
                                if($gameInfo['playstation'])
                                    echo '<i class="bi bi-playstation"></i>';
                                if($gameInfo['xbox'])
                                    echo '<i class="bi bi-xbox"></i>';
                                if($gameInfo['pc'])
                                    echo '<i class="bi bi-pc-display">';
                            
                            ?>
                        </div>
                    </div>

                </section>
                
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="../javascript/gamePage.js"></script>
    </body>
</html>