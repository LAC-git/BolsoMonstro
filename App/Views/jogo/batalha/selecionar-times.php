<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Selecionar times</title>
    <style>
        :root {
            --bg: #f7f1e7;
            --painel: #fffdfb;
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
            background: linear-gradient(135deg, #fdf6e3 0%, #f7f1ea 50%, #f2efe9 100%);
            color: var(--texto);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 32px 18px;
        }

        .container {
            width: min(900px, 100%);
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 24px;
            box-shadow: 0 18px 35px rgba(88, 110, 117, 0.08);
            padding: 32px;
        }

        .cabecalho {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 2.8rem);
        }

        .voltar {
            text-decoration: none;
            color: var(--secundario);
            background: #edf3ff;
            border: 1px solid #dfe9ff;
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 700;
        }

        .selecao {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .box {
            border: 1px solid var(--borda);
            background: var(--painel-suave);
            border-radius: 18px;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 1.3rem;
        }

        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d9d0b5;
            border-radius: 12px;
            background: #fffdf9;
            color: var(--texto);
            font-size: 1rem;
        }

        .lista {
            margin-top: 24px;
            display: grid;
            gap: 10px;
        }

        .item {
            background: var(--painel-suave);
            border: 1px solid var(--borda);
            border-radius: 12px;
            padding: 12px 14px;
            color: var(--mutado);
        }

        .acao {
            margin-top: 26px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .acao a, .acao button {
            display: inline-block;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .acao a {
            background: var(--primario-suave);
            color: var(--primario);
        }

        .acao button {
            background: var(--verde-suave);
            color: var(--verde);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cabecalho">
            <h1>Selecionar times</h1>
            <a class="voltar" href="../principal.php">Voltar ao menu</a>
        </div>

        <div class="selecao">
            <div class="box">
                <h2>Time do jogador</h2>
                <select aria-label="Selecionar time do jogador">
                    <option>Time Solar</option>
                    <option>Time Oceano</option>
                    <option>Time Terra</option>
                </select>
            </div>

            <div class="box">
                <h2>Time adversário</h2>
                <select aria-label="Selecionar time adversário">
                    <option>Fera do Deserto</option>
                    <option>Império de Gelo</option>
                    <option>Clã da Floresta</option>
                </select>
            </div>
        </div>

        <div class="lista">
            <div class="item">Time Solar vs Fera do Deserto</div>
            <div class="item">Time Oceano vs Império de Gelo</div>
            <div class="item">Time Terra vs Clã da Floresta</div>
        </div>

        <div class="acao">
            <a href="batalha.php">Iniciar batalha</a>
            <button type="button" onclick="window.location.href='../meus-times.php'">Ver meus times</button>
        </div>
    </div>
</body>
</html>
