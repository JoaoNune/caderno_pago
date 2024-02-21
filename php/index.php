<?php
session_start();

if (isset($_SESSION["usuario"])) {
    if (isset($_GET["logoff"])) {
        unset($_SESSION["usuario"]);
        session_destroy();
        header("Location: ./login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Comercial</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #E0EAFC 0%, #CFDEF3 100%);
    color: #333;
    text-align: center;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

header h1 {
    margin: 0;
    padding: 20px;
    font-size: 2.5rem;
    color: #205493;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 20px 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: #205493;
    background-color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
}

nav ul li a:hover, nav ul li a:focus {
    background-color: #E0EAFC;
    color: #16325C;
}

footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 10px;
    color: #205493;
    background-color: #fff;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>
    <header>
        <h1>Caderno Pago</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Pesquisar</a></li>
            <li><a href="adicionar-cliente.php">Clientes</a></li>
            <li><a href="#" id="configuracoesLink">Configurações</a></li>
            <li><a href="#" id="filtrarLink">Filtrar</a></li>
            <li><a href="?logoff" id="logoffLink">Logoff</a></li>
        </ul>
    </nav>

    <section>

    </section>

    <footer>
        <p>&copy; 2024 Guilherme</p>
    </footer>

    <script>
        document.getElementById("logoffLink").addEventListener("click", function(event) {
            var confirmarLogoff = confirm("Tem certeza de que deseja fazer logoff?");
            
            if (!confirmarLogoff) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

<?php
} else {
    session_destroy();
    header("Location: ./login.php");
    die();
}
?>
