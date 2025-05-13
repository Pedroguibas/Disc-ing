<?php
include_once('../../config/db.php');

$title = 'Excluir Jogo';
$bodyAttributes = 'onload="carregaJogos();"';
include_once('../../templates/admHeader-template.php');

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM jogo;");
$stmt->execute();
$totalJogos = $stmt->fetch(PDO::FETCH_ASSOC);
$totalPaginas = ceil($totalJogos['total'] / 10);
?>
<main>
    <div class="container">
        <section id="sectionListaEditarJogo">
            <h1>Editar Jogos</h1>
                
                <div class="col-md-4 col-10 mt-2">
                    <input class="form-control" id="gameSearchbar" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div id="listaJogo" class="mt-2">
                
                </div>
                <div class="listaJogoPaginationContainer d-flex justify-content-center align-items-center gap-2 col-md-8 col-12 mt-2">
                    <button id="leftPageBtn" class="paginationBtn d-flex align-items-center justify-content-center"><i class="bi bi-arrow-left"></i></button>
                    <div class="listaJogoPaginationInfo"><span id="currentPage">1</span> de <span id="totalPages"><?= $totalPaginas ?></span></div>
                    <button id="rightPageBtn" class="paginationBtn active d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right"></i></button>
                </div>
        </section>
    </div>
</main>
<div class="modal fade" id="excluiJogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="../../form/excluiJogo.php" method="POST">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">Excluir Jogo</h5>
                        <button type="button" class="fecharModalBtn" data-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <input name="id" type="hidden" id="excluirJogoID">
                        <p>Tem certeza que deseja excluir <span id="jogoNomeConfirmacaoExclusao"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="fecharModalBtn btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Excluir</button>
                    </div>
                </div>
            </div>
        </form>
</div>
    

<script>
        let BASE_URL = '<?= $BASE_URL ?>';
        class Pagination {
            static curPage = 1;
            static totalPages = <?= $totalPaginas; ?>;
        }
</script>
<script src="../../javascript/listaDeletarJogo.js"></script>
<?php
include_once('../../templates/footer-template.php');
?>