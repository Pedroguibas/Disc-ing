<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
$bodyAttributes = 'id="gamePageBody"';
include_once('../templates/admHeader-template.php');
?>
    <main id="formJogoMain">
        <form id="formRegistroJogo" action="../form/registraJogo.php" method="POST" enctype="multipart/form-data">
            <div class="registroContentContainer container mt-5">
                <div class="gameInput mt-3">
                    <h1>Nome</h1>
                    <input id="nomeJogoInput" type="text" name="nome" class="textInput col-3" required>
                    <span class="formJogoWarning" id="nomeJaExisteWarning">Já existe um jogo com este nome, confira se o jogo não está cadastrado.</span>
                </div>
                <div class="gameInput mt-3">
                    <h1>Classificação indicativa</h1>

                    <div class="col-3">
                        <select name="classificacao" class="form-select">
                            <option value="livre">Livre</option>
                            <option value="10">10 Anos</option>
                            <option value="12">12 Anos</option>
                            <option value="14">14 Anos</option>
                            <option value="16">16 Anos</option>
                            <option value="18">18 Anos</option>
                        </select>
                    </div>
                </div>
                <div class="gameInput mt-3">
                    <h1>Banner do jogo</h1>
                    <input type="file" name="banner" accept="image/jpeg" required />
                </div>
                <div class="gameInput mt-3">
                    <h1>Capa do jogo</h1>
                    <input type="file" name="cover" accept="image/jpeg" required />
                </div>
                <div class="gameInput mt-3">
                    <h1>Sinopse:</h1>
                    <textarea name="sinopse" id="sinopseTextarea" class="col-12 textInput" required></textarea>
                </div>
                
                <div class="gameInput mt-3">
                    <div>
                        <h1>Requisistos Mínimos:</h1>
                        <h2 class="mt-3">Sistema Operacional: </h2>
                        <input type="text" name="so" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Processador: </h2>
                        <input type="text" name="cpu" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Placa de Vídeo: </h2>
                        <input type="text" name="gpu" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Memória: </h2>
                        <input type="text" name="ram" class="col-3 textInput" required>
                        
                        <h2 class="mt-3">Armazenamento: </h2>
                        <input type="text" name="armazenamento" class="col-3 textInput" required>
                        

                    </div>
                </div>
                <h1 class="tituloPlat m-2">Plataformas</h1>
                <div class="gameInput mt-3 mb-5">
                    <div class="d-flex justify-content-around align-items-center">
                        <input class="platCheckInput" id="plat1" type="checkbox" name="plataforma[]" value="switch">
                        <label class="plataformaCheck" for="plat1"><i class="bi bi-nintendo-switch"></i></label>

                        <input class="platCheckInput" id="plat2" type="checkbox" name="plataforma[]" value="playstation">
                        <label class="plataformaCheck" for="plat2"><i class="bi bi-playstation"></i></label>

                        <input class="platCheckInput" id="plat3" type="checkbox" name="plataforma[]" value="xbox">
                        <label class="plataformaCheck" for="plat3"><i class="bi bi-xbox"></i></label>

                        <input class="platCheckInput" id="plat4" type="checkbox" name="plataforma[]" value="pc">
                        <label class="plataformaCheck" for="plat4"><i class="bi bi-pc-display"></i></label>
                    </div>
                    <span class="formJogoWarning" id="nenhumaPlataformaWarning">Selecione ao menos uma plataforma.</span>
                </div>
            </div>

                <div class="d-flex justify-content-center mt-3">
                    <input type="submit">
                </div>
        </form>
    </main>
    <script>let BASE_URL = '<?= $BASE_URL ?>'</script>
    <script src="../javascript/formJogo.js"></script>
<?php
include_once('../templates/footer-template.php');
?>