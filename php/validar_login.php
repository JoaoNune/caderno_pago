<?php
session_start();

require_once 'conexao.php';

try {
    $conexao = obterConexao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["emailLogin"];
        $senha = $_POST["senhaLogin"];
        
        $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashSenha);

        if ($stmt->fetch()) {
            if (password_verify($senha, $hashSenha)) {
                $_SESSION["usuario"] = $id;
                header("Location: ././index.php");
            } else {
                $_SESSION["erro"] = "Senha incorreta. Por favor, tente novamente.";
                header("Location: ./login.php");
            }
        } else {
            $_SESSION["erro"] = "Senha incorreta. Por favor, tente novamente.";

            header("Location: ./login.php?erro=senha");

        }

        $stmt->close();
    }

    $conexao->close();
} catch (Exception $error) {
    $_SESSION["erro"] = "Erro ao conectar com o banco de dados.";
    header("Location: ./login.php");
}
?>
