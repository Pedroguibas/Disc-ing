<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");
session_start();


$stmt = $conn->prepare("SELECT
                            U.*,
                            (SELECT COUNT(*) FROM avaliacao WHERE avaliacaoUsuarioID = U.usuarioID) AS nAvaliacoesUsuario,
                            (SELECT COUNT(*) FROM listaJogado WHERE listaJogadoUsuarioID = U.usuarioID AND jogado = 1) AS nJogados
                        FROM usuario U
                        LEFT JOIN avaliacao A ON A.avaliacaoUsuarioID = U.usuarioID
                        WHERE usuarioID = :usuarioID
                        GROUP BY U.usuarioID;");
$stmt->execute([':usuarioID' => $_GET['u']]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT
                            J.jogoNome,
                            J.jogoID
                        FROM listaJogado L
                        RIGHT JOIN jogo J ON J.jogoID  = L.listaJogadoJogoID
                        WHERE L.listaJogadoUsuarioID = :usuarioID AND jogado = 1
                        GROUP BY J.jogoID
                        ORDER BY L.dataMarcacaoJogado DESC
                        LIMIT 4;");
$stmt->execute([':usuarioID' => $_GET['u']]);
$jogados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = $userInfo['username'] . ' (' . $userInfo['usuarioNome'] . ' ' . $userInfo['usuarioSobrenome'] . ')'; //Trocar pelo username e nome do usuário
$active = 'perfil';
if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");

?>

    <main id="perfilUsuarioMain">
        <div class="container d-flex flex-column align-items-center">
            <section id="perfilInfoContainer" class="d-flex align-items-center justify-content-between flex-wrap col-10 mb-5">
                <div id="perfilUsuarioContainer" class="d-flex align-items-center gap-lg-3 gap-md-3 gap-1">
                    <div id="fotoDePerfilContainer">
                        <img id="fotoDePerfil" class="w-100" 
                        src="<?= $BASE_URL ?>assets/usuarios/<?php echo file_exists('../assets/usuarios/profilePic' . $userInfo['usuarioID'] . '.jpg') ? 'profilePic' . $userInfo['usuarioID'] : 'unknownUser' ?>.jpg"
                        alt="Foto de <?= $userInfo['username'] ?>">
                    </div>
                    <div class="d-flex flex-column">
                        <h1 id="username"><?= $userInfo['username'] ?></h1>
                        <h2 id="nomeUsuario"><?= $userInfo['usuarioNome'] . ' ' . $userInfo['usuarioSobrenome'] ?></h2>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span><?= $userInfo['nAvaliacoesUsuario'] ?> Avaliações Feitas</span>
                    <span><?= $userInfo['nJogados'] ?> Jogos Jogados</span>
                </div>
            </section>
            <section id="jogadosRecentemente" class="col-12 mt-5">
                <h3>Jogados Recentemente</h3>
                <div class="jogosJogadosContainer row mt-1">

                <?php 
                    if (!empty($jogados)) {
                        $i=0;
                        foreach($jogados as $jogo) {
                    ?>
                    <div class="containerCardJogo p-2 d-lg-flex col-lg-3 col-md-4 <?php echo $i<3? 'd-md-flex' : 'd-md-none'; echo $i<2? ' col-6' : ' d-none' ;?>">
                        <a href="<?= $BASE_URL . 'paginasPrincipais/gamePage.php?gameID=' . $jogo['jogoID'] ?>" class="cardJogo d-flex flex-column align-items-center p-0">
                            <div class="cardJogoCoverContainer w-100">
                                <img src="../assets/Jogos/banner<?= $jogo['jogoID'] ?>.jpg" alt="Banner <?= $jogo['jogoNome'] ?>" class="w-100">
                            </div>
                            <div class="cardJogoTitleContainer">
                                <span class="cardJogoTitle p-1"><?= $jogo['jogoNome'] ?></span>
                            </div>
                        </a>
                    </div>
                <?php       $i++;
                        } 
                    } else {
                        echo '<span class="noGameFiller col-12 mt-5 mb-5">Nenhum jogo jogado :(</span>';
                    }
                ?>

                </div>
                
            </section>
        </div>
    </main>

<?php
include_once("../templates/footer-template.php");
?>