<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Principal</title>
    <style>
        :root {
            --painel-suave: #f4efe8;
            --primario: #d97706;
            --mutado: #52606d;
            --borda: #e5dcc8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("../imgs/MapaPrincipal.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: var(--texto);
            min-height: 100vh;
        }

        .topbar { background: white; border-bottom: 1px solid #ccc; }
        .topbar-inner { padding: 10px; display: flex; justify-content: space-between; }
        .logo { font-weight: bold; }
        .menu { display: flex; gap: 10px; }
        .menu a { text-decoration: none; }

        #conteudo {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .construcao {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .overlay { display: none; }
        .construcao:hover .overlay {
            display: block;    
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
        }

        #arena {
            z-index: 100;
            position: fixed;
            width: 358px;
            height: 358px;
            left: 1303px;
            top: 50px;
        }

        #ginasio {

        }

        #meus-times {

        }

        #zoo {

        }

        #loja {

        }



    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <div class="logo">BolsoMonstro</div>
            <nav class="menu" aria-label="Menu principal do jogo">
                <a href="principal.php">Principal</a>
                <a href="batalha/selecionar-times.php">Batalha</a>
                <a href="team-builder.php">Criar time</a>
                <a href="meus-times.php">Meus times</a>
                <a href="monstros.php">Monstros</a>
                <a href="loja.php">Loja</a>
            </nav>
        </div>
    </header>

    <main id="conteudo">
        <div id="div-arena" class="construcao">
            <a id="arena"  href="batalha/selecionar-times.php">
                <img src="../imgs/Arena.png" alt="Arena" />
                <div class="overlay">
                    <h2>Batalha</h2>
                    <p>Escolha os times, analise o confronto e avance para a arena.</p>
                </div>
            </a>
        </div>

        <div id="div-ginasio" class="construcao">
            <a id="ginasio" href="team-builder.php">
                <img src="../imgs/Ginasio.png" alt="Ginasio" />
                <div class="overlay">
                    <h2>Criar time</h2>
                    <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
                </div>
            </a>
        </div>

        <div id="div-meus-times" class="construcao">
            <a id="meus-times" href="meus-times.php">
                <div class="overlay">
                    <h2>Meus times</h2>
                    <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
                </div>
            </a>
        </div>

        <div id="div-zoo" class="construcao">
            <a id="zoo"  href="monstros.php">
                <img src="../imgs/Zoo.png" alt="Monstros" />
                <div class="overlay">
                    <h2>Monstros</h2>
                    <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
                </div>
            </a>
        </div>

        <div id="div-loja " class="construcao">
            <a id="loja"  href="loja.php">
                <img src="../imgs/Loja.png" alt="Loja" />
                <div class="overlay">
                    <h2>Loja</h2>
                    <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
                </div>
            </a>
        </div>
    </main>
</body>
</html>