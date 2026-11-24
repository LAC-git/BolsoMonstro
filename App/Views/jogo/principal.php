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

        * {
            all: unset;
            overflow: hidden;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        style { all: revert; }
        title { all: revert; }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("../imgs/MapaPrincipal.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: var(--texto);
            min-height: 100vh;
        }

        .overlay {
            display: flex;
        }

        div:hover .overlay {
            display: block;
            position: relative;
            top: inherit;
            left: inherit;
            right: inherit;
            bottom: inherit;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        body div {
            all: unset;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #arena {
            background-color: rgba(255, 0, 0, 0.7);
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

    <div id="div-arena" >
        <a id="arena" href="batalha/selecionar-times.php">
            <div class="overlay">
                <h2>Batalha</h2>
                <p>Escolha os times, analise o confronto e avance para a arena.</p>
            </div>
        </a>
    </div>

    <div id="div-ginasio" >
        <a id="ginasio" href="team-builder.php">
            <div class="overlay">
                <h2>Criar time</h2>
                <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
            </div>
        </a>
    </div>

    <div id="div-meus-times">
        <a id="meus-times" href="meus-times.php">
            <div class="overlay">
                <h2>Meus times</h2>
                <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
            </div>
        </a>
    </div>

    <div id="div-zoo">
        <a id="zoo" href="monstros.php">
            <div class="overlay">
                <h2>Monstros</h2>
                <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
            </div>
        </a>
    </div>

    <div id="div-loja">
        <a id="loja" href="loja.php">
            <div class="overlay">
                <h2>Loja</h2>
                <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
            </div>
        </a>
    </div>
</body>
</html>