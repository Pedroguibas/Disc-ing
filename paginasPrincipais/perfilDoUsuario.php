<?php
include_once("../config/db.php");

$title = $_SESSION['username'] . ' ' . $_SESSION['usuarioNome'] . ' ' . $_SESSION['usuarioSobrenome']; //Trocar pelo username e nome do usuário
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
        <div class="container">
            <section id="perfilInfoContainer">
                <div class="d-flex">
                    <div id="fotoDePerfilContainer">
                        <img src="" alt="Foto de">
                    </div>
                </div>
            </section>

        </div>
    </main>

<?php
include_once("../templates/footer-template.php");
?>