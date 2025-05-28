<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once('../config/db.php');
session_start();

$username = trim(htmlspecialchars($_POST['username']));
$nome = trim(htmlspecialchars($_POST['nome']));
$sobrenome = trim(htmlspecialchars($_POST['sobrenome']));

$stmt = $conn->prepare("UPDATE usuario SET username = :username , usuarioNome = :nome , usuarioSobrenome = :sobrenome WHERE usuarioID = :id");
$stmt->execute([':username' => $username,
                ':nome' => $nome,
                ':sobrenome' => $sobrenome,
                ':id' => $_SESSION['usuarioID']]);

$_SESSION['username'] = $username;
$_SESSION['usuarioNome'] = $nome;
$_SESSION['usuarioSobrenome'] = $sobrenome;
?>
<script>
let BASE_URL = <?= $BASE_URL ?>;
if (
<?php
    if (!$_FILES['pic']['error'] > UPLOAD_ERR_OK)
        echo 1;
    else
        echo 0;
?> == 1) {
    let caminho = 'assets/usuarios/profilePic<?= $_SESSION['usuarioID'] ?>.jpg'
    $.ajax({
        url: BASE_URL + 'form/checaArquivo.php',
        method: 'GET',
        data: {
            path: caminho
        },
        success: function(result) {
            if (result == 1) 
                $.ajax({
                    url: BASE_URL + 'form/deletaArquivo.php',
                    method: 'POST',
                    data: {
                        path: 'assets/usuarios/profilePic<?= $_SESSION['usuarioID'] ?>.jpg'
                    }
                })
        }
    });
}
</script>
<?php


$diretorio = '../assets/usuarios/';

if (!$_FILES['pic']['error'] > UPLOAD_ERR_OK) {
    $pic = $diretorio . basename($_FILES['pic']['name']);
    move_uploaded_file($_FILES['pic']['tmp_name'], $pic);
    rename($pic, $diretorio . 'profilePic' . $_SESSION['usuarioID'] . '.jpg');
}

// header('Location: ' . $BASE_URL . 'paginasPrincipais/perfilDoUsuario.php');
?>