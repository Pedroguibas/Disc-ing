<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
$title = 'Desbanir Usuário';
include_once('../../templates/admHeader-template.php');
?>
<main id="banUserMain">
    <div class="container">
        <section id="banFormSection">
            <div class="d-flex justify-content-center">
                <h1>Desbanir Usuário</h1>
            </div>
            <div class="container mt-5">
                <div id="userSearchBarContainer" class="col-md-4 col-10 mt-2">
                    <label for="userSearchBar">Buscar por username:</label>
                    <input class="form-control" id="userSearchBar" type="search" placeholder="Search" aria-label="Search" value="">
                    <div id="userSearchReturn" class="list-group d-flex flex-column hidden">
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

</main>

<div class="modal fade" id="banUserModal" tabindex="-1" role="dialog" aria-labelledby="ModalBanUser" aria-hidden="true">
    <form id="formBanirUsuario" action="<?= $BASE_URL ?>form/desbanirUsuario.php" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h2>Desbanir Usuário</h3>
                    <button type="button" class="fecharModalBtn" data-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <input id="formBanUsuarioInputUsername" name="username" type="hidden" value="">
                    <input id="formBanUsuarioInputID" name="userID" type="hidden" value="">
                    <p>Tem certeza que deseja desbanir <span id="banirUsuarioUsername"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="fecharModalBtn btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">desbanir</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    let BASE_URL = '<?= $BASE_URL ?>';
    let userID = <?= $_SESSION['usuarioID'] ?>;
</script>
<script src="../../javascript/unbanUserSearch.js"></script>
<?php
include_once('../../templates/footer-template.php');
?>