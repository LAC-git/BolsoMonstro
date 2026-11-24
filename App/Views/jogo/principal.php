<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Principal</title>
    <style>
        :root {
            --painel-suave: #f4efe8;
            --primario: #9aeaf5;
            --mutado: #52606d;
            --borda: #e5dcc8;
            --texto: #1f2933;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100svh; /* Trava na altura útil sem pular com a barra do navegador */
            overflow: hidden;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #000;
        }

        /* Janela em tela cheia que centraliza o mapa */
        .mapa-viewport {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Canvas proporcional para a imagem do mapa */
        .mapa-canvas {
            position: relative;
            flex-shrink: 0;
        }

        .mapa-bg {
            width: 100%;
            height: 100%;
            display: block;
            user-select: none;
            pointer-events: none;
        }

        /* Wrapper pai sem clip-path para o drop-shadow brilhar por fora das bordas */
        .hotspot {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            z-index: 10;
            pointer-events: none; /* Ignora os cantos vazios fora do clip-path */
            transition: filter 0.25s ease;

            &:hover,
            &:focus {
                filter:
                    drop-shadow(0 8px 6px #f8f8f8)
                    drop-shadow(0 4px 16px var(--primario));
            }
        }

        /* Camada recortada com o contorno do prédio */
        .glow-shape {
            position: absolute;
            inset: 0;
            pointer-events: auto; /* Apenas o polígono recortado recebe hover e clique */
            background-color: rgba(217, 119, 6, 0.01);
            transition: background-color 0.25s ease;
        }

        .hotspot:hover .glow-shape,
        .hotspot:focus .glow-shape {
            background-color: rgba(255, 255, 255, 0);
        }

        /* Card de informações que aparece no hover */
        .overlay {
            position: relative;
            z-index: 2;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            transform: translateY(6px);
            background-color: rgba(0, 0, 0, 0.85);
            color: #ffffff;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid var(--primario);
            width: 92%;
            text-align: center;
        
            h2 {
                color: var(--primario);
                font-size: clamp(0.95rem, 1.25vw, 1.35rem);
                margin-bottom: 4px;
            }
            
            p {
                font-size: clamp(0.72rem, 0.85vw, 0.9rem);
                line-height: 1.3;
            }
        }

        /* Mostra o card ao passar o mouse ou tocar */
        .hotspot:hover .overlay,
        .hotspot:focus .overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- POSIÇÕES DOS PRÉDIOS --- */

        #arena {
            left: 62.62%;
            top: 21.51%;
            width: 20.9%;
            height: 26.1%;
        }

        #ginasio {
            left: 29.7%;
            top: 12.21%;
            width: 17%;
            height: 35.05%;
        }

        #meus-times {
            left: 37.18%;
            top: 50.7%;
            width: 19.2%;
            height: 24.1%;
        }

        #zoo {
            left: 66.5%;
            top: 57.83%;
            width: 24.48%;
            height: 28.34%;
        }

        #loja {
            left: 15.87%;
            top: 41.31%;
            width: 10.57%;
            height: 17.84%;
        }

        /* --- CLIP-PATHS DELINEANDO OS LUGARES --- */

        #arena .glow-shape {
            /* clip-path: polygon(...); */
        }

        #ginasio .glow-shape {
            /* clip-path: polygon(...); */
        }

        #meus-times .glow-shape {
            /* clip-path: polygon(...); */
        }

        #zoo .glow-shape {
            /* clip-path: polygon(...); */
        }

        #loja .glow-shape {
            /* clip-path: polygon(...); */
        }
    </style>
</head>
<body>

    <div class="mapa-viewport">
        <div class="mapa-canvas">
            <img src="../imgs/MapaPrincipal.png" alt="Mapa Principal BolsoMonstro" class="mapa-bg">

            <a id="arena" class="hotspot" href="batalha/selecionar-times.php">
                <div class="glow-shape"></div>
                <div class="overlay">
                    <h2>Batalha</h2>
                    <p>Escolha os times, analise o confronto e avance para a arena.</p>
                </div>
            </a>

            <a id="ginasio" class="hotspot" href="team-builder.php">
                <div class="glow-shape"></div>
                <div class="overlay">
                    <h2>Criar time</h2>
                    <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
                </div>
            </a>

            <a id="meus-times" class="hotspot" href="meus-times.php">
                <div class="glow-shape"></div>
                <div class="overlay">
                    <h2>Meus times</h2>
                    <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
                </div>
            </a>

            <a id="zoo" class="hotspot" href="monstros.php">
                <div class="glow-shape"></div>
                <div class="overlay">
                    <h2>Monstros</h2>
                    <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
                </div>
            </a>

            <a id="loja" class="hotspot" href="loja.php">
                <div class="glow-shape"></div>
                <div class="overlay">
                    <h2>Loja</h2>
                    <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
                </div>
            </a>
        </div>
    </div>

    <script>
        // Mantém a proporção real da imagem sem esticar
        (() => {
            const canvas = document.querySelector('.mapa-canvas');
            const bgImg = document.querySelector('.mapa-bg');

            function syncCanvasSize() {
                if (!bgImg.naturalWidth) return; // A imagem ainda não carregou, então não podemos calcular a proporção

                const imgRatio = bgImg.naturalWidth / bgImg.naturalHeight;
                const winW = window.innerWidth;
                const winH = window.innerHeight;
                const winRatio = winW / winH;

                // Se a janela for mais larga que a imagem, ajustamos a largura da imagem para a largura da janela e calculamos a altura proporcional.
                // Caso contrário, ajustamos a altura da imagem para a altura da janela e calculamos a largura proporcional.
                if (winRatio > imgRatio) {
                    canvas.style.width = `${winW}px`; 
                    canvas.style.height = `${winW / imgRatio}px`; 
                } else {
                    canvas.style.height = `${winH}px`; 
                    canvas.style.width = `${winH * imgRatio}px`; 
                }
            }

            bgImg.addEventListener('load', syncCanvasSize);
            window.addEventListener('resize', syncCanvasSize);
            syncCanvasSize();
        })();
    </script>

</body>
</html>
