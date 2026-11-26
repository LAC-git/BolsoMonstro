<?php

require_once __DIR__ . '/../../config/autoload.php';

$acao = $_GET['acao'] ?? 'loja';

if ($acao === 'inventario') {
    require __DIR__ . '/../Views/jogo/inventario.php';
    exit;
}

$acaoPost = $_POST['acao'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $acaoPost === 'comprar') {
    header('Content-Type: application/json; charset=utf-8');

    $item = trim((string) ($_POST['item'] ?? ''));
    $quantidade = (int) ($_POST['quantidade'] ?? 0);
    $preco = (int) ($_POST['preco'] ?? 0);

    // TODO: implementar a verificação no banco de dados e descontar o item e o saldo do jogador.

    echo json_encode([
        'status' => 'pendente',
        'mensagem' => 'Compra enviada para processamento.',
        'item' => $item,
        'quantidade' => $quantidade,
        'preco' => $preco,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

require __DIR__ . '/../Views/jogo/loja.php';