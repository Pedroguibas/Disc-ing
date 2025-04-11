<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$title = 'Sign-in';
include_once("../templates/header-template.php");

?>
    <main id="signinMain">
        <section id="signinSection" class="container">
            <div class="row justify-content-center">
                <div id="loginBannerContainer"  class="col-lg-5 col-md-8 col-sm-10">
                    <img src="<?= $BASE_URL ?>assets/SigninBanner.png" alt="Banner de Cadastro" class="w-100" id="loginBanner">
                </div>
                <div id="loginContainer" class="d-flex flex-column align-items-center mt-5">
                    <div id="loginTitleContainer">
                        <h1 id="loginTitle">Sign-in</h1>
                    </div>
                    <form action="<?= $BASE_URL ?>form/registraUsuario.php" method="POST" id="loginForm" class="d-flex flex-column align-items-center mt-4">
                        <div class="formContainer mb-5">
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input type="email" id="email" name="email" placeholder="e-mail" size="25" required>
                                <i class="bi bi-envelope"></i>
                            </div>
                            <p id="emailCadastradoWarning" class="loginWarning">Já existe um usuário com este e-mail.</p>
                            <p id="emailInvalidoWarning" class="loginWarning">O e-mail digitado não é válido.</p>
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input type="text" name="nome" placeholder="Nome" size="25" required>
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input type="text" name="sobrenome" placeholder="Sobrenome" size="25" required>
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input type="text" id="username" name="username" placeholder="Username" size="25" required>
                                <i class="bi bi-person"></i>
                            </div>
                            <p id="usuarioCadastradoWarning" class="loginWarning">Já existe um usuário com este username.</p>
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input class="passwordInput" id="senha" type="password" name="senha" placeholder="Senha" minlength="8" size="25">
                                <button type="button" tabindex="-1" class="showPasswordBtn"><i class="bi bi-eye-slash"></i></button>
                            </div>
                            <div class="loginInputContainer d-flex align-items-center m-2">
                                <input class="passwordInput" id="confirma-senha" type="password" name="confirma-senha" placeholder="Confirmar senha" minlength="8" size="25">
                                <button type="button" tabindex="-1" class="showPasswordBtn"><i class="bi bi-eye-slash"></i></button>
                            </div>

                            <p id="wrongPasswordWarning" class="loginWarning">As senhas não conferem.</p>

                            <div class="loginOptions d-flex flex-column align-items-center mt-3">
                                <p>Já passou por aqui? <a href="login.php">Entre com sua conta</a></p>
                            </div>
                        </div>

                        <button class="btn btn-outline-light" onclick="return checkSenha(); return validaEmail();">Sign-in</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script> let BASE_URL = '<?= $BASE_URL ?>'; </script>
    <script src="<?= $BASE_URL ?>javascript/login.js"></script>
    <script src="<?= $BASE_URL ?>javascript/signin.js"></script>


<?php
include_once("../templates/footer-template.php");
?>