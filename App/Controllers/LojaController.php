<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'loja';

if ($acao === 'inventario') {
    require __DIR__ . '/../Views/jogo/inventario.php';
    exit;
}

require __DIR__ . '/../Views/jogo/loja.php';