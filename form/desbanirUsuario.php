<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once('../config/db.php');
include_once('../templates/admHeader-template.php');
$stmt = $conn->prepare("UPDATE usuario SET banido = 0 WHERE usuarioID = :usuarioID");
$stmt->execute([':usuarioID' => $_POST['userID']]);

?>
<main class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="d-flex flex-column p-4 gap-3 m-4" style="background: #fff; border-radius: 1em;">
        <h1 style="color: #000;">Usuário banido com sucesso.</h1>
        <p style="text-align: center; color: #00000090"><b style="color: #000;"><?= $_POST['username'] ?></b> foi banido(a).</p>
        <a class="btn btn-primary" href="<?= $BASE_URL ?>paginasPrincipais/admin/banUser.php">retornar</a>
    </div>
</main>
<?php
include_once('../templates/footer-template.php');
?>