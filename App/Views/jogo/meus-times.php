<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Meus times</title>
    <style>
        :root {
            --bg: #f7f1e7;
            --painel: #fffdf9;
            --painel-suave: #f5efe7;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --verde: #0f766e;
            --verde-suave: #d9f4ee;
            --texto: #1f2937;
            --mutado: #586e75;
            --borda: #e8dcc8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #f7f1ea 50%, #f2efe8 100%);
            color: var(--texto);
            min-height: 100vh;
            padding: 32px 18px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .cabecalho {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .navegacao {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .navegacao a {
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid var(--borda);
            background: var(--painel);
            color: var(--texto);
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .time {
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 12px 22px rgba(31, 41, 55, 0.05);
        }

        .time h2 {
            margin: 0 0 8px;
            font-size: 1.4rem;
        }

        .tipo {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            background: var(--verde-suave);
            color: var(--verde);
            margin-bottom: 12px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0 0 18px;
            color: var(--mutado);
            line-height: 1.8;
        }

        .acoes {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .acoes a, .acoes button {
            text-decoration: none;
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .acoes a {
            background: var(--primario-suave);
            color: var(--primario);
        }

        .acoes button {
            background: var(--verde-suave);
            color: var(--verde);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cabecalho">
            <h1>Meus times</h1>
            <div class="navegacao">
                <a href="principal.php">Principal</a>
                <a href="team-builder.php">Criar time</a>
                <a href="batalha/selecionar-times.php">Batalha</a>
                <a href="loja.php">Loja</a>
            </div>
        </div>

        <div class="grid">
            <article class="time">
                <h2>Time Solar</h2>
                <span class="tipo">Ofensivo</span>
                <ul>
                    <li>Falcão de Pedra</li>
                    <li>Rinoceronte Solar</li>
                    <li>Dragão do Vento</li>
                </ul>
                <div class="acoes">
                    <a href="batalha/selecionar-times.php">Usar em batalha</a>
                    <button type="button">Detalhes</button>
                </div>
            </article>

            <article class="time">
                <h2>Time Oceano</h2>
                <span class="tipo">Defensivo</span>
                <ul>
                    <li>Lagarto da Mata</li>
                    <li>Serpente Lunar</li>
                    <li>Coruja de Fogo</li>
                </ul>
                <div class="acoes">
                    <a href="batalha/selecionar-times.php">Usar em batalha</a>
                    <button type="button">Detalhes</button>
                </div>
            </article>

            <article class="time">
                <h2>Time Terra</h2>
                <span class="tipo">Equilibrado</span>
                <ul>
                    <li>Golem Sombrio</li>
                    <li>Fera de Neve</li>
                    <li>Águia do Vale</li>
                </ul>
                <div class="acoes">
                    <a href="batalha/selecionar-times.php">Usar em batalha</a>
                    <button type="button">Detalhes</button>
                </div>
            </article>
        </div>
    </div>
</body>
</html>
