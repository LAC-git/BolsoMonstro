<!DOCTYPE html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$saldoMoedas = $_SESSION['saldo_pokedollars']
    ?? $_SESSION['moedas']
    ?? $_SESSION['saldo']
    ?? 0;
$saldoMoedas = max(0, (int) $saldoMoedas);

require_once __DIR__ . '/../../../config/autoload.php';

$loja = new Loja();
$itensLoja = $loja->get_precos();

$detalhesItens = [
    'Potion' => ['emoji' => '🧪', 'nome' => 'Potion', 'descricao' => 'Recupera uma quantidade moderada de HP do monstro.'],
    'SuperPotion' => ['emoji' => '🧪', 'nome' => 'Super Potion', 'descricao' => 'Recupera uma quantidade maior de HP do monstro.'],
    'HyperPotion' => ['emoji' => '🧪', 'nome' => 'Hyper Potion', 'descricao' => 'Recupera uma grande quantidade de HP do monstro.'],
    'MaxPotion' => ['emoji' => '💉', 'nome' => 'Max Potion', 'descricao' => 'Restaura completamente o HP do monstro.'],
    'FullRestore' => ['emoji' => '🌟', 'nome' => 'Full Restore', 'descricao' => 'Restaura todo o HP e cura alterações de status.'],
    'Antidote' => ['emoji' => '🟢', 'nome' => 'Antidote', 'descricao' => 'Cura o status de envenenamento.'],
    'BurnHeal' => ['emoji' => '🔥', 'nome' => 'Burn Heal', 'descricao' => 'Cura o status de queimadura.'],
    'IceHeal' => ['emoji' => '❄️', 'nome' => 'Ice Heal', 'descricao' => 'Cura o status de congelamento.'],
    'Awakening' => ['emoji' => '☀️', 'nome' => 'Awakening', 'descricao' => 'Acorda monstros que estão dormindo.'],
    'ParalyzeHeal' => ['emoji' => '⚡', 'nome' => 'Paralyze Heal', 'descricao' => 'Cura o status de paralisação.'],
    'FullHeal' => ['emoji' => '💖', 'nome' => 'Full Heal', 'descricao' => 'Cura qualquer alteração de status.'],
    'Revive' => ['emoji' => '✨', 'nome' => 'Revive', 'descricao' => 'Revive um monstro desmaiado com parte do HP.'],
];
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Loja</title>
    <style>
        :root {
            --bg: #f7f1e7;
            --painel: #fffdf9;
            --painel-suave: #f4efe7;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --secundario: #2563eb;
            --texto: #1f2937;
            --mutado: #586e75;
            --borda: #e5dcc8;
            --verde: #0f766e;
            --verde-suave: #d9f4ee;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #f7f0e7 50%, #f1efe7 100%);
            color: var(--texto);
            min-height: 100vh;
            padding: 32px 18px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
        }

        .contador-moedas {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 8px 14px;
            border: 1px solid #e4c47d;
            border-radius: 999px;
            background: #fff8dc;
            color: #8a5600;
            font-weight: 800;
            box-shadow: 0 6px 14px rgba(138, 86, 0, 0.08);
        }

        .contador-moedas .icone {
            font-size: 1.15rem;
        }

        .menu a {
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid var(--borda);
            background: var(--painel);
            color: var(--texto);
            font-weight: 700;
            transition: background 180ms ease, border-color 180ms ease, transform 180ms ease, box-shadow 180ms ease;
        }

        .menu a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(31, 41, 55, 0.10);
        }

        .menu .principal {
            background: var(--primario-suave);
            border-color: #edc98f;
            color: #a84f00;
        }

        .menu .inventario {
            background: #eaf1ff;
            border-color: #bdcfee;
            color: #1d4ed8;
        }

        .menu .principal:hover {
            background: #f6ddb8;
        }

        .menu .inventario:hover {
            background: #dde8ff;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .item {
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 22px;
            padding: 22px 20px;
            box-shadow: 0 12px 22px rgba(31, 41, 55, 0.05);
            display: flex;
            flex-direction: column;
            transition: transform 220ms ease, border-color 220ms ease, box-shadow 220ms ease, background 220ms ease;
        }

        .item:hover {
            transform: translateY(-8px);
            border-color: #e0ad62;
            background: #fffefb;
            box-shadow: 0 18px 32px rgba(217, 119, 6, 0.13);
        }

        .item:focus-within {
            border-color: #e0ad62;
            box-shadow: 0 18px 32px rgba(217, 119, 6, 0.13);
        }

        .item p {
            height: 3.2em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .item .preco {
            margin-top: auto;
        }

        .emoji {
            font-size: 2rem;
            margin-bottom: 16px;
            display: inline-block;
            background: var(--painel-suave);
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: grid;
            place-items: center;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 1.3rem;
        }

        p {
            margin: 0 0 18px;
            color: var(--mutado);
            line-height: 1.6;
        }

        .preco {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid var(--borda);
            font-weight: 700;
            color: var(--texto);
        }

        .comprar {
            background: var(--primario-suave);
            color: var(--primario);
            border: none;
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .comprar:hover {
            background: #f6ddb8;
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.12);
        }

        .comprar:disabled {
            cursor: not-allowed;
            opacity: 0.55;
        }

        .saldo {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primario);
            margin-left: 16px;
        }

        .mensagem-compra {
            min-height: 24px;
            margin: 0 0 18px;
            text-align: right;
            color: var(--mutado);
        }

        .mensagem-compra.erro {
            color: #b42318;
        }

        .mensagem-compra.sucesso {
            color: var(--verde);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Loja</h1>
            <div class="header-actions">
                <div class="contador-moedas" id="contador-moedas" data-saldo="<?= (int) $saldoMoedas ?>" aria-label="Saldo atual">
                    <span class="icone" aria-hidden="true">🪙</span>
                    <span id="saldo-moedas"><?= number_format($saldoMoedas, 0, ',', '.') ?> moedas</span>
                </div>
                <nav class="menu" aria-label="Menu da loja">
                    <a class="principal" href="/BolsoMonstro/App/Controllers/PrincipalController.php">Principal</a>
                    <a class="inventario" href="/BolsoMonstro/App/Controllers/LojaController.php?acao=inventario">Inventário</a>
                </nav>
            </div>
        </div>

        <p class="mensagem-compra" id="mensagem-compra" aria-live="polite"></p>

        <section class="grid">
            <?php foreach ($itensLoja as $identificador => $preco): ?>
                <?php $detalhe = $detalhesItens[$identificador]; ?>
                <article class="item">
                    <div class="emoji"><?= htmlspecialchars($detalhe['emoji'], ENT_QUOTES, 'UTF-8') ?></div>
                    <h2><?= htmlspecialchars($detalhe['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($detalhe['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="preco">
                        <span><?= number_format($preco, 0, ',', '.') ?> moedas</span>
                        <button class="comprar" type="button" data-item="<?= htmlspecialchars($identificador, ENT_QUOTES, 'UTF-8') ?>" data-preco="<?= (int) $preco ?>" onclick="verificarCompraNoCliente(this)">Comprar</button>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
    <script>
        function mostrarMensagemCompra(mensagem, tipo = '') {
            const elemento = document.getElementById('mensagem-compra');
            elemento.textContent = mensagem;
            elemento.className = `mensagem-compra ${tipo}`.trim();
        }

        // Verifica no lado do cliente se o saldo exibido é suficiente.
        function verificarCompraNoCliente(botao) {
            const contador = document.getElementById('contador-moedas');
            const saldo = Number(contador?.dataset.saldo || 0);
            const preco = Number(botao.dataset.preco);

            if (!Number.isFinite(preco) || preco <= 0) {
                mostrarMensagemCompra('Preço do item inválido.', 'erro');
                return;
            }

            if (saldo < preco) {
                mostrarMensagemCompra('Saldo insuficiente para comprar este item.', 'erro');
                return;
            }

            tentarEnviarCompraAoBanco(botao.dataset.item, preco);
        }

        // Tenta enviar a compra ao servidor; a validação no banco fica pendente.
        async function tentarEnviarCompraAoBanco(item, preco) {
            try {
                const resposta = await fetch('/BolsoMonstro/App/Controllers/LojaController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json'
                    },
                    body: new URLSearchParams({
                        acao: 'comprar',
                        item: item,
                        quantidade: '1',
                        preco: String(preco)
                    })
                });

                const resultado = await resposta.json();

                if (!resposta.ok) {
                    throw new Error(resultado.mensagem || 'Não foi possível enviar a compra.');
                }

                mostrarMensagemCompra(resultado.mensagem || 'Compra enviada para processamento.', 'sucesso');
            } catch (erro) {
                mostrarMensagemCompra(erro.message, 'erro');
            }
        }
    </script>
</body>
</html>
