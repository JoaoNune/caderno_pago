<?php

session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: ./index.php");
    die();
} else {
    session_destroy();
}

$erro = isset($_GET['erro']) ? $_GET['erro'] : null;

if ($erro === "conexao") {
    $mensagemErro = "Erro ao conectar com o banco de dados.";
} elseif ($erro === "senha") {
    $mensagemErro = "Senha incorreta. Por favor, tente novamente.";
} elseif ($erro === "usuario") {
    $mensagemErro = "Usuário não encontrado. Verifique seu e-mail.";
} else {
    $mensagemErro = "";
} 

$mensagemErro = isset($_SESSION['erro']) ? $_SESSION['erro'] : "";
unset($_SESSION['erro']); // Limpa a mensagem de erro para não exibi-la novamente

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Caderno Pago</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="./validar_login.php" method="post" id="login">
                <label for="emailLogin">E-mail:</label>
                <input type="email" name="emailLogin" id="emailLogin" required><br>

                <label for="senhaLogin">Senha:</label>
                <input type="password" name="senhaLogin" id="senhaLogin" required><br>

                <button type="submit">Entrar</button>
            </form>
        </div>

        <div class="cadastro-message">
            <p>Ainda não é cadastrado? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </div>

        <div class="mensagem-erro">
            <?php echo $mensagemErro; ?>
        </div>
    </div>
</body>

<script src="JavaScript/script.js"></script>
</html>
