<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");
session_start();

$aditionalTags = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">';
$bodyAttributes = 'onload="swiperCheck(); carregaJogos();"';
$active = 'home';
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
                        GROUP BY J.jogoID
                        ORDER BY nota DESC
                        LIMIT 6;");
$stmt->execute();
$JogosPopulares = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT
                            J.*,
                            SUM(A.nota) AS nota,
                            COUNT(A.avaliacaoJogoID) AS nAvaliacoes
                        FROM jogo J
                        LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
                        GROUP BY J.jogoID
                        ORDER BY J.jogoNome;");
$stmt->execute();
$Jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM jogo;");
$stmt->execute();
$totalJogos = $stmt->fetch(PDO::FETCH_ASSOC);
$totalPaginas = ceil($totalJogos['total'] / 10);

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

                                foreach ($JogosPopulares as $Game) {

                                    if ($Game['nAvaliacoes'] > 0)
                                        $cardScore = number_format($Game['nota'] / $Game['nAvaliacoes'], 2);
                                    else
                                        $cardScore = number_format(0, 2);

                                    echo '
                                        <li class="cardItem swiper-slide" id="game'. $Game['jogoID'] .'">
                                            <button class="cardLink" onclick="document.getElementById('."'gamePageHeader'".').value = '. $Game['jogoID'] .'">
                                                <img class="cardImg w-100" src="../assets/Jogos/banner' . $Game['jogoID'] . '.jpg" alt="Capa ' . $Game['jogoNome'] . '">
                                                <div class="cardTitleContainer d-flex justify-content-between align-items-end">
                                                    <h2 class="cardTitle">' . $Game['jogoNome'] . '</h2>
                                                    <img class="cardClassificacao" alt="Classificação ' . $Game['classificacao'] . '" src="' . $BASE_URL . 'assets/Jogos/classificacao/age' . $Game['classificacao'] . '.png">
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
            <div class="col-md-4 col-10 mt-2">
                <input class="form-control" id="gameSearchbar" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div id="listaJogo" class="mt-2">
            
            </div>
            <div class="listaJogoPaginationContainer d-flex justify-content-center align-items-center gap-2 col-md-8 col-12 mt-2">
                <button id="leftPageBtn" class="paginationBtn d-flex align-items-center justify-content-center"><i class="bi bi-arrow-left"></i></button>
                <div class="listaJogoPaginationInfo"><span id="currentPage">1</span> de <span id="totalPages"><?= $totalPaginas ?></span></div>
                <button id="rightPageBtn" class="paginationBtn active d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right"></i></button>
            </div>
        </section>
    </main>
    <script>
        let BASE_URL = '<?= $BASE_URL ?>';
        class Pagination {
            static curPage = 1;
            static totalPages = <?= $totalPaginas; ?>;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="../javascript/index.js"></script>
    <script src="../javascript/listaJogoPagination.js"></script>
<?php
include_once('../templates/footer-template.php');
?>