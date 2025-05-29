<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");
session_start();


if (isset($_GET['u']))
    $userID = $_GET['u'];
else
    $userID = $_SESSION['usuarioID'];
$stmt = $conn->prepare("SELECT
                            U.*,
                            (SELECT COUNT(*) FROM avaliacao WHERE avaliacaoUsuarioID = U.usuarioID) AS nAvaliacoesUsuario,
                            (SELECT COUNT(*) FROM listaJogado WHERE listaJogadoUsuarioID = U.usuarioID AND jogado = 1) AS nJogados
                        FROM usuario U
                        LEFT JOIN avaliacao A ON A.avaliacaoUsuarioID = U.usuarioID
                        WHERE usuarioID = :usuarioID
                        GROUP BY U.usuarioID;");
$stmt->execute([':usuarioID' => $userID]);
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
$stmt->execute([':usuarioID' => $userID]);
$jogados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = $userInfo['username'] . ' (' . $userInfo['usuarioNome'] . ' ' . $userInfo['usuarioSobrenome'] . ')'; //Trocar pelo username e nome do usuário
$bodyAttributes = 'onload="carregaFotoPerfil();"';
$active = 'perfil';
if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");

?>

    <main id="perfilUsuarioMain">
        <div class="container d-flex flex-column align-items-center">
            <section id="perfilInfoContainer" class="d-flex align-items-center justify-content-between flex-wrap col-10 mb-5">
                <div id="perfilUsuarioContainer" class="d-flex align-items-center gap-lg-3 gap-md-3 gap-1 mb-3">
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
                    <?php
                        if ($userID == $_SESSION['usuarioID']) 
                            echo '<button type="button" id="editarPerfilBtn" class="btn btn-primary mt-3" data-toggle="modal" data-target="#editarPerfilModal">Editar Perfil</button>';
                    ?>
                </div>
            </section>
            <section id="jogadosRecentemente" class="container col-12 mt-5">
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

    <div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="ModalAtualizarPerfil" aria-hidden="true">
        <form id="atualizaPerfilForm" action="../form/atualizaUsuario.php" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1>Atualizar Perfil</h1>
                        <button type="button" class="fecharModalBtn" style="font-size: 2em;" data-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column">
                        <label for="usernameInput">Username:</label>
                        <input type="text" id="usernameInput" name="username" value="<?= $_SESSION['username'] ?>" required>
                        <p id="usernameComEspaco" class="signinWarning">Username não pode conter espaços.</p>

                        <label for="nomeInput" class="mt-2">Nome:</label>
                        <input type="text" id="nomeInput" name="nome" value="<?= $_SESSION['usuarioNome'] ?>" required>
                        <label for="sobrenomeInput" class="mt-2">Sobrenome:</label>
                        <input type="text" id="sobrenomeInput" name="sobrenome" value="<?= $_SESSION['usuarioSobrenome'] ?>" required>
                        <label for="profilePicInput" class="mt-2 mb-2">Foto de perfil:</label>
                        <div id="fotoDePerfilPreviewContainer" class="col-lg-6 col-md-7 col-9">
                            <img id="fotoDePerfilPreview" src="" alt="Foto de perfil atual" class="w-100">
                        </div>
                        <div id="fotoDePerfilInputContainer" style="display: none;" class="col-lg-8 col-md-10 col-10">
                            <input class="form-control form-control-sm mt-4" id="profilePicInput" type="file" name="pic" accept="image/jpeg" />
                        </div>
                        
                        <button id="mostrarFotoDePerfilInputBtn" type="button" class="btn btn-outline-primary col-md-2 col-3 mt-3">alterar</button>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="fecharModalBtn btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        let BASE_URL = '<?= $BASE_URL ?>';
        let userID = <?= $_SESSION['usuarioID'] ?>;
    </script>
    <script src="../javascript/editarPerfil.js"></script>            
<?php
include_once("../templates/footer-template.php");
?>