<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BolsoMonstro | Criar usuário</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: min(480px, 90%);
            background: #111827;
            border: 1px solid #334155;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 16px 35px rgba(15, 23, 42, 0.5);
        }

        h1 {
            margin-top: 0;
            text-align: center;
        }

        form {
            display: grid;
            gap: 14px;
        }

        input {
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #475569;
            background: #0b1120;
            color: white;
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
            border: none;
            background: #f59e0b;
            color: #111827;
            cursor: pointer;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 18px;
            gap: 10px;
        }

        .links a {
            background: #1d4ed8;
            color: white;
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Criar usuário</h1>
        <form>
            <input type="text" placeholder="Nome do treinador" aria-label="Nome do treinador">
            <input type="email" placeholder="E-mail" aria-label="E-mail">
            <input type="password" placeholder="Senha" aria-label="Senha">
            <button type="submit">Cadastrar</button>
        </form>

        <div class="links">
            <a href="login.php">Fazer login</a>
            <a href="index.php">Início</a>
        </div>
    </div>
</body>
</html>
