<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Principal</title>
    <style>
        :root {
            --painel-suave: #f4efe8;
            --primario: #d97706;
            --mutado: #52606d;
            --borda: #e5dcc8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("../imgs/MapaPrincipal.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: var(--texto);
            min-height: 100vh;
        }

        .topbar { background: white; border-bottom: 1px solid #ccc; }
        .topbar-inner { padding: 10px; display: flex; justify-content: space-between; }
        .logo { font-weight: bold; }
        .menu { display: flex; gap: 10px; }
        .menu a { text-decoration: none; }

        .card {
            display: none;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <div class="logo">BolsoMonstro</div>
            <nav class="menu" aria-label="Menu principal do jogo">
                <a href="principal.php">Principal</a>
                <a href="batalha/selecionar-times.php">Batalha</a>
                <a href="team-builder.php">Criar time</a>
                <a href="meus-times.php">Meus times</a>
                <a href="monstros.php">Monstros</a>
                <a href="loja.php">Loja</a>
            </nav>
        </div>
    </header>

    <main class="conteudo">
        <section class="grid" aria-label="Sessões do jogo">
            <a id="batalha" class="card" href="batalha/selecionar-times.php">
                <img src="../imgs/Batalha.png" alt="Batalhe: Escolha os times, analise o confronto e avance para a arena" />
                <h2>Batalha</h2>
                <p>Escolha os times, analise o confronto e avance para a arena.</p>
            </a>

            <a id="criar-time" class="card" href="team-builder.php">
                <h2>Criar time</h2>
                <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
            </a>

            <a id="meus-times" class="card" href="meus-times.php">
                <h2>Meus times</h2>
                <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
            </a>

            <a id="monstros" class="card" href="monstros.php">
                <h2>Monstros</h2>
                <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
            </a>

            <a id="loja" class="card" href="loja.php">
                <h2>Loja</h2>
                <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
            </a>
        </section>
    </main>
</body>
</html>