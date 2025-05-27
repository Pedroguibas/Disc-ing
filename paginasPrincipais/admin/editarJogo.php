<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../../config/db.php");
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
    <section id="formUpdateJogo" style="display: none" class="mt-5">
        <form id="formRegistroJogo" action="../../form/atualizaJogo.php" method="POST" enctype="multipart/form-data">
            <input id="inputJogoID" type="hidden" name="jogoID">
            <input type="hidden" id="inputReqID" name="reqID">
            <div class="registroContentContainer container mt-3">
                <div id="formRegistroJogoTitleContainer" class="d-flex justify-content-center mb-5">
                    <h1>Cadastro de jogo</h1>
                </div>
                <h2>Informações Gerais</h2>
                <div class="formRegistroJogoSection d-flex flex-wrap">
                    <div class="gameInput formInputLeft d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="nomeJogoInput">Nome do jogo:</label>
                        <input id="nomeJogoInput" type="text" name="nome" class="textInput" required>
                        <span class="formJogoWarning" id="nomeJaExisteWarning">Já existe um jogo com este nome.</span>
                    </div>
                    <div class="gameInput mt-3">
                        <label for="selectClassificacaoIndicativa">Classificação indicativa:</label>

                        <div>
                            <select id="selectClassificacaoIndicativa" name="classificacao" class="form-select">
                                <option value="livre">Livre</option>
                                <option value="10">10 Anos</option>
                                <option value="12">12 Anos</option>
                                <option value="14">14 Anos</option>
                                <option value="16">16 Anos</option>
                                <option value="18">18 Anos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="formRegistroJogoSection d-flex flex-wrap">
                    <div class="gameInput formInputLeft mt-3">
                        <label for="gameBannerInput">Banner do jogo:</label>
                        <div id="coverPreviewContainer" class="col-lg-6 col-md-8 col-10">
                            <img src="" alt="" id="bannerPreview" class="formJogoImgPreview w-100">
                        </div>
                        <div class="imageInputEditarJogo" style="display: none;">
                            <input class="formJogoImgInput form-control form-control-sm col-md-4 mt-2" id="gameBannerInput" type="file" name="banner" accept="image/jpeg" />
                        </div>
                        <button type="button" class="mostrarInputEditarJogoBtn btn btn-outline-light mt-2">alterar</button>
                    </div>
                    <div class="gameInput mt-3">
                        <label for="gameCoverInput">Capa do jogo:</label>
                        <div id="coverPreviewContainer" class="col-lg-3 col-md-6 col-8">
                            <img src="" alt="" id="coverPreview" class="formJogoImgPreview w-100">
                        </div>
                        <div class="imageInputEditarJogo" style="display: none;">
                            <input class="formJogoImgInput form-control form-control-sm mt-2" id="gameCoverInput" type="file" name="cover" accept="image/jpeg" />
                        </div>
                        <button type="button" class="mostrarInputEditarJogoBtn btn btn-outline-light mt-2">alterar</button>
                    </div>
                </div>
                <div class="gameInput mt-3">
                    <label for="sinopseTextarea">Sinopse:</label>
                    <textarea name="sinopse" id="sinopseTextarea" class="col-12 textInput" required></textarea>
                </div>
                
                <h2 class="mt-5">Requisistos Mínimos</h2>
                <div class="formRegistroJogoSection d-flex flex-wrap">
                    <div class="gameInput formInputLeft d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="soInput">Sistema Operacional: </label>
                        <input id="soInput" type="text" name="so" class="textInput" required>
                    </div>
                    <div class="gameInput mt-3 d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="cpuInput">Processador: </label>
                        <input id="cpuInput" type="text" name="cpu" class="textInput" required>
                    </div>
                </div>
                <div class="formRegistroJogoSection d-flex flex-wrap">
                    <div class="gameInput formInputLeft mt-3 d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="gpuInput">Placa de Vídeo: </label>
                        <input id="gpuInput" type="text" name="gpu" class="textInput" required>
                    </div>
                    <div class="gameInput mt-3 d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                        <label for="ramInput">Memória: </label>
                        <input id="ramInput" type="text" name="ram" class="textInput" required>
                    </div>
                </div>
                <div class="gameInput mt-3 d-flex flex-column mt-3 col-lg-3 col-md-4 col-8">
                    <label for="armazenamentoInput">Armazenamento: </label>
                    <input id="armazenamentoInput" type="text" name="armazenamento" class="textInput" required>
                </div>
                <h2 class="tituloPlat mt-5">Plataformas</h2>
                <div class="gameInput mt-3 mb-5">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <input class="platCheckInput" id="plat1" type="checkbox" name="plataforma[]" value="switch">
                        <label class="plataformaCheck" for="plat1"><i class="bi bi-nintendo-switch"></i></label>

                        <input class="platCheckInput" id="plat2" type="checkbox" name="plataforma[]" value="playstation">
                        <label class="plataformaCheck" for="plat2"><i class="bi bi-playstation"></i></label>

                        <input class="platCheckInput" id="plat3" type="checkbox" name="plataforma[]" value="xbox">
                        <label class="plataformaCheck" for="plat3"><i class="bi bi-xbox"></i></label>

                        <input class="platCheckInput" id="plat4" type="checkbox" name="plataforma[]" value="windowsOS">
                        <label class="plataformaCheck" for="plat4"><i class="bi bi-microsoft"></i></label>

                        <input class="platCheckInput" id="plat5" type="checkbox" name="plataforma[]" value="linuxOS">
                        <label class="plataformaCheck" for="plat5"><i class="bi bi-ubuntu"></i></label>

                        <input class="platCheckInput" id="plat6" type="checkbox" name="plataforma[]" value="macOS">
                        <label class="plataformaCheck" for="plat6"><i class="bi bi-apple"></i></label>

                        <input class="platCheckInput" id="plat7" type="checkbox" name="plataforma[]" value="androidOS">
                        <label class="plataformaCheck" for="plat7"><i class="bi bi-android2"></i></label>

                    </div>
                    <span class="formJogoWarning" id="nenhumaPlataformaWarning">Selecione ao menos uma plataforma.</span>
                </div>
            </div>

                <div class="d-flex justify-content-center mt-3">
                    <button id="enviaFormJogoBtn" type="submit">Salvar</button>
                </div>
        </form>
    </section>
    </div>
    
</main>
<script>
        let BASE_URL = '<?= $BASE_URL ?>';
        class Pagination {
            static curPage = 1;
            static totalPages = <?= $totalPaginas; ?>;
        }
</script>
<script src="<?= $BASE_URL ?>javascript/editarJogo.js"></script>

<?php
include_once('../../templates/footer-template.php');
?>