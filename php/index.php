<?php
session_start();

if (isset($_SESSION["usuario"])) {
    if (isset($_GET["logoff"])) {
        header("Location: ../logoff.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema Comercial</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <div class="container">
        <div class="index-img">
            <img src="../img/index.png" alt="">
        </div>
        <form id="search-bar" action="pesquisar-cliente.php" action="pesquisar-cliente.php" method="POST">
            <label for="search">
                <input type="search" id="search" placeholder="Pesquisar">
            </label>
            <button type="submit"><img src="../img/search.png" alt=""></button>
        </form>
      <nav class="menu-principal">
        <ul>
          <li>
            <a href="adicionar-cliente.php">
              <img src="" alt="">
              <span>Clientes</span>
            </a>
          </li>
          <li>
            <a href="#" id="configuracoesLink">
              <img src="" alt="">  
              <span>Configurações</span>
            </a>
            <a href="#" id="filtrarLink">
              <span>Filtrar</span>
            </a>
          </li>
          <li>
            <a href="?logoff" id="logoffLink">
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!--<li><a href="pesquisar-cliente.php">Pesquisar</a></li>-->
    <footer>
      <p>&copy; 2024 Guilherme</p>
    </footer>

    <script>
      document
        .getElementById("logoffLink")
        .addEventListener("click", function (event) {
          var confirmarLogoff = confirm(
            "Tem certeza de que deseja fazer logoff?"
          );

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
    header("Location: ../login.php");
    die();
}
?>
