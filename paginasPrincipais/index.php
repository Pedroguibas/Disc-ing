<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");
session_start();

$aditionalTags = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">';
$bodyAttributes = 'onload="swiperCheck();"';
if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");
$stmt = $conn->prepare("SELECT
                            J.*,
                            SUM(A.nota) AS nota,
                            COUNT(A.avaliacaoJogoID) AS nAvaliacoes
                        FROM vw_jogosPopulares J
                        LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
                        GROUP BY J.jogoID;");
$stmt->execute();
$JogosPopulares = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT
                            J.*,
                            SUM(A.nota) AS nota,
                            COUNT(A.avaliacaoJogoID) AS nAvaliacoes
                        FROM jogo J
                        LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
                        GROUP BY J.jogoID;");
$stmt->execute();
$Jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <main id="indexmain" class="d-flex flex-column align-items-center">
        <section class="sectionJogosPopulares container">
            <form action="gamePage.php">
                <div class="titleContainer">
                    <h1>Jogos Populares</h1>
                </div>
                <div class="jogosPopContainer container-fluid d-flex flex-column align-items-center justify-content-center">
                    <div class="col-12 d-flex align-items-center swiper">
                        <div class="cardWrapper">
                            <input id="gamePageHeader" type="hidden" name="gameID" value="">
                            <ul class="cardList  d-flex align-items-center swiper-wrapper">

                                <?php

                                foreach ($JogosPopulares as $Jogo) {

                                    if ($Jogo['nAvaliacoes'] > 0)
                                        $cardScore = number_format($Jogo['nota'] / $Jogo['nAvaliacoes'], 2);
                                    else
                                        $cardScore = number_format(0, 2);

                                    echo '
                                        <li class="cardItem swiper-slide" id="game'. $Jogo['jogoID'] .'">
                                            <button class="cardLink" onclick="document.getElementById('."'gamePageHeader'".').value = '. $Jogo['jogoID'] .'">
                                                <img class="cardImg w-100" src="../assets/Jogos/banner' . $Jogo['jogoID'] . '.jpg" alt="Capa ' . $Jogo['jogoNome'] . '">
                                                <div class="cardTitleContainer d-flex justify-content-between align-items-end">
                                                    <h2 class="cardTitle">' . $Jogo['jogoNome'] . '</h2>
                                                    <img class="cardClassificacao" alt="Classificação ' . $Jogo['classificacao'] . '" src="' . $BASE_URL . 'assets/Jogos/classificacao/age' . $Jogo['classificacao'] . '.png">
                                                </div>
                                                <div class="cardScoreContainer">
                                                    <span class="cardScore d-flex align-items-center gap-2"><i class="bi bi-star-fill cardScoreStar"></i> '. $cardScore .'</span>
                                                </div>
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
            </form>
        </section>
        <section id="sectionJogos" class="container mt-5">
            <div class="titleContainer">
                <h1>Todos os Jogos</h1>
            </div>
            <div id="listaJogo" class="mt-2">
                
            <?php foreach($Jogos as $Jogo) { ?>
                <a  href="<?= $BASE_URL ?>/paginasPrincipais/gamePage.php?gameID=<?= $Jogo['jogoID'] ?>" class="itemListaJogo d-flex gap-2 col-md-8 col-12 mt-2">
                    <div class="itemListaJogoImg">
                        <img src="<?= $BASE_URL ?>assets/Jogos/cover<?= $Jogo['jogoID'] ?>.jpg" alt="Capa <?= $Jogo['jogoNome'] ?>" class="w-100">
                    </div>
                    <div class="itemListaJogoInfo d-flex flex-column">
                        <div class="itemListaJogoTituloContainer">
                            <span class="itemListaJogoTitulo"><?= $Jogo['jogoNome'] ?></span>
                        </div>
                        <div class="itemListaJogoPlatContainer d-flex gap-1">
                            <?php
                            
                            if($Jogo['windowsOS'])
                            echo '<i class="bi bi-microsoft itemListaJogoPlat"></i>';
                            if ($Jogo['linuxOS'])
                                echo '<i class="bi bi-ubuntu itemListaJogoPlat"></i>';
                            if ($Jogo['macOS'])
                                echo '<i class="bi bi-apple itemListaJogoPlat"></i>';
                            if($Jogo['playstation'])
                                echo '<i class="bi bi-playstation itemListaJogoPlat"></i>';
                            if($Jogo['xbox'])
                                echo '<i class="bi bi-xbox itemListaJogoPlat"></i>';
                            if($Jogo['nintendoSwitch'])
                                echo '<i class="bi bi-nintendo-switch itemListaJogoPlat"></i>';
                            if ($Jogo['androidOS'])
                                echo '<i class="bi bi-android2 itemListaJogoPlat"></i>';

                            ?>
                        </div>
                    </div>
                    <div class="itemListaJogoClassificacao">
                        <img src="<?= $BASE_URL ?>assets/Jogos/classificacao/age<?= $Jogo['classificacao'] ?>.png" alt="Classificação <?= $Jogo['classificacao'] ?>" class="w-100">
                    </div>
                </a>
            <?php } ?>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="../javascript/index.js"></script>
<?php
include_once('../templates/footer-template.php');
?>