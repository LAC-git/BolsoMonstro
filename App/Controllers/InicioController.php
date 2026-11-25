<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'index';

$paginas = [
    'index' => '/../Views/inicio/index.php',
    'login' => '/../Views/inicio/login.php',
    'criar' => '/../Views/inicio/criar-usuario.php',
];

if (!isset($paginas[$acao])) {
    $acao = 'index';
}

require __DIR__ . $paginas[$acao];
