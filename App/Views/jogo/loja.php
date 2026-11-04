<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Loja</title>
    <style>
        :root {
            --bg: #f7f1e7;
            --painel: #fffdf9;
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
            background: linear-gradient(135deg, #fdf6e3 0%, #f7f0e7 50%, #f1efe7 100%);
            color: var(--texto);
            min-height: 100vh;
            padding: 32px 18px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .menu a {
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
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .item {
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 22px;
            padding: 22px 20px;
            box-shadow: 0 12px 22px rgba(31, 41, 55, 0.05);
        }

        .emoji {
            font-size: 2rem;
            margin-bottom: 16px;
            display: inline-block;
            background: var(--painel-suave);
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: grid;
            place-items: center;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 1.3rem;
        }

        p {
            margin: 0 0 18px;
            color: var(--mutado);
            line-height: 1.6;
        }

        .preco {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid var(--borda);
            font-weight: 700;
            color: var(--texto);
        }

        .comprar {
            background: var(--primario-suave);
            color: var(--primario);
            border: none;
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Loja</h1>
            <nav class="menu" aria-label="Menu da loja">
                <a href="principal.php">Principal</a>
                <a href="team-builder.php">Criar time</a>
                <a href="meus-times.php">Meus times</a>
                <a href="batalha/selecionar-times.php">Batalha</a>
            </nav>
        </div>

        <section class="grid">
            <article class="item">
                <div class="emoji">🧪</div>
                <h2>Poções de Cura</h2>
                <p>Recupere energia e mantenha seus monstros prontos para o combate.</p>
                <div class="preco">
                    <span>45 moedas</span>
                    <button class="comprar" type="button">Comprar</button>
                </div>
            </article>

            <article class="item">
                <div class="emoji">⚡</div>
                <h2>Runas de Ataque</h2>
                <p>Aumenta o dano em batalhas rápidas e intensas.</p>
                <div class="preco">
                    <span>70 moedas</span>
                    <button class="comprar" type="button">Comprar</button>
                </div>
            </article>

            <article class="item">
                <div class="emoji">🛡️</div>
                <h2>Escudo de Ferro</h2>
                <p>Melhora a resistência do time para combates demorados.</p>
                <div class="preco">
                    <span>60 moedas</span>
                    <button class="comprar" type="button">Comprar</button>
                </div>
            </article>

            <article class="item">
                <div class="emoji">🌟</div>
                <h2>Melhoria de Evolução</h2>
                <p>Libera bônus de status e potencial para o próximo nível.</p>
                <div class="preco">
                    <span>120 moedas</span>
                    <button class="comprar" type="button">Comprar</button>
                </div>
            </article>
        </section>
    </div>
</body>
</html>
