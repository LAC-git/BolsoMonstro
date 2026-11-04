<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Login</title>
    <style>
        :root {
            --bg: #fdf6e3;
            --painel: #fffefb;
            --painel-suave: #f8f4ec;
            --primario: #d97706;
            --primario-suave: #f9e7c9;
            --terciario: #2aa198;
            --texto: #073642;
            --mutado: #586e75;
            --borda: #eee8d5;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #f8f3ea 50%, #f1efe8 100%);
            color: var(--texto);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .cartao {
            width: min(420px, 90%);
            background: var(--painel);
            border: 1px solid var(--borda);
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 16px 35px rgba(88, 110, 117, 0.08);
        }

        h1 {
            margin-top: 0;
            text-align: center;
            color: var(--texto);
        }

        form {
            display: grid;
            gap: 14px;
        }

        input {
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #d9d0b5;
            background: #f8f4ec;
            color: var(--texto);
        }

        input::placeholder {
            color: var(--mutado);
        }

        button, a {
            display: inline-block;
            text-align: center;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
        }

        button {
            border: 1px solid rgba(217, 119, 6, 0.18);
            background: var(--primario-suave);
            color: var(--primario);
            cursor: pointer;
        }

        .botoesAcesso {
            display: flex;
            justify-content: space-between;
            margin-top: 18px;
            gap: 10px;
        }

        .botoesAcesso a {
            background: var(--painel-suave);
            color: var(--texto);
            border: 1px solid var(--borda);
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="cartao">
        <h1>Login</h1>
        <form>
            <input type="email" placeholder="E-mail" aria-label="E-mail">
            <input type="password" placeholder="Senha" aria-label="Senha">
            <button type="submit">Entrar</button>
        </form>

        <div class="botoesAcesso">
            <a href="criar-usuario.php">Criar conta</a>
            <a href="index.php">Início</a>
        </div>
    </div>
</body>
</html>