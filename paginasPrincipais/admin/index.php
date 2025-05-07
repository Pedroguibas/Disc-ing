<?php
$title = 'Área Administrativa';
$active = 'adm';
include_once('../../templates/admHeader-template.php');
?>
<main id="admMain">
    <div class="container">
        <div id="areaAdmTitleContainer" class="d-flex justify-content-center"> 
            <h1>Área Administrativa</h1>
        </div>
        <section id="gerenciarJogosLinks" class="mt-5">
            <h2>Gerenciar Jogos</h2>
            <div class="list-group mt-3 col-lg-4 col-md-5 col-sm-6 col-7">
                <a href="formJogo.php" class="list-group-item list-group-item-action">Cadastrar Jogo</a>
                <a href="editarJogo.php" class="list-group-item list-group-item-action">Editar Jogo</a>
                <a href="#" class="list-group-item list-group-item-action">Excluir Jogo</a>
            </div>
        </section>
    </div>
</main>
<?php
include_once('../../templates/footer-template.php');
?>