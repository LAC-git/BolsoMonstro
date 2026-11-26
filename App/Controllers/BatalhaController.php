<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'selecionar';

if ($acao === 'iniciar') {
    require __DIR__ . '/../Views/jogo/batalha/batalha.php';
    exit;
}

require __DIR__ . '/../Views/jogo/batalha/selecionar-times.php';