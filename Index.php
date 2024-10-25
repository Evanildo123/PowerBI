<?php
include('conexao.php');

session_start(); // Inicia a sessão no começo do script

$erro = ""; // Variável para armazenar a mensagem de erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica se o formulário foi enviado
    // Verifica se os campos foram preenchidos
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Preencha todos os campos.";
    } else { 
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        // Verifica as credenciais no banco de dados
        $sql_code = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        // Verifica se as credenciais estão corretas
        if ($sql_query->num_rows == 1) {
            $usuario = $sql_query->fetch_assoc();

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            exit();
        } else {
           
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }

        .login-container p {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 30px;
        }

        .error-message {
            color: red; /* Cor da mensagem de erro */
            margin-bottom: 20px; /* Espaço abaixo da mensagem */
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 0.9em;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 5px;
            left: 10px;
            font-size: 0.75em;
            color: #ED196D;
        }

        .input-group input {
            width: 100%;
            padding: 15px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            color: #333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #ED196D;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            background-color: #ED196D;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .login-btn:hover {
            background-color: #d0175e;
            transform: scale(1.02);
        }

        .login-btn:active {
            background-color: #b01551;
        }

        .forgot-password {
            display: block;
            margin-top: 20px;
            font-size: 0.9em;
            color: #ED196D;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #d0175e;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Bem-vindo de volta!</h2>
        <p>Por favor, insira suas credenciais para continuar.</p>

        <?php if (!empty($erro)): ?> <!-- Exibe a mensagem de erro somente se houver -->
            <p class="error-message"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="#" method="post">
            <div class="input-group">
                <input type="text" id="email" name="email" required placeholder=" " />
                <label for="email">E-mail</label>
            </div>

            <div class="input-group">
                <input type="password" id="senha" name="senha" required placeholder=" " />
                <label for="senha">Senha</label>
            </div>

            <button type="submit" class="login-btn">Entrar</button>
        </form>

        <a href="#" class="forgot-password">Esqueceu sua senha?</a>
    </div>
</body>
</html>
