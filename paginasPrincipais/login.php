<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$title = 'Log-in';
include_once("../templates/header-template.php")

?>
<main id="loginMain">
    <section id="loginSection" class="container">
        <div class="row justify-content-center">
            <div id="loginBannerContainer" class="col-lg-5 col-md-8 col-sm-10">
                <img src="<?= $BASE_URL ?>assets/LoginBanner.png" alt="Banner da página de log-in" class="w-100" id="loginBanner">
            </div>
        </div>
        <div id="loginContainer" class="d-flex flex-column align-items-center mt-5">
            <div id="loginTitleContainer">
                <h1 id="loginTitle">Log-in</h1>
            </div>
            <form action="<?= $BASE_URL ?>form/auth.php" method="POST" id="loginForm" class="d-flex flex-column align-items-center mt-4">
                <div class="formContainer mb-5">
                    <div class="loginInputContainer d-flex align-items-center m-2">
                        <input type="text" name="usuario" placeholder="Username ou e-mail" size="25" required>
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="loginInputContainer d-flex align-items-center m-2">
                        <input class="passwordInput" type="password" name="senha" placeholder="Senha" minlength="8" size="25">
                        <button type="button" tabindex="-1" class="showPasswordBtn"><i class="bi bi-eye-slash"></i></button>
                    </div>
                    <div class="loginOptions d-flex flex-column align-items-center mt-3">
                        <p>Ainda não tem uma conta? <a href="signin.php">Cadastre-se</a></p>
                        <p class="mt-2">Esqueceu sua senha? <a href="#">Clique aqui</a></p>
                    </div>
                </div>
                

                <button class="btn btn-outline-light">Log-in</button>
            </form>
        </div>
    </section>
</main>

<script src="<?= $BASE_URL ?>javascript/login.js"></script>

<?php
include_once("../templates/footer-template.php");
?>