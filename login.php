<?php

session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: php/index.php");
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
unset($_SESSION['erro']); //Limpa a mensagem de erro para não exibi-la novamente

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
        <div class="logo">
            <img src="img/logo.png" alt="">
        </div>
        <div class="login-form">
            <?php
                if (strlen($mensagemErro) > 0) {
                    echo '<div class="mensagem-erro">'.$mensagemErro.'</div>';
                }
            ?>
            <form action="./php/validar_login.php" method="post" id="login">
                <label for="emailLogin">
                    <span>E-mail:</span>
                    <input type="email" name="emailLogin" id="emailLogin" required placeholder="exemplo@email.com">
                </label>

                <label for="senhaLogin">
                    <span>Senha:</span>
                    <input type="password" name="senhaLogin" id="senhaLogin" required placeholder="Informe sua senha">
                </label>
                

                <button type="submit">Entrar</button>
            </form>
            <div class="cadastro-message">
                <p>Ainda não é cadastrado? <a href="cadastro.php">Cadastre-se aqui</a></p>
            </div>
        </div>
    </div>
</body>

<script src="JavaScript/script.js"></script>
</html>
