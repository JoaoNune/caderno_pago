<?php
session_start();

if (isset($_SESSION["usuario"])) {
    if (isset($_GET["logoff"])) {
        unset($_SESSION["usuario"]);
        session_destroy();
        header("Location: http://localhost/cadernopago/login.php");
        exit();
    }

    echo "Bem-vindo.";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Comercial</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> <!-- Adicione o caminho correto para o seu arquivo de estilo -->
</head>
<body>
    <header>
        <h1>Sistema Comercial</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Pesquisar</a></li>
            <li><a href="#" id="clientesLink">Clientes</a></li>
            <li><a href="#" id="configuracoesLink">Configurações</a></li>
            <li><a href="#" id="filtrarLink">Filtrar</a></li>
            <li><a href="?logoff" id="logoffLink">Logoff</a></li>
        </ul>
    </nav>

    <section>
        <!-- Conteúdo da página aqui -->
    </section>

    <footer>
        <p>&copy; 2024 Guilherme</p>
    </footer>
</body>
</html>

<?php
} else {
    session_destroy();
    header("Location: http://localhost/cadernopago/login.php");
    die();
}
?>