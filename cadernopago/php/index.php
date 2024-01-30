<?php

session_start();

if (isset($_GET["logoff"])) {
    unset($_SESSION["usuario"]);
    session_destroy();
}

if (isset($_SESSION["usuario"])) {
    echo "Bem-vindo.";
    echo '<br><a href="?logoff">Sair<a>';
} else {
    session_destroy();
    header("Location: http://localhost/cadernopago/login.php");
    die();
}