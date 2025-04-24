<?php
include_once("../config/db.php");
session_start();

$title = $_SESSION['username'] . ' (' . $_SESSION['usuarioNome'] . ' ' . $_SESSION['usuarioSobrenome'] . ')'; //Trocar pelo username e nome do usuário

if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");

$stmt = $conn->prepare("SELECT 
                            COUNT(*) AS nAvaliacoesUsuario,
                            (SELECT COUNT(*) FROM listaJogado WHERE listaJogadoUsuarioID = :usuarioID) AS nJogados
                        FROM avaliacao
                        WHERE avaliacaoUsuarioID = :usuarioID");
$stmt->execute([':usuarioID' => $_SESSION['usuarioID']]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);


?>

    <main id="perfilUsuarioMain">
        <div class="container d-flex flex-column align-items-center">
            <section id="perfilInfoContainer" class="d-flex align-items-center justify-content-between flex-wrap col-10">
                <div id="perfilUsuarioContainer" class="d-flex align-items-center gap-lg-3 gap-md-3 gap-1">
                    <div id="fotoDePerfilContainer">
                        <img id="fotoDePerfil" class="w-100" src="<?= $BASE_URL ?>assets/usuarios/profilePic<?= $_SESSION['usuarioID'] ?>.jpg" alt="Foto de <?= $_SESSION['username'] ?>" onerror="if (this.src != '<?= $BASE_URL ?>assets/usuarios/unknownUser.jpg') this.src = '<?= $BASE_URL ?>assets/usuarios/unknownUser.jpg';">
                    </div>
                    <div class="d-flex flex-column">
                        <h1 id="username"><?= $_SESSION['username'] ?></h1>
                        <h2 id="nomeUsuario"><?= $_SESSION['usuarioNome'] . ' ' . $_SESSION['usuarioSobrenome'] ?></h2>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span><?= $userInfo['nAvaliacoesUsuario'] ?> Avaliações Feitas</span>
                    <span><?= $userInfo['nJogados'] ?> Jogos Jogados</span>
                </div>
            </section>

        </div>
    </main>

<?php
include_once("../templates/footer-template.php");
?>