<?php

session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: http://localhost/cadernopago/php/index.php");
    die();
} else {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="php/validar_login.php" method="post" id="login">
                <label for="emailLogin">E-mail:</label>
                <input type="email" name="emailLogin" id="emailLogin" required><br>

                <label for="senhaLogin">Senha:</label>
                <input type="password" name="senhaLogin" id="senhaLogin" required><br>

                <button type="submit">Entrar</button>
            </form>
        </div>

        <div class="cadastro-message">
            <p>Ainda não é cadastrado? <a href="cadastro.html">Cadastre-se aqui</a></p>
        </div>
    </div>
</body>

<script src="JavaScript/script.js"></script>
</html>
