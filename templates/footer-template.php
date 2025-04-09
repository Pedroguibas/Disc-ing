<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";

?>

<footer>
    <div id="footerContainer" class="container">
        <ul id="footerLinksContainer" class="d-flex justify-content-center">
            <li class="footerSocialLink">
                <a href="https://github.com/Programetes">
                    <button class="footerSocialLinkBtn d-flex justify-content-center align-items-center">
                        <i class="bi bi-github"></i>
                    </button>
                </a>
            </li>
            <li class="footerSocialLink">
                <a href="https://www.instagram.com/discing_ofc?igsh=ZDZqcGkwZXppcWVv">
                    <button class="footerSocialLinkBtn d-flex justify-content-center align-items-center">
                        <i class="bi bi-instagram"></i>
                    </button>
                </a>
            </li>
            <li class="footerSocialLink">
                <a href="#">
                    <button class="footerSocialLinkBtn d-flex justify-content-center align-items-center">
                        <i class="bi bi-facebook"></i>
                    </button>
                </a>
            </li>
        </ul>
        <div class="d-flex justify-content-center">
            <ul class="d-flex justify-content-center gap-lg-5 gap-md-5 gap-sm-4 gap-3 mt-4 mb-4">
                <li class="footerLink">
                    <a href="<?= $BASE_URL . 'paginasPrincipais/index.php' ?>">Home</a>
                </li>
                <li class="footerLink">
                    <a href="<?= $BASE_URL . 'paginasPrincipais/sobre.php' ?>">Sobre</a>
                </li>
                <li class="footerLink">
                    <a href="<?= $BASE_URL . 'paginasPrincipais/perfilDoUsuario.php' ?>">Perfil</a>
                </li>
                <li class="footerLink">
                    <a href="<?= $BASE_URL . 'paginasPrincipais/errosform.php' ?>">Erros</a>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-center">
            <p class="footerEmail">
                <a href="mailto:programetes.cqtt@gmail.com">programetes.cqtt@gmail.com</a>&copy;
            </p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
