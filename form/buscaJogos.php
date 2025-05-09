<?php 
include_once("../config/db.php");

$offset = intval($_POST['offset']);

$stmt = $conn->prepare("SELECT
                            J.*,
                            SUM(A.nota) AS nota,
                            COUNT(A.avaliacaoJogoID) AS nAvaliacoes
                        FROM jogo J
                        LEFT JOIN avaliacao A ON A.avaliacaoJogoID = J.jogoID
                        GROUP BY J.jogoID
                        ORDER BY J.jogoNome
                        LIMIT 10
                        OFFSET ".$offset);
$stmt->execute();
$Jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($Jogos);
?>