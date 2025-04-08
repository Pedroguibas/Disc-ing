<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM jogo WHERE id = :id");
$stmt->execute([':id' => $_GET["gameID"]]);
$gameInfo = $stmt->fetch();

$title = $gameInfo['nome'];
$bodyAttributes = ' id="gamePageBody" onload="changeScoreColor();"';
include_once("../templates/header-template.php");

$stmt = $conn->prepare("SELECT * FROM requisitosJogo WHERE id = :id");
$stmt->execute([':id' => $gameInfo['requisitosID']]);
$requisitos = $stmt->fetch();

$stmt = $conn->prepare("SELECT SUM(nota) AS nota, COUNT(*) AS nAvaliacoes FROM avaliacao WHERE jogoID = :jogoID");
$stmt->execute([':jogoID' => $_GET['gameID']]);
$gameScore = $stmt->fetch();

$stmt = $conn->prepare("SELECT nota FROM avaliacao WHERE jogoID = :jogoID AND usuarioID = :usuarioID");
$stmt->execute([':jogoID' => $_GET['gameID'],
                ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
$notaUsuario = $stmt->fetch();


if ($notaUsuario !== false)
    $notaUsuario = $notaUsuario['nota'];
else
    $notaUsuario = 0;

    
$stmt = $conn->prepare("SELECT naLista FROM lista WHERE usuarioID = :usuarioID AND jogoID = :jogoID");
$stmt->execute([':jogoID' => $_GET['gameID'],
                ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
$lista = $stmt->fetch();

if ($lista !== false) 
    $lista = $lista['naLista'];
else
    $lista = NULL;

?>

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
                <section id="avaliacaoJogo" class="col-10 m-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div id="notaContainer" class="d-flex flex-column align-items-center">
                            <span id="gameScore">

                                <?php
                                if ($gameScore['nAvaliacoes'] > 0)
                                    echo number_format($gameScore['nota'] / $gameScore['nAvaliacoes'], 2);
                                else
                                    echo '0.00';
                                ?>
                                
                            </span>
                            <p><?= $gameScore['nAvaliacoes'] ?> avaliações</p>
                        </div>
                        <div id="starAvaliacaoContainer" class="mt-2">
                            <form action="../form/avaliaJogo.php" method="POST">
                                <input type="hidden" name="gameID" value="<?= $_GET['gameID'] ?>">
                                <input id="notaInput" type="hidden" name="nota" value="">
                                <input type="hidden" name="avaliado" value="
                                <?php 
                                    if ($notaUsuario != 0) 
                                        echo '1';
                                    else
                                        echo '0';
                                ?>">
                                
                                <div id="starScoreContainer" class="d-flex gap-1">
                                <?php

                                for ($i=1; $i<=10; $i++) {

                                    if ($i == $notaUsuario)
                                        echo '<button class="scoreStar scoreStarActive mouseOut" onclick="document.getElementById(' . "'notaInput'" . ').value = ' . $i . '"><i class="bi bi-star-fill"></i></button>';
                                    else
                                        echo '<button class="scoreStar mouseOut" onclick="document.getElementById(' . "'notaInput'" . ').value = ' . $i . '"><i class="bi bi-star-fill"></i></button>';
                                }

                                ?>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="listaBtnContainer">
                        <form action="../form/adicionaNaLista.php" method="POST">
                            <input type="hidden" name="gameID" value="<?= $_GET['gameID'] ?>">
                            <input type="hidden" name="naLista" value="<?= $lista ?>">
                            <button id="listaBtn" >
                                <?php 
                                
                                if ($lista == 1)
                                    echo '<i class="bi bi-check-lg"></i>';
                                else
                                    echo '+';
                                ?> Minha lista</button>
                        </form>
                    </div>
                    
                </section>

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
                                    echo '<i class="bi bi-pc-display"></i>';
                            
                            ?>
                        </div>
                    </div>

                </section>
                
            </div>
        </main>
        <script type="text/javascript" src="../javascript/gamePage.js"></script>

<?php
include_once('../templates/footer-template.php');
?>