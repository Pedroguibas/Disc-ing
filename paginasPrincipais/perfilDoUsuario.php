<?php
include_once("../config/db.php");
session_start();


$stmt = $conn->prepare("SELECT
                            U.*,
                            (SELECT COUNT(*) FROM avaliacao WHERE avaliacaoUsuarioID = U.usuarioID) AS nAvaliacoesUsuario,
                            (SELECT COUNT(*) FROM listaJogado WHERE listaJogadoUsuarioID = U.usuarioID) AS nJogados
                        FROM usuario U
                        LEFT JOIN avaliacao A ON A.avaliacaoUsuarioID = U.usuarioID
                        WHERE usuarioID = :usuarioID
                        GROUP BY U.usuarioID;");
$stmt->execute([':usuarioID' => $_GET['u']]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);


$title = $userInfo['username'] . ' (' . $userInfo['usuarioNome'] . ' ' . $userInfo['usuarioSobrenome'] . ')'; //Trocar pelo username e nome do usuário

if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");

?>

    <main id="perfilUsuarioMain">
        <div class="container d-flex flex-column align-items-center">
            <section id="perfilInfoContainer" class="d-flex align-items-center justify-content-between flex-wrap col-10">
                <div id="perfilUsuarioContainer" class="d-flex align-items-center gap-lg-3 gap-md-3 gap-1">
                    <div id="fotoDePerfilContainer">
                        <img id="fotoDePerfil" class="w-100" 
                        src="<?= $BASE_URL ?>assets/usuarios/<?php echo file_exists('../assets/usuarios/profilePic' . $_SESSION['usuarioID'] . '.jpg') ? 'profilePic' . $_SESSION['usuarioID'] : 'unknownUser' ?>.jpg"
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

        </div>
    </main>

<?php
include_once("../templates/footer-template.php");
?>