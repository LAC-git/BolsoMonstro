<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Batalha</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #172c25;
            font-family: Arial, sans-serif;
        }

        .arena {
            position: relative;
            width: min(100%, 1100px);
            aspect-ratio: 3 / 2;
            overflow: hidden;
            background: #244b35;
        }

        .cenario {
            width: 100%;
            height: 100%;
            display: block;
            image-rendering: pixelated;
        }

        /* Área das mensagens */
        .mensagem {
            position: absolute;
            left: 5.5%;
            top: 81%;
            width: 51%;
            height: 10%;
            display: flex;
            align-items: center;
            padding: 1%;
            color: #172b48;
            font-size: clamp(10px, 1.6vw, 19px);
            font-weight: bold;
            overflow: hidden;
        }

        /* Botões invisíveis sobre a imagem */
        .area-botao {
            position: absolute;
            display: block;
            border: none;
            background: transparent;
            cursor: pointer;
            border-radius: 12px;
            transition: background 0.2s, outline 0.2s;
        }
        .area-botao:hover {
            background: rgba(255, 255, 255, 0.12);
            outline: 2px solid rgba(255, 255, 255, 0.7);
        }
        .area-botao:active { background: rgba(0, 0, 0, 0.15); }
        .area-botao:focus-visible { outline: 3px solid #fff; }

        .atacar   { left: 60.5%; top: 73.5%; width: 17.5%; height: 10.5%; }
        .defender { left: 78.5%; top: 73.5%; width: 18%;   height: 10.5%; }
        .trocar   { left: 60.5%; top: 84.5%; width: 36%;   height: 9.5%; }
        .voltar   { left: 77%;   top: 2.5%;  width: 20%;   height: 9.5%; }

        @media (max-width: 600px) {
            body { align-items: flex-start; }
            .arena { width: 100%; }
        }
    </style>
</head>
<body>
    <main class="arena">
        <!-- Imagem principal da batalha -->
        <img class="cenario" src="/BolsoMonstro/App/Views/imgs/Batalha.png" alt="Arena de batalha BolsoMonstro">

        <!-- Mensagens -->
        <div class="mensagem" id="mensagem" aria-live="polite">Escolha uma ação!</div>

        <!-- Botões de interação sobre a imagem -->
        <button class="area-botao atacar"   type="button" onclick="atacar()"   aria-label="Atacar"></button>
        <button class="area-botao defender" type="button" onclick="defender()" aria-label="Defender"></button>
        <a      class="area-botao trocar"   href="/BolsoMonstro/App/Controllers/BatalhaController.php?acao=selecionar" aria-label="Trocar times"></a>
        <a      class="area-botao voltar"   href="/BolsoMonstro/App/Controllers/PrincipalController.php" aria-label="Voltar ao menu"></a>
    </main>

    <script>
        const dano = 20;
        const defesa = 15;
        const mensagem = document.getElementById('mensagem');

        function atacar() {
            mensagem.textContent = 'Ataque realizado! Dano causado: ' + dano;
        }

        function defender() {
            mensagem.textContent = 'Defesa ativada! Proteção: ' + defesa;
        }
    </script>
</body>
</html>