<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Principal</title>
    <style>
        :root {
            --painel-suave: #f4efe8;
            --primario: #b8eff6;
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
            --glow-color: var(--primario); /* Cor padrão caso não seja definida */
            position: absolute;
            text-decoration: none;
            z-index: 10;
            pointer-events: none;  /* Ignora os cantos vazios fora do clip-path */
        }

        .hotspot:hover,
        .hotspot:focus {
            z-index: 30;
        }

        /* Aplica apenas o brilho difuso ao redor do polígono, sem linha dura */
        .glow-wrapper {
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.25s ease;
            filter:
                drop-shadow(0 0 8px var(--glow-color))
                drop-shadow(0 0 18px var(--glow-color))
                drop-shadow(0 0 32px var(--glow-color));
        }

        .hotspot:hover .glow-wrapper,
        .hotspot:focus .glow-wrapper {
            opacity: 1;
        }

        /* Polígono praticamente invisível por dentro (1%) para não tampar a arte do prédio */
        .glow-shape {
            position: absolute;
            inset: 0;
            pointer-events: auto; /* Apenas o polígono recortado recebe hover e clique */
            background-color: color-mix(in srgb, var(--glow-color) 1%, transparent);
        }

        /* Card semitransparente flutuando ACIMA do prédio */
        .overlay {
            position: absolute;
            bottom: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%) translateY(6px);
            z-index: 20;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            background-color: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid color-mix(in srgb, var(--glow-color) 75%, white);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.45);
            width: max-content;
            min-width: 185px;
            max-width: 240px;
            text-align: center;
        }

        .overlay h2 {
            color: var(--glow-color);
            font-size: clamp(0.95rem, 1.25vw, 1.35rem);
            margin-bottom: 4px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.85);
        }

        .overlay p {
            font-size: clamp(0.75rem, 0.85vw, 0.9rem);
            line-height: 1.3;
            color: rgba(255, 255, 255, 0.92);
        }

        /* Mostra o card ao passar o mouse ou tocar */
        .hotspot:hover .overlay,
        .hotspot:focus .overlay {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* #ginasio fica perto do topo, então o card abre abaixo dele */
        #ginasio .overlay {
            bottom: auto;
            top: calc(100% + 10px);
            transform: translateX(-50%) translateY(-6px);
        }

        #ginasio:hover .overlay,
        #ginasio:focus .overlay {
            transform: translateX(-50%) translateY(0);
        }

        /* --- POSIÇÕES E CORES DOS PRÉDIOS --- */

        #arena {
            --glow-color: #ef4444; /* Vermelho (Batalha) */
            left: 62.62%;   top: 21.51%;    width: 20.9%;   height: 26.1%;  }
        #ginasio {
            --glow-color: #f59e0b; /* Dourado (Meus times) */
            left: 29.7%;    top: 12.21%;    width: 17%;     height: 35.05%; }
        #criar-times {
            --glow-color: #3b82f6; /* Azul (Criar times) */
            left: 37.18%;   top: 50.7%;     width: 19.2%;   height: 24.1%;  }
        #zoo {
            --glow-color: #22c55e; /* Verde (Monstros) */
            left: 66.5%;    top: 57.83%;    width: 24.48%;  height: 28.34%; }
        #loja {
            --glow-color: #a855f7; /* Roxo (Loja) */
            left: 15.87%;   top: 41.31%;    width: 10.57%;  height: 17.84%; }

        /* --- CLIP-PATHS DELINEANDO OS LUGARES --- */

        #arena .glow-shape {
            clip-path: polygon(33% 6.38%, 65.72% 6.5%, 73.27% 1.05%, 82.27% 6.82%,
            82.83% 16.14%, 87.07% 16.38%, 94.14% 16.71%, 93.52% 26.26%, 93.38% 36.12%, 
            96.69% 41.44%, 98.07% 57%, 100.23% 63.52%, 100.13% 78.64%, 79.14% 97.3%, 
            65.72% 97.29%, 61.41% 92.86%, 38.48% 92.41%, 36.48% 98.3%, 23.38% 98.18%, 
            2.45% 79.3%, 2.14% 62.44%, 7% 62%, 6.07% 46.26%, 6.83% 27.14%, 6.83% 16.7%, 
            19.79% 16.26%, 19% 5.61%, 28.31% 1.38%);
        }

        #ginasio .glow-shape {
            clip-path: polygon(31.24% 2.07%, 68.91% 1.41%, 77.05% 7.4%, 
                82.81% 8.4%, 86.53% 13.41%, 90.19% 21.05%, 97.05% 21.71%, 
                98.96% 32.37%, 93.67% 32.71%, 94.82% 39.38%, 98.81% 41.34%, 
                99.58% 95.97%, 84.43% 95.64%, 81.96% 99.3%, 67.91% 99.96%, 
                33.71% 99.3%, 20.8% 99.3%, 16.95% 95.99%, 2.71% 96.3%,
                2.71% 47.33%, 4.66% 40.42%, 7.19% 35.4%, 4.33% 31.74%, 
                4.71% 23.05%, 14.09% 22.73%, 14.47% 13.41%, 20.62% 7.41%, 
                24.62% 7.41%);
        }

        #criar-times .glow-shape {
            clip-path: polygon( 38.1% 2%, 63.41% 1.56%, 79.88% 13.63%, 
                82.43% 23.51%, 87.95% 18.44%, 95.19% 23.63%, 94.95% 34.82%, 
                89.48% 38%, 98.57% 44.63%, 99.74% 85.84%, 93.31% 86.38%, 
                89.16% 98.77%, 75.72% 99.01%, 70.49% 92.34%, 67.08% 98.85%, 
                32.86% 98.57%, 31.86% 86.82%, 25.38% 86.38%, 23.69% 90.94%, 
                19% 95.01%, 14.07% 100.01%, 0.38% 99.15%, 2% 83.94%, 
                1.69% 46.19%, 9.24% 40.31%, 4% 30%, 6.62% 20.12%, 
                14.24% 17.88%, 19.55% 25.51%, 22.55% 11.25%)
        }

        #zoo .glow-shape {
            clip-path: polygon(25.73% 15.12%, 31.73% 8.49%, 39.46% 2.75%, 49.46% 0%,
            58.7% 2.75%, 67.43% 8.75%, 72.91% 14.12%, 91.19% 15.61%, 97.94% 64.02%, 
            99.4% 87.61%, 91.61% 92.98%, 72.4% 92.98%, 71.19% 102.98%, 61.15% 103.36%, 
            58.19% 93.37%, 53.46% 98.5%, 45.43% 98.49%, 43.16% 92.24%, 34.91% 99.61%, 
            28.7% 99.73%, 17.94% 99.1%, 10.94% 98.24%, 8.79% 91.98%, 1.27% 87.47%, 
            5.49% 15.61%);;
        }

        #loja .glow-shape {
            clip-path: polygon( 21.27% 2.59%, 82.74% 2.56%,
                99.51% 20.48%, 98.52% 86.6%, 88.97% 96.38%, 
                48.71% 97.29%, 14.28% 96.5%, 5.14% 87.59%, 
                2.45% 47.13%, 2.2% 18.03%);
        }
    </style>
