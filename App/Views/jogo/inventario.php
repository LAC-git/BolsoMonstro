<!DOCTYPE html>
<?php
require_once __DIR__ . '/../../../config/autoload.php';

$loja = new Loja();
$itens = $loja->get_precos();
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Inventário</title>
    <style>
        :root { --painel: #fffdf9; --texto: #1f2937; --mutado: #586e75; --borda: #e5dcc8; --primario: #d97706; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; padding: 32px 18px; font-family: Arial, Helvetica, sans-serif; color: var(--texto); background: linear-gradient(135deg, #fdf6e3 0%, #f7f0e7 50%, #f1efe7 100%); }
        .container { max-width: 1100px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 28px; }
        h1 { margin: 0; font-size: clamp(2rem, 4vw, 3rem); }
        .menu a { text-decoration: none; padding: 10px 14px; border-radius: 999px; border: 1px solid var(--borda); background: var(--painel); color: var(--texto); font-weight: 700; }
        .inventario { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .item { background: var(--painel); border: 1px solid var(--borda); border-radius: 22px; padding: 20px; }
        .item h2 { margin: 0 0 8px; font-size: 1.2rem; }
        .item p { margin: 0; color: var(--mutado); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Inventário</h1>
            <nav class="menu" aria-label="Menu do inventário">
                <a href="LojaController.php">Loja</a>
                <a href="PrincipalController.php">Principal</a>
            </nav>
        </div>

        <section class="inventario">
            <?php foreach ($itens as $nome => $preco): ?>
                <article class="item">
                    <h2><?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?></h2>
                    <p>Quantidade: 0</p>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
</body>
</html>
