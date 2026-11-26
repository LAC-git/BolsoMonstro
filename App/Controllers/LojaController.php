<?php

require_once __DIR__ . '/../../config/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function responderJson(array $dados, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

function processarCompra(): void {
    $item = trim((string) ($_POST['item'] ?? ''));
    $quantidade = (int) ($_POST['quantidade'] ?? 0);
    $preco = (int) ($_POST['preco'] ?? 0);

    // TODO: validar o item, a quantidade e o preço no banco de dados.
    // TODO: consultar o saldo real do jogador e verificar se existe saldo suficiente.
    // TODO: descontar o saldo e adicionar o item ao inventário em uma transação.

    responderJson([
        'status' => 'pendente',
        'mensagem' => 'Compra enviada para processamento.',
        'item' => $item,
        'quantidade' => $quantidade,
        'preco' => $preco,
    ]);
}

function consultarSaldo(): void {
    // TODO: consultar o saldo real do jogador no banco usando o identificador da sessão.
    $saldo = $_SESSION['saldo_pokedollars']
        ?? $_SESSION['moedas']
        ?? $_SESSION['saldo']
        ?? 0;

    responderJson([
        'saldo' => max(0, (int) $saldo),
    ]);
}

function mostrarInventario(): void {
    header('Location: /BolsoMonstro/App/Views/jogo/inventario.php');
    exit;
}

function mostrarLoja(): void {
    header('Location: /BolsoMonstro/App/Views/jogo/loja.php');
    exit;
}

$acao = $_GET['acao'] ?? 'loja';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? null) === 'comprar') {
    processarCompra();
}

switch ($acao) {
    case 'inventario':
        mostrarInventario();
        break;

    case 'saldo':
        consultarSaldo();
        break;

    default:
        mostrarLoja();
        break;
}