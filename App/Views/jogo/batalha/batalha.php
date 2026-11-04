<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Batalha</title>
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
            --danger: #b42318;
            --danger-soft: #fdeaea;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
        }

        .arena {
            width: min(960px, 100%);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(31, 41, 55, 0.05);
            overflow: hidden;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 24px;
            background: var(--panel-soft);
            border-bottom: 1px solid var(--line);
        }

        h1 {
            margin: 0;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
        }

        .nav-link,
        .button,
        .secondary-button,
        .danger-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .nav-link {
            background: var(--secondary-soft);
            border: 1px solid #dbe7ff;
            color: var(--secondary);
        }

        .battle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
            padding: 22px 24px 24px;
        }

        .card {
            background: var(--panel-soft);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
        }

        .card h2 {
            margin: 0 0 12px;
            font-size: 1.2rem;
        }

        .card strong {
            display: block;
            margin-bottom: 16px;
        }

        .status {
            display: grid;
            gap: 8px;
        }

        .bar {
            height: 12px;
            background: #e7dfd4;
            border-radius: 999px;
            overflow: hidden;
        }

        .bar > span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #3bb273, #f3b11a);
        }

        .card.full {
            grid-column: 1 / -1;
        }

        ul {
            list-style: none;
            margin: 0 0 18px;
            padding: 0;
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
            border: 1px solid #f1ddbb;
            color: var(--primary);
        }

        .secondary-button {
            background: var(--success-soft);
            border: 1px solid #d5efe9;
            color: var(--success);
        }

        .danger-button {
            background: var(--danger-soft);
            border: 1px solid #f7d1cf;
            color: var(--danger);
        }
    </style>
</head>
<body>
    <main class="arena">
        <div class="topbar">
            <h1>Batalha</h1>
            <a class="nav-link" href="../principal.php">Voltar ao menu</a>
        </div>

        <div class="battle-grid">
            <section class="card">
                <h2>Equipe do jogador</h2>
                <strong>Time 1</strong>
                <div class="status">
                    <span>Vida</span>
                    <div class="bar"><span style="width: 80%;"></span></div>
                    <span>Energia</span>
                    <div class="bar"><span style="width: 70%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></span></div>
                </div>
            </section>

            <section class="card">
                <h2>Oponente</h2>
                <strong>Time 2</strong>
                <div class="status">
                    <span>Vida</span>
                    <div class="bar"><span style="width: 65%;"></span></div>
                    <span>Energia</span>
                    <div class="bar"><span style="width: 55%; background: linear-gradient(90deg, #f97316, #fbbf24);"></span></div>
                </div>
            </section>

            <section class="card full">
                <h2>Resumo do turno</h2>
                <ul>
                    <li>Turno 1: o jogador inicia a ação.</li>
                    <li>Turno 2: o oponente responde em seguida.</li>
                    <li>Turno 3: a situação ainda pode mudar.</li>
                </ul>

                <div class="actions">
                    <button class="button" type="button">Atacar</button>
                    <button class="secondary-button" type="button">Defender</button>
                    <a class="danger-button" href="selecionar-times.php">Trocar times</a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
