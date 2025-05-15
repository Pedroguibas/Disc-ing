<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Disc-ing</title>
        <style>
            body {
                background: #203170 !important;
                height: 100vh;
            }
            .messageContainer {
                background: #fff;
                border-radius: 10px;
            }
            h1 {
                color: #f00 !important;
            }
        </style>
        <link rel="icon" type="image/x-icon" href="<?= $BASE_URL ?>assets/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="d-flex justify-content-center align-items-center">
        <div class="messageContainer d-flex flex-column align-items-center p-4">
            <h1>Sua conta foi banida!</h1>
            <p class="mt-3">Sua conta foi banida por comportamento que vai contra as diretrizes da plataforma.</p>
            <a href="<?= $BASE_URL ?>form/logout.php" class="logoutBtn btn btn-outline-primary mt-5">
                Log-out
            </a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    </body>
</html>