<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Meus times</title>
    <style>
        :root {
            --bg: #f4efe7;
            --panel: #ffffff;
            --panel-soft: #f8f4ef;
            --line: #e8e0d1;
            --text: #1f2937;
            --muted: #5f6b76;
            --primary: #c87f1d;
            --primary-soft: #fbf0dc;
            --secondary: #2d5dba;
            --secondary-soft: #ebf1ff;
            --success: #1d7a6b;
            --success-soft: #eafaf5;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 32px 18px;
        }

        .page-shell {
            width: min(980px, 100%);
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav a,
        .button,
        .ghost-button {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .nav a {
            background: var(--panel);
            border: 1px solid var(--line);
            color: var(--text);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .team-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 18px rgba(31, 41, 55, 0.04);
        }

        .team-card h2 {
            margin: 0 0 8px;
            font-size: 1.4rem;
        }

        .tag {
            display: inline-block;
            background: var(--success-soft);
            color: var(--success);
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .empty-state {
            color: var(--muted);
            line-height: 1.7;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .button {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .ghost-button {
            background: var(--secondary-soft);
            color: var(--secondary);
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <div class="topbar">
            <h1>Meus times</h1>
            <nav class="nav" aria-label="Navegação de times">
                <a href="principal.php">Principal</a>
                <a href="team-builder.php">Criar time</a>
                <a href="batalha/selecionar-times.php">Batalha</a>
                <a href="loja.php">Loja</a>
            </nav>
        </div>

        <section class="grid">
            <article class="team-card empty-state">
                <h2>Nenhum time cadastrado</h2>
                <p>Crie seu primeiro time para começar a jornada.</p>
                <div class="actions">
                    <a class="button" href="team-builder.php">Criar time</a>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
