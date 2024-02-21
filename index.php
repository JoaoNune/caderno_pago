<?php

session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: ./index.php");
    
} else {
    header("Location:./login.php");
    session_destroy();
}

die();

?>