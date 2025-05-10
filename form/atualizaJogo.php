<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once('../config/db.php');

$requisitos['so'] = htmlspecialchars($_POST['so']);
$requisitos['cpu'] = htmlspecialchars($_POST['cpu']);
$requisitos['gpu'] = htmlspecialchars($_POST['gpu']);
$requisitos['ram'] = htmlspecialchars($_POST['ram']);
$requisitos['armazenamento'] = htmlspecialchars($_POST['armazenamento']);

$jogo['nome'] = htmlspecialchars($_POST['nome']);
$jogo['sinopse'] = htmlspecialchars($_POST['sinopse']);
$jogo['classificacao'] = $_POST['classificacao'];
$plat['switch'] = 0;
$plat['playstation'] = 0;
$plat['xbox'] = 0;
$plat['windowsOS'] = 0;
$plat['macOS'] = 0;
$plat['linuxOS'] = 0;
$plat['androidOS'] = 0;

foreach($_POST['plataforma'] as $plataforma)
    $plat[$plataforma] = 1;

$stmt = $conn->prepare("UPDATE requisitosJogo SET
                            so = :so,
                            cpu = :cpu,
                            gpu = :gpu,
                            ram = :ram,
                            armazenamento = :armazenamento
                        WHERE requisitosJogoID = :reqID");
$stmt->execute([':so' => $requisitos['so'],
                ':cpu' => $requisitos['cpu'],
                ':gpu' => $requisitos['gpu'],
                ':ram' => $requisitos['ram'],
                ':armazenamento' => $requisitos['armazenamento'],
                ':reqID' => $_POST['reqID']]);

$stmt = $conn->prepare("UPDATE jogo SET jogoNome = :nome,
                                classificacao = :classificacao,
                                sinopse = :sinopse,
                                playstation = :playstation,
                                xbox = :xbox,
                                nintendoSwitch = :nintendoSwitch,
                                windowsOS = :windowsOS,
                                macOS = :macOS,
                                linuxOS = :linuxOS,
                                androidOS = :androidOS
                                WHERE jogoID = :jogoID");


$stmt->execute([':nome' => $jogo['nome'],
                ':classificacao' => $jogo['classificacao'],
                ':sinopse' => $jogo['sinopse'],
                ':playstation' => $plat['playstation'],
                ':xbox' => $plat['xbox'],
                ':nintendoSwitch' => $plat['switch'],
                ':windowsOS' => $plat['windowsOS'],
                ':macOS' => $plat['macOS'],
                ':linuxOS' => $plat['linuxOS'],
                ':androidOS' => $plat['androidOS'],
                ':jogoID' => $_POST['jogoID']]);

?>