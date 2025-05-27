<?php
session_start();
$active = 'sobre';
if ($_SESSION['usuarioAdm'] == 1)
    include_once("../templates/admHeader-template.php");
else
    include_once("../templates/header-template.php");
?>
<main>
    <div class="container d-flex flex-column align-items-center">
        <div id="sobreTitleContainer" class="col-12 d-flex align-items-center gap-3">
            <div id="sobreBrandContainer" class="col-md-2 col-3"><img src="../assets/LogoDisc-ing.png" alt="Logo Disc-ing" class="w-100"></div>
            <h1 id="sobreTitle">Disc-ing</h1>
        </div>
        <div id="sobreContentContainer" class="col-md-8 col-12 mt-3">
            <p>Disc-ing é um mostruário online de jogos de todos os tipos. É um ambiente onde jogadores de todas as idades e todos os gostos podem interagir e avaliar seus jogos favoritos. Um ambiente seguro com moderadores ativos buscando tornar sua experiência mais agradável!</p>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer-template.php');
?>