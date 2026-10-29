<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Início</title>
    <style>
        :root {
            --bg: #0f172a;
            --panel: #111827;
            --panel-soft: #1f2937;
            --primary: #f59e0b;
            --secondary: #38bdf8;
            --text: #e5e7eb;
            --muted: #cbd5e1;
            --accent: #22c55e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #020817, #111827 50%, #0f172a);
            color: var(--text);
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .hero {
            background: rgba(17, 24, 39, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 24px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.4);
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.2rem;
            font-size: 0.75rem;
            color: var(--secondary);
            margin-bottom: 12px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--muted);
            max-width: 700px;
            margin: 18px auto 0;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 32px;
        }

        .btn {
            display: inline-block;
            padding: 14px 24px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .primary {
            background: var(--primary);
            color: #111827;
        }

        .secondary {
            background: var(--secondary);
            color: #082f49;
        }

        .tertiary {
            background: var(--accent);
            color: #052e16;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
            margin-top: 40px;
        }

        .card {
            background: rgba(31, 41, 55, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 18px;
            padding: 24px;
        }

        .card h2 {
            margin-top: 0;
            font-size: 1.2rem;
        }

        .card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="hero">
            <p class="eyebrow">Bem-vindo ao mundo</p>
            <h1>BolsoMonstro</h1>
            <p class="subtitle">
                Monte seu time, evolua seus monstros e enfrente desafios em uma jornada estratégica.
            </p>

            <div class="actions">
                <a class="btn primary" href="criar-usuario.php">Criar usuário</a>
                <a class="btn secondary" href="login.php">Login</a>
                <a class="btn tertiary" href="../jogo/team-builder.php">Team Builder</a>
            </div>
        </header>

        <section class="cards">
            <article class="card">
                <h2>Criar perfil</h2>
                <p>Registre seu treinador e inicie sua jornada no mundo dos monstros.</p>
            </article>

            <article class="card">
                <h2>Entrar no jogo</h2>
                <p>Faça login para acessar seu progresso, inventário e batalhas.</p>
            </article>

            <article class="card">
                <h2>Montar time</h2>
                <p>Escolha seus monstros favoritos e prepare a melhor formação para cada desafio.</p>
            </article>
        </section>
    </div>
</body>
</html>
