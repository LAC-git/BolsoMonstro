<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Criar time</title>
    <style>
        :root {
            --bg: #f8f2e8;
            --painel: #fffdfb;
            --painel-suave: #f4efe7;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --secundario: #2563eb;
            --texto: #1f2937;
            --mutado: #586e75;
            --borda: #e6dcc7;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #f8f3ea 50%, #f2efe9 100%);
            color: var(--texto);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 32px 18px;
        }

        .cartao {
            width: min(800px, 100%);
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 24px;
            box-shadow: 0 18px 35px rgba(88, 110, 117, 0.08);
            padding: 32px;
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
            font-size: clamp(1.9rem, 3vw, 2.7rem);
        }

        .voltar {
            text-decoration: none;
            color: var(--secundario);
            font-weight: 700;
            background: #edf3ff;
            border: 1px solid #dfe9ff;
            border-radius: 999px;
            padding: 10px 14px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .campo {
            display: grid;
            gap: 8px;
        }

        .campo.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 700;
            color: var(--texto);
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #d9d0b5;
            background: #f9f6f1;
            color: var(--texto);
            font-size: 1rem;
        }

        button {
            margin-top: 8px;
            border: none;
            border-radius: 12px;
            background: var(--primario-suave);
            color: var(--primario);
            padding: 14px 18px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
        }

        .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .acoes a {
            display: inline-block;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--borda);
            background: var(--painel-suave);
            color: var(--texto);
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="cartao">
        <div class="cabecalho">
            <h1>Criar time</h1>
            <a class="voltar" href="principal.php">Voltar ao menu</a>
        </div>

        <form action="meus-times.php" method="get">
            <div class="campo full">
                <label for="nome-time">Nome do time</label>
                <input id="nome-time" type="text" name="nome-time" placeholder="Ex.: Time Solar" required>
            </div>

            <div class="campo">
                <label for="monstro-1">Monstro 1</label>
                <select id="monstro-1" name="monstro-1">
                    <option>Fogo</option>
                    <option>Água</option>
                    <option>Terra</option>
                    <option>Raio</option>
                </select>
            </div>

            <div class="campo">
                <label for="monstro-2">Monstro 2</label>
                <select id="monstro-2" name="monstro-2">
                    <option>Falcão de Pedra</option>
                    <option>Lagarto da Mata</option>
                    <option>Golem Sombrio</option>
                    <option>Dragão do Vento</option>
                </select>
            </div>

            <div class="campo">
                <label for="monstro-3">Monstro 3</label>
                <select id="monstro-3" name="monstro-3">
                    <option>Rinoceronte Solar</option>
                    <option>Serpente Lunar</option>
                    <option>Fera de Neve</option>
                    <option>Coruja de Fogo</option>
                </select>
            </div>

            <div class="campo">
                <label for="estilo">Estilo de batalha</label>
                <select id="estilo" name="estilo">
                    <option>Ofensivo</option>
                    <option>Defensivo</option>
                    <option>Equilibrado</option>
                    <option>Controle</option>
                </select>
            </div>

            <div class="campo full">
                <button type="submit">Salvar time</button>
            </div>
        </form>

        <div class="acoes">
            <a href="meus-times.php">Ver meus times</a>
            <a href="batalha/selecionar-times.php">Ir para batalha</a>
        </div>
    </div>
</body>
</html>
