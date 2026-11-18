<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Principal</title>
    <style>
        :root {
            --bg: #f7f1e7;
            --bg-escuro: #efe7d8;
            --painel: #fffdf9;
            --painel-suave: #f4efe8;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --secundario: #2563eb;
            --secundario-suave: #dfe9ff;
            --verde: #0f766e;
            --verde-suave: #d9f4ee;
            --texto: #1f2937;
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

        .topbar {
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid var(--borda);
            box-shadow: 0 10px 25px rgba(31, 41, 55, 0.04);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primario);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .menu a, .card {
            text-decoration: none;
            color: var(--texto);
        }

        .menu a {
            background: var(--painel-suave);
            border: 1px solid var(--borda);
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 700;
            color: var(--mutado);
        }

        .conteudo {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 80px;
        }

        .grid {
            margin-top: 36px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .card {
            display: block;
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 22px;
            padding: 26px 22px;
            box-shadow: 0 12px 22px rgba(31, 41, 55, 0.05);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            min-height: 220px;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 28px rgba(31, 41, 55, 0.08);
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primario), var(--secundario), var(--verde));
        }

        .card h2 {
            margin: 0 0 10px;
            font-size: 1.3rem;
            color: var(--texto);
        }

        .card p {
            margin: 0;
            color: var(--mutado);
            line-height: 1.65;
        }

        .card .acao {
            margin-top: 18px;
            display: inline-block;
            padding: 10px 14px;
            border-radius: 999px;
            background: var(--primario-suave);
            color: var(--primario);
            font-weight: 700;
        }

        .card:nth-child(2) .acao {
            background: var(--secundario-suave);
            color: var(--secundario);
        }

        .card:nth-child(3) .acao {
            background: var(--verde-suave);
            color: var(--verde);
        }

        .card:nth-child(4) .acao {
            background: #fef3c7;
            color: #b45309;
        }

        .card:nth-child(5) .acao {
            background: #f3e8ff;
            color: #7c3aed;
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
            <a class="card" href="batalha/selecionar-times.php">
                <h2>Batalha</h2>
                <p>Escolha os times, analise o confronto e avance para a arena.</p>
                <span class="acao">Ir para batalha</span>
            </a>

            <a class="card" href="team-builder.php">
                <h2>Criar time</h2>
                <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
                <span class="acao">Criar time</span>
            </a>

            <a class="card" href="meus-times.php">
                <h2>Meus times</h2>
                <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
                <span class="acao">Ver times</span>
            </a>

            <a class="card" href="monstros.php">
                <h2>Monstros</h2>
                <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
                <span class="acao">Ver monstros</span>
            </a>

            <a class="card" href="loja.php">
                <h2>Loja</h2>
                <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
                <span class="acao">Acessar loja</span>
            </a>
        </section>
    </main>
</body>
</html>