</head>
<body>

    <div class="mapa-viewport">
        <div class="mapa-canvas">
            <img src="../imgs/MapaPrincipal.png" alt="Mapa Principal BolsoMonstro" class="mapa-bg">

            <a id="arena" class="hotspot" href="batalha/selecionar-times.php">
                <div class="glow-wrapper"> <div class="glow-shape"></div> </div>
                <div class="overlay">
                    <h2>Batalha</h2>
                    <p>Escolha os times, analise o confronto e avance para a arena.</p>
                </div>
            </a>

            <a id="ginasio" class="hotspot" href="meus-times.php">
                <div class="glow-wrapper"> <div class="glow-shape"></div> </div>
                <div class="overlay">
                    <h2>Meus times</h2>
                    <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
                </div>
            </a>

            <a id="criar-times" class="hotspot" href="team-builder.php">
                <div class="glow-wrapper"> <div class="glow-shape"></div> </div>
                <div class="overlay">
                    <h2>Criar time</h2>
                    <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
                </div>
            </a>

            <a id="zoo" class="hotspot" href="monstros.php">
                <div class="glow-wrapper"> <div class="glow-shape"></div> </div>
                <div class="overlay">
                    <h2>Monstros</h2>
                    <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
                </div>
            </a>

            <a id="loja" class="hotspot" href="loja.php">
                <div class="glow-wrapper"> <div class="glow-shape"></div> </div>
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
