<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'selecionar';

if ($acao === 'iniciar') {
    header('Location: /BolsoMonstro/App/Views/jogo/batalha/batalha.php');
    exit;
}

header('Location: /BolsoMonstro/App/Views/jogo/batalha/selecionar-times.php');
exit;