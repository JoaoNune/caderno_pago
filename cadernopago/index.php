<?php

session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: http://localhost/cadernopago/php/index.php");
    
} else {
    header("Location: http://localhost/cadernopago/login.php");
    session_destroy();
}

die();

?>