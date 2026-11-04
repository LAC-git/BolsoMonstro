<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Batalha</title>
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
            --vermelho: #b91c1c;
            --vermelho-suave: #ffe5e5;
            --verde: #0f766e;
            --verde-suave: #d9f4ee;
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

        .arena {
            width: min(960px, 100%);
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 24px;
            box-shadow: 0 18px 35px rgba(88, 110, 117, 0.08);
            overflow: hidden;
        }

        .topo {
            background: linear-gradient(135deg, rgba(249, 231, 201, 0.8), rgba(223, 233, 255, 0.85));
            padding: 24px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid var(--borda);
        }

        .topo h1 {
            margin: 0;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
        }

        .topo a {
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.65);
            border: 1px solid rgba(37,99,235,0.12);
            color: var(--secundario);
            font-weight: 700;
        }

        .conteudo {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 24px 28px 28px;
        }

        .card {
            background: var(--painel-suave);
            border: 1px solid var(--borda);
            border-radius: 20px;
            padding: 20px;
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 1.25rem;
        }

        .status {
            display: grid;
            gap: 10px;
            margin-top: 12px;
        }

        .barra {
            height: 14px;
            border-radius: 999px;
            background: #e7dfd0;
            overflow: hidden;
        }

        .barra > span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, #22c55e, #f59e0b);
            border-radius: inherit;
        }

        .log {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 10px;
            color: var(--mutado);
        }

        .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        button, .link {
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .ataque {
            background: var(--vermelho-suave);
            color: var(--vermelho);
        }

        .defesa {
            background: var(--verde-suave);
            color: var(--verde);
        }

        .link {
            background: var(--primario-suave);
            color: var(--primario);
        }
    </style>
</head>
<body>
    <div class="arena">
        <div class="topo">
            <h1>Batalha</h1>
            <a href="../principal.php">Voltar para principal</a>
        </div>

        <div class="conteudo">
            <section class="card">
                <h2>Time do jogador</h2>
                <strong>Time Solar</strong>
                <div class="status">
                    <div><span>Vida</span></div>
                    <div class="barra"><span style="width: 82%;"></span></div>
                    <div><span>Energia</span></div>
                    <div class="barra"><span style="width: 68%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></span></div>
                </div>
            </section>

            <section class="card">
                <h2>Inimigo</h2>
                <strong>Fera do Deserto</strong>
                <div class="status">
                    <div><span>Vida</span></div>
                    <div class="barra"><span style="width: 74%;"></span></div>
                    <div><span>Energia</span></div>
                    <div class="barra"><span style="width: 61%; background: linear-gradient(90deg, #f97316, #fbbf24);"></span></div>
                </div>
            </section>

            <section class="card" style="grid-column: 1 / -1;">
                <h2>Registro da batalha</h2>
                <ul class="log">
                    <li>⚔️ Time Solar inicia com um ataque rápido.</li>
                    <li>💥 Fera do Deserto contra-ataca com impacto de areia.</li>
                    <li>🛡️ Você usa defesa e reduz o dano.</li>
                    <li>✨ Seu próximo turno pode decidir a vitória.</li>
                </ul>

                <div class="acoes">
                    <button class="ataque" type="button">Atacar</button>
                    <button class="defesa" type="button">Defender</button>
                    <a class="link" href="selecionar-times.php">Trocar times</a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
