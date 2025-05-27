<?php
session_start();
if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");
?>

<main>
    <div class="container">
        <section id="atualizaUsuarioForm">
            <form action="../form/atualizaUsuario.php" method="POST">
                <div class="formRow d-flex flex-wrap">
                    <div class="formInputContainer d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="usernameInput">Username:</label>
                        <input type="text" id="usernameInput" name="username" value="<?= $_SESSION['username'] ?>" required>
                    </div>
                </div>
                <div class="formRow d-flex flex-wrap gap-3">
                    <div class="formInputContainer formInputLeft d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="nomeInput">Nome:</label>
                        <input type="text" id="nomeInput" name="nome" value="<?= $_SESSION['usuarioNome'] ?>" required>
                    </div>
                    <div class="formInputContainer d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="sobrenomeInput">Sobrenome:</label>
                        <input type="text" id="sobrenomeInput" name="sobrenome" value="<?= $_SESSION['usuarioSobrenome'] ?>" required>
                    </div>
                </div>
                <div class="formRow d-flex flex-wrap gap-3">
                    <div class="formInputContainer d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="profilePicInput">Foto de perfil:</label>
                        <input class="form-control form-control-sm" id="profilePicInput" type="file" name="banner" accept="image/jpeg" />
                        <button type="button" class="mostrarInputEditarJogoBtn btn btn-outline-light mt-2">alterar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>

<?php
include_once("../templates/footer-template.php");
?>