<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

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
$plat['pc'] = 0;

foreach($_POST['plataforma'] as $plataforma)
    $plat[$plataforma] = 1;


$stmt = $conn->prepare("INSERT INTO requisitosJogo (so, cpu, gpu, ram, armazenamento) VALUES (:so, :cpu, :gpu, :ram, :armazenamento)");
$stmt->execute([':so' => $requisitos['so'],
                ':cpu' => $requisitos['cpu'],
                ':gpu' => $requisitos['gpu'],
                ':ram' => $requisitos['ram'],
                ':armazenamento' => $requisitos['armazenamento']]);

$stmt = $conn->prepare("SELECT id FROM requisitosJogo ORDER BY id DESC LIMIT 1");
$stmt->execute();
$reqID = $stmt->fetch();

$stmt = $conn->prepare("INSERT INTO jogo (nome, classificacao, sinopse, requisitosID, playstation, xbox, nintendoSwitch, pc) VALUES (:nome, :classificacao, :sinopse, :requisitosID, :playstation, :xbox, :nintendoSwitch, :pc)");
$stmt->execute([':nome' => $jogo['nome'],
                ':classificacao' => $jogo['classificacao'],
                ':sinopse' => $jogo['sinopse'],
                ':requisitosID' => $reqID['id'],
                ':playstation' => $plat['playstation'],
                ':xbox' => $plat['xbox'],
                ':nintendoSwitch' => $plat['switch'],
                ':pc' => $plat['pc']]);

$stmt = $conn->prepare("SELECT id FROM jogo ORDER BY id DESC LIMIT 1");
$stmt->execute();
$gameID = $stmt->fetch(); //Pega id do jogo que acabou de ser registrado no banco para usar nos nomes das imagens
$gameID = $gameID['id'];

$diretorio = '../assets/Jogos/';
$banner = $diretorio . basename($_FILES['banner']['name']);
move_uploaded_file($_FILES['banner']['tmp_name'], $banner);
rename($banner, $diretorio . 'banner' . $gameID . '.jpg');

$cover = $diretorio . basename($_FILES['cover']['name']);
move_uploaded_file($_FILES['cover']['tmp_name'], $cover);
rename($cover, $diretorio . 'cover' . $gameID . '.jpg');



?>