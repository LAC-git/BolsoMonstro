<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Início</title>
    <style>
        :root {
            --bg: #fdf6e3;
            --bg-forte: #f5efe3;
            --painel: #fffefb;
            --painel-suave: #f8f4ec;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --secundario: #268bd2;
            --secundario-suave: #dfeefb;
            --terciario: #2aa198;
            --terciario-suave: #d9f2ee;
            --texto: #073642;
            --mutado: #586e75;
            --borda: #eee8d5;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #f8f3ea 45%, #f3f0e9 100%);
            color: var(--texto);
            min-height: 100vh;
        }

        .conteudo {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .painelInicial {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid var(--borda);
            border-radius: 24px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 18px 35px rgba(88, 110, 117, 0.08);
        }

        .legenda {
            text-transform: uppercase;
            letter-spacing: 0.18rem;
            font-size: 0.75rem;
            color: var(--secundario);
            margin-bottom: 12px;
            font-weight: 700;
        }

        h1 {
            margin: 0;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            color: var(--texto);
        }

        .subtitulo {
            font-size: 1.05rem;
            color: var(--mutado);
            max-width: 700px;
            margin: 18px auto 0;
            line-height: 1.7;
        }

        .acoes {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 32px;
        }

        .botao {
            display: inline-block;
            padding: 13px 22px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease, opacity 0.2s ease;
            border: 1px solid transparent;
        }

        .botao:hover {
            transform: translateY(-1px);
            opacity: 0.96;
        }

        .primario {
            background: var(--primario-suave);
            color: var(--primario);
            border-color: rgba(217, 119, 6, 0.2);
        }

        .secundario {
            background: var(--secundario-suave);
            color: var(--secundario);
            border-color: rgba(38, 139, 210, 0.15);
        }

        .terciario {
            background: var(--terciario-suave);
            color: var(--terciario);
            border-color: rgba(42, 161, 152, 0.18);
        }

        .cartoes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
            margin-top: 40px;
        }

        .cartao {
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 8px 20px rgba(88, 110, 117, 0.06);
        }

        .cartao h2 {
            margin-top: 0;
            font-size: 1.15rem;
            color: var(--texto);
        }

        .cartao p {
            margin: 0;
            color: var(--mutado);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="conteudo">
        <header class="painelInicial">
            <p class="legenda">Bem-vindo ao mundo</p>
            <h1>BolsoMonstro</h1>
            <p class="subtitulo">
                Monte seu time, evolua seus monstros e enfrente desafios em uma jornada estratégica.
            </p>

            <div class="acoes">
                <a class="botao primario" href="criar-usuario.php">Criar usuário</a>
                <a class="botao secundario" href="login.php">Login</a>
                <a class="botao terciario" href="../jogo/principal.php">Entrar no jogo</a>
            </div>
        </header>

        <section class="cartoes">
            <article class="cartao">
                <h2>Criar perfil</h2>
                <p>Registre seu treinador e inicie sua jornada no mundo dos monstros.</p>
            </article>

            <article class="cartao">
                <h2>Entrar no jogo</h2>
                <p>Faça login para acessar seu progresso, inventário e batalhas.</p>
            </article>

            <article class="cartao">
                <h2>Organizar equipe</h2>
                <p>Escolha seus monstros favoritos e prepare a melhor formação para cada desafio.</p>
            </article>
        </section>
    </div>
</body>
</html>
