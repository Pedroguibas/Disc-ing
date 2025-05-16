<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?php
        if (isset($title))
            echo $title;
        else
            echo 'Disc-ing';
    ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php  
    if (isset($aditionalTags))
        echo $aditionalTags;
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="icon" type="image/x-icon" href="<?= $BASE_URL ?>assets/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body <?php
        if (isset($bodyAttributes))
        echo $bodyAttributes;
        ?>>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="<?= $BASE_URL ?>assets/LogoDisc-ing.png" alt="Logo Disc-ing" class="d-inline-block w-100">
                </a>
            </div>
        </nav>
        <div class="headerShadow"></div>
    </header>