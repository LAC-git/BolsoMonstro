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

        /* Canvas proporcional para a imagem recortada em 1535x864 (16:9) */
        .mapa-canvas {
            position: relative;
            flex-shrink: 0;
            width: max(100vw, calc(100svh * (1535 / 864)));
            height: max(100svh, calc(100vw * (864 / 1535)));
        }

        .mapa-bg {
            width: 100%;
            height: 100%;
            display: block;
            user-select: none;
            pointer-events: none;
        }

        /* Estilo base para todas as áreas clicáveis do mapa */
        .hotspot {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            z-index: 10;
            border-radius: 12px;
            /* Borda temporária para visualizar as áreas enquanto posiciona (remova depois) */
            border: 2px dashed rgba(255, 255, 255, 0.5);
        }

        .overlay {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            background-color: rgba(0, 0, 0, 0.82);
            color: #ffffff;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid var(--primario);
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .overlay h2 {
            color: var(--primario);
            font-size: clamp(1rem, 1.3vw, 1.4rem);
            margin-bottom: 6px;
        }

        .overlay p {
            font-size: clamp(0.75rem, 0.9vw, 0.95rem);
            line-height: 1.3;
        }

        /* Mostra o card ao passar o mouse ou tocar */
        .hotspot:hover .overlay,
        .hotspot:focus .overlay {
            opacity: 1;
        }

        /* --- COLE AQUI AS PORCENTAGENS GERADAS NO CONSOLE --- */

        #arena {
            left: 67.86%;
            top: 5.79%;
            width: 18.65%;
            height: 35.00%;
        }

        #ginasio {
            left: 20%;
            top: 25%;
            width: 16%;
            height: 25%;
        }

        #meus-times {
            left: 42%;
            top: 45%;
            width: 16%;
            height: 25%;
        }

        #zoo {
            left: 15%;
            top: 62%;
            width: 16%;
            height: 25%;
        }

        #loja {
            left: 68%;
            top: 60%;
            width: 16%;
            height: 25%;
        }
    </style>
</head>
<body>

    <div class="mapa-viewport">
        <div class="mapa-canvas">
            <img src="../imgs/MapaPrincipal.png" alt="Mapa Principal BolsoMonstro" class="mapa-bg">

            <a id="arena" class="hotspot" href="batalha/selecionar-times.php">
                <div class="overlay">
                    <h2>Batalha</h2>
                    <p>Escolha os times, analise o confronto e avance para a arena.</p>
                </div>
            </a>

            <a id="ginasio" class="hotspot" href="team-builder.php">
                <div class="overlay">
                    <h2>Criar time</h2>
                    <p>Monte a formação ideal com monstros, habilidades e combinações estratégicas.</p>
                </div>
            </a>

            <a id="meus-times" class="hotspot" href="meus-times.php">
                <div class="overlay">
                    <h2>Meus times</h2>
                    <p>Visualize todos os times cadastrados e selecione o melhor para cada desafio.</p>
                </div>
            </a>

            <a id="zoo" class="hotspot" href="monstros.php">
                <div class="overlay">
                    <h2>Monstros</h2>
                    <p>Explore o catálogo completo de monstros, tipos, atributos, golpes e estados.</p>
                </div>
            </a>

            <a id="loja" class="hotspot" href="loja.php">
                <div class="overlay">
                    <h2>Loja</h2>
                    <p>Compre poções, itens e melhorias para preparar sua equipe para a próxima batalha.</p>
                </div>
            </a>
        </div>
    </div>

    <!-- HELPER TEMPORÁRIO: Arraste sobre os prédios para ver as porcentagens no Console (F12). Apague este <script> quando terminar! -->
    <script>
        const canvas = document.querySelector('.mapa-canvas');
        const guide = document.createElement('div');
        Object.assign(guide.style, {
            position: 'absolute',
            border: '2px solid #00ff88',
            background: 'rgba(0, 255, 136, 0.2)',
            pointerEvents: 'none',
            zIndex: '999',
            display: 'none'
        });
        canvas.appendChild(guide);

        let startX, startY, dragging = false;
        const toPct = (val, max) => ((val / max) * 100).toFixed(2);

        canvas.addEventListener('pointerdown', (e) => {
            e.preventDefault();
            const r = canvas.getBoundingClientRect();
            startX = e.clientX - r.left;
            startY = e.clientY - r.top;
            dragging = true;
            guide.style.display = 'block';
        });

        window.addEventListener('pointermove', (e) => {
            if (!dragging) return;
            const r = canvas.getBoundingClientRect();
            const curX = e.clientX - r.left;
            const curY = e.clientY - r.top;
            Object.assign(guide.style, {
                left: `${toPct(Math.min(startX, curX), r.width)}%`,
                top: `${toPct(Math.min(startY, curY), r.height)}%`,
                width: `${toPct(Math.abs(curX - startX), r.width)}%`,
                height: `${toPct(Math.abs(curY - startY), r.height)}%`
            });
        });

        window.addEventListener('pointerup', () => {
            if (!dragging) return;
            dragging = false;
            console.log(`left: ${guide.style.left};\ntop: ${guide.style.top};\nwidth: ${guide.style.width};\nheight: ${guide.style.height};`);
        });

        canvas.addEventListener('click', (e) => e.preventDefault());
    </script>

</body>
</html>
