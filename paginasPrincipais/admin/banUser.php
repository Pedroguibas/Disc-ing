<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
$title = 'Banir Usuário';
include_once('../../templates/admHeader-template.php');
?>
<main id="banUserMain">
    <div class="container">
        <section id="banFormSection">
            <div class="d-flex justify-content-center">
                <h1>Banir Usuário</h1>
            </div>
            <div class="container mt-5">
                <div id="userSearchBarContainer" class="col-md-4 col-10 mt-2">
                    <label for="userSearchBar">Buscar por username:</label>
                    <input class="form-control" id="userSearchBar" type="search" placeholder="Search" aria-label="Search" value="">
                    <div id="userSearchReturn" class="list-group d-flex flex-column hidden">
                        
                    </div>
                </div>
            </div>
            <form id="formBanirUsuario" action="<?= $BASE_URL ?>form/banirUsuario.php" method="POST" class="d-flex justify-content-center align-items-center mt-5" onsubmit="if(!confirm('Tem certeza que deseja banir este usuário?')){return false;}">
                <input id="formBanUsuarioInputUsername" name="username" type="hidden" value="">
                <input id="formBanUsuarioInputID" name="userID" type="hidden" value="">
                <div id="formBanirUsuarioConfirm" class="d-flex flex-column justify-content-center align-items-center" style="display: none !important;">
                    <h3>Banir <span id="banirUsuarioUsername"></span>?</h3>
                    <button class="btn btn-outline-light mt-3">Banir</button>
                </div>
            </form>
        </section>
    </div>

</main>
<script>
    let BASE_URL = '<?= $BASE_URL ?>';
    let userID = <?= $_SESSION['usuarioID'] ?>;
</script>
<script src="../../javascript/banUserSearch.js"></script>
<?php
include_once('../../templates/footer-template.php');
?>