<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: http://localhost/cadernopago/php/index.php");
    die();
}

require_once 'conexao.php';

try {
    $conexao = obterConexao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["emailLogin"];
        $senha = $_POST["senhaLogin"];

        $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashSenha);

        if ($stmt->fetch()) {
            if (password_verify($senha, $hashSenha)) {
                $_SESSION["usuario"] = $id;
                header("Location: http://localhost/cadernopago/php/index.php");
            } else {
                header("Location: http://localhost/cadernopago/login.php");
            }
        } else {
            header("Location: http://localhost/cadernopago/login.php");
        }

        $stmt->close();
    }

    $conexao->close();
    
} catch (Exception $error) {
    //echo "Erro ao conectar com o BD. $error";
    header("Location: http://localhost/cadernopago/login.php");
}
?>