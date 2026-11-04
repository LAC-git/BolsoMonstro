<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Criar time</title>
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
            width: min(860px, 100%);
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
            font-size: clamp(2rem, 4vw, 2.8rem);
        }

        .nav-link,
        .button,
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
        }

        .nav-link {
            background: var(--secondary-soft);
            color: var(--secondary);
            border: 1px solid #dbe7ff;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 700;
        }

        input,
        select {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--panel-soft);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 1rem;
            color: var(--text);
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
            border: none;
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
            <h1>Criar time</h1>
            <a class="nav-link" href="principal.php">Voltar ao menu</a>
        </div>

        <form action="meus-times.php" method="get">
            <div class="field full">
                <label for="nome-time">Nome do time</label>
                <input id="nome-time" name="nome-time" type="text" placeholder="Digite o nome do time" required>
            </div>

            <div class="field">
                <label for="monstro-1">Monstro principal</label>
                <select id="monstro-1" name="monstro-1">
                    <option value="">Selecione</option>
                    <option>Monstro A</option>
                    <option>Monstro B</option>
                    <option>Monstro C</option>
                    <option>Monstro D</option>
                </select>
            </div>

            <div class="field">
                <label for="monstro-2">Monstro secundário</label>
                <select id="monstro-2" name="monstro-2">
                    <option value="">Selecione</option>
                    <option>Monstro A</option>
                    <option>Monstro B</option>
                    <option>Monstro C</option>
                    <option>Monstro D</option>
                </select>
            </div>

            <div class="field">
                <label for="monstro-3">Monstro de apoio</label>
                <select id="monstro-3" name="monstro-3">
                    <option value="">Selecione</option>
                    <option>Monstro A</option>
                    <option>Monstro B</option>
                    <option>Monstro C</option>
                    <option>Monstro D</option>
                </select>
            </div>

            <div class="field">
                <label for="estilo">Estilo</label>
                <select id="estilo" name="estilo">
                    <option value="">Selecione</option>
                    <option>Estilo A</option>
                    <option>Estilo B</option>
                    <option>Estilo C</option>
                    <option>Estilo D</option>
                </select>
            </div>

            <div class="field full">
                <button class="button" type="submit">Salvar time</button>
            </div>
        </form>

        <div class="actions">
            <a class="secondary-button" href="meus-times.php">Ver meus times</a>
            <a class="secondary-button" href="batalha/selecionar-times.php">Ir para batalha</a>
        </div>
    </main>
</body>
</html>
