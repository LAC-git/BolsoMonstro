<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'login':
        header('Location: /BolsoMonstro/App/Views/inicio/login.php');
        break;

    case 'criar':
        header('Location: /BolsoMonstro/App/Views/inicio/criar-usuario.php');
        break;

    default:
        header('Location: /BolsoMonstro/App/Views/inicio/index.php');
        break;
}

exit;
