<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Selecionar times</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
        }

        .page-shell {
            width: min(920px, 100%);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 12px 28px rgba(31, 41, 55, 0.05);
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
            font-size: clamp(2rem, 4vw, 2.7rem);
        }

        .nav-link,
        .button,
        button,
        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .nav-link {
            background: var(--secondary-soft);
            color: var(--secondary);
            border: 1px solid #dbe7ff;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            font-weight: 700;
            color: var(--text);
        }

        select {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--panel-soft);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 1rem;
            color: var(--text);
        }

        .summary {
            background: var(--panel-soft);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 14px 16px;
            color: var(--muted);
            margin: 18px 0 0;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .button {
            background: var(--primary-soft);
            color: var(--primary);
            border: 1px solid #f1ddbb;
        }

        .secondary-button {
            background: var(--success-soft);
            color: var(--success);
            border: 1px solid #d5efe9;
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <div class="topbar">
            <h1>Selecionar times</h1>
            <a class="nav-link" href="../principal.php">Voltar ao menu</a>
        </div>

        <form action="batalha.php" method="get">
            <div class="form-grid">
                <div class="field">
                    <label for="time-jogador">Seu time</label>
                    <select id="time-jogador" name="time-jogador">
                        <option value="">Selecione</option>
                        <option>Equipe A</option>
                        <option>Equipe B</option>
                        <option>Equipe C</option>
                    </select>
                </div>

                <div class="field">
                    <label for="time-inimigo">Oponente</label>
                    <select id="time-inimigo" name="time-inimigo">
                        <option value="">Selecione</option>
                        <option>Oponente A</option>
                        <option>Oponente B</option>
                        <option>Oponente C</option>
                    </select>
                </div>
            </div>

            <div class="summary">
                Selecione as equipes para continuar para a arena.
            </div>

            <div class="actions">
                <button class="button" type="submit">Iniciar batalha</button>
                <a class="secondary-button" href="../meus-times.php">Meus times</a>
            </div>
        </form>
    </main>
</body>
</html>
