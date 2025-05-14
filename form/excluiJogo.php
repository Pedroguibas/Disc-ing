<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";

include_once('../templates/admHeader-template.php');
include_once('../config/db.php');

// $stmt = $conn->prepare("DELETE FROM jogo WHERE jogoID = :id");
// $stmt->execute([':id' => $_POST['id']]);


// unlink('../assets/Jogos/banner' . $_POST['id'] . '.jpg');
// unlink('../assets/Jogos/cover' . $_POST['id'] . '.jpg');
?>
<main class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="d-flex flex-column p-4 gap-3 m-4" style="background: #fff; border-radius: 1em;">
        <h1 style="color: #000;">Jogo deletado com sucesso.</h1>
        <p style="text-align: center; color: #00000090">"<?= $_POST['nome'] ?>" foi excluído.</p>
        <a class="btn btn-primary" href="<?= $BASE_URL ?>paginasPrincipais/admin/deletarJogo.php">retornar</a>
    </div>
</main>

<?php
include_once('../templates/footer-template.php');
?>