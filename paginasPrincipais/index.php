<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");
session_start();

$aditionalTags = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">';

if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");
$stmt = $conn->prepare("SELECT jogo.*, SUM(avaliacao.nota) AS nota, COUNT(avaliacao.avaliacaoJogoID) AS nAvaliacoes
FROM jogo
LEFT JOIN avaliacao ON avaliacao.avaliacaoJogoID = jogo.jogoID
GROUP BY jogo.jogoID;");
$stmt->execute();
$Jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <main id="indexmain" class="d-flex justify-content-center">
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

                                foreach ($Jogos as $Jogo) {

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
                                                    <img class="cardClassificacao" alt="Classificação ' . $Jogo['classificacao'] . ' anos" src="' . $BASE_URL . 'assets/Jogos/classificacao/age' . $Jogo['classificacao'] . '.png">
                                                </div>
                                                <div class="cardScoreContainer">
                                                    <span class="cardScore d-flex align-items-center gap-2"><i class="bi bi-star-fill"></i> '. $cardScore .'</span>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="../javascript/index.js"></script>
<?php
include_once('../templates/footer-template.php');
?>