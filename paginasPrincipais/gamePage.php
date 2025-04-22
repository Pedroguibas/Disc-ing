<?php
session_start();
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT
                            jogo.*,
                            requisitosjogo.so,
                            requisitosjogo.cpu,
                            requisitosjogo.gpu,
                            requisitosjogo.ram,
                            requisitosjogo.armazenamento,
                            SUM(avaliacao.nota) AS nota,
                            COUNT(avaliacao.avaliacaoJogoID) AS nAvaliacoes,
                            lista.naLista
                        FROM jogo
                        LEFT JOIN requisitosjogo ON jogo.jogoRequisitosJogoID = requisitosjogo.requisitosJogoID
                        LEFT JOIN avaliacao ON avaliacao.avaliacaoJogoID = jogo.jogoID
                        LEFT JOIN lista ON lista.listajogoID = jogo.jogoID AND lista.listaUsuarioID = :usuarioID
                        WHERE jogo.jogoID = :jogoID
                        GROUP BY jogo.jogoID;");

$stmt->execute([':usuarioID' => $_SESSION['usuarioID'],
                ':jogoID' => $_GET['gameID']]);
$gameInfo = $stmt->fetch(PDO::FETCH_ASSOC);


$stmt = $conn->prepare("SELECT nota FROM avaliacao WHERE avaliacaoJogoID = :jogoID AND avaliacaoUsuarioID = :usuarioID");
$stmt->execute([':jogoID' => $_GET['gameID'],
                ':usuarioID' => $_SESSION['usuarioID']]);
$notaUsuario = $stmt->fetch(PDO::FETCH_ASSOC);


if ($notaUsuario !== false)
    $notaUsuario = $notaUsuario['nota'];
else
    $notaUsuario = 0;


if ($gameInfo['naLista'] !== NULL) 
    $lista = $gameInfo['naLista'];
else
    $lista = -1;


$title = $gameInfo['jogoNome'];
$bodyAttributes = 'onload="changeScoreColor();"';
include_once("../templates/header-template.php");

?>

        <main id="gamePageMain">
            <div class="gamePageBanner col-12">
                <img src="<?= $BASE_URL . 'assets/Jogos/banner' . $gameInfo['jogoID'] . '.jpg' ?>" alt="Banner <?= $gameInfo['jogoNome'] ?>" class="gameBanner w-100">
                <div class="gameProfile d-flex align-items-center">
                    <img class="gamePageCover" src="<?= $BASE_URL . 'assets/Jogos/cover' . $gameInfo['jogoID'] . '.jpg' ?>" alt="">
                    <h1 class="gamePageTitle"><?= $gameInfo['jogoNome'] ?></h1>
                    <img src="<?= $BASE_URL . 'assets/Jogos/classificacao/age' . $gameInfo['classificacao'] . '.png' ?>" alt="Classificação indicativa <?= $gameInfo['classificacao'] ?>" class="gamePageClassificacao">
                </div>
            </div>
            <div class="gamePageInfoContainer container d-flex flex-column align-items-center">
                <section id="avaliacaoJogo" class="col-10 m-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div id="notaContainer" class="d-flex flex-column align-items-center">
                            <span id="gameScore">

                                <?php
                                if ($gameInfo['nAvaliacoes'] > 0)
                                    echo number_format($gameInfo['nota'] / $gameInfo['nAvaliacoes'], 2);
                                else
                                    echo '0.00';
                                ?>
                                
                            </span>
                            <p><?= $gameInfo['nAvaliacoes'] ?> avaliações</p>
                        </div>
                        <div id="starAvaliacaoContainer" class="mt-2">
                            <div id="starScoreContainer" class="d-flex gap-1">
                            <?php

                            for ($i=1; $i<=10; $i++) {

                                if ($i == $notaUsuario)
                                    echo '<button class="scoreStar scoreStarActive mouseOut" value="' . $i . '"><i class="bi bi-star-fill"></i></button>';
                                else
                                    echo '<button class="scoreStar mouseOut" value="' . $i . '"><i class="bi bi-star-fill"></i></button>';
                            }

                            ?>
                            </div>
                        </div>
                    </div>

                    <div id="listaBtnContainer">
                        <button id="listaBtn">
                            <?php 
                            
                            if ($lista == 1)
                                echo '<i class="bi bi-check-lg"></i>';
                            else
                                echo '<i class="bi bi-plus-square"></i>';
                            ?> Minha lista</button>
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
                                        <p>Sistema Operacional: <?= $gameInfo['so'] ?></p>
                                        <p>Processador: <?= $gameInfo['cpu'] ?></p>
                                        <p>Placa de vídeo: <?= $gameInfo['gpu'] ?></p>
                                        <p>Memória: <?= $gameInfo['ram'] ?></p>
                                        <p>Armazenamento: <?= $gameInfo['armazenamento'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="plataformasSection" class="d-flex justify-content-center col-10 m-2">
                    <div id="plataformasContainer" class="col-lg-8 col-12">
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
                <section id="comentarios" class="col-10 m-2 mt-5">
                    <h2 class="mb-3 mt-5">Comentários</h2>
                    <div id="novoComentarioContainer" class="d-flex flex-column col-lg-8 col-10">
                        <textarea id="novoComentario" class="col-12" placeholder="Adicione um comentário..."></textarea>
                        
                        <div id="novoComentarioBtnContainer" style="display: none;" class="mt-2">
                            <div class="d-flex justify-content-between mb-2">
                                <input type="checkbox" id="spoilerTag" style="display: none">
                                <label for="spoilerTag" id="spoilerCheckContainer" class="d-flex align-items-center gap-2"><i class="bi bi-square"></i><span>Spoiler</span></label>

                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button id="cancelaComentarioBtn">Cancelar</button>
                                    <button id="enviaComentarioBtn">Comentar</button>
                                </div>
                            </div>
                            <span id="avisoTagsComentario">Atenção: comentar spoilers sem o uso da tag "spoiler" pode resultar em penalidade.</span>
                        </div>
                    </div>
                    <div id="comentariosContainer" class="mt-5">
                        
                    </div>
                </section>
                
            </div>
        </main>
        <script>
            let avaliado = <?= $notaUsuario ?> != 0 ? 1 : 0;
            let naLista = <?= $lista ?>;
            let gameID = <?= $_GET['gameID'] ?>;
            let BASE_URL = '<?= $BASE_URL ?>';
        </script>
        <script type="text/javascript" src="../javascript/gamePage.js"></script>
        

<?php
include_once('../templates/footer-template.php');
?>