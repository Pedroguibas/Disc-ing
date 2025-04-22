<?php
include_once("../config/db.php");
session_start();

$title = $_SESSION['username'] . ' (' . $_SESSION['usuarioNome'] . ' ' . $_SESSION['usuarioSobrenome'] . ')'; //Trocar pelo username e nome do usuário
include_once("../templates/header-template.php");

$stmt = $conn->prepare("SELECT
                            usuario.*,
                            (SELECT COUNT(*) FROM avaliacao WHERE avaliacaoUsuarioID = :usuarioID GROUP BY avaliacaoUsuarioID) AS nAvaliacao 
                        FROM usuario
                        WHERE usuario.usuarioID = :usuarioID");
$stmt->execute([':usuarioID' => 1]); //Trocar por id do usuario
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

?>

    <main id="perfilUsuarioMain">
        <div class="container d-flex flex-column align-items-center">
            <section id="perfilInfoContainer" class="col-10">
                <div class="d-flex align-items-center gap-3">
                    <div id="fotoDePerfilContainer" class="col-lg-3 col-md-3 col-5">
                        <img id="fotoDePerfil" class="w-100" src="<?= $BASE_URL ?>assets/usuarios/profilePic<?= $_SESSION['usuarioID'] ?>.jpg" alt="Foto de <?= $_SESSION['username'] ?>" onerror="if (this.src != '<?= $BASE_URL ?>assets/usuarios/unknownUser.jpg') this.src = '<?= $BASE_URL ?>assets/usuarios/unknownUser.jpg';">
                    </div>
                    <div class="d-flex flex-column">
                        <h1 id="username"><?= $_SESSION['username'] ?></h1>
                        <h2 id="nomeUsuario"><?= $_SESSION['usuarioNome'] . ' ' . $_SESSION['usuarioSobrenome'] ?></h2>
                    </div>
                </div>
            </section>

        </div>
    </main>

<?php
include_once("../templates/footer-template.php");
?>