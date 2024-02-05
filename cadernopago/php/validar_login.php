<?php
session_start();

require_once 'conexao.php';

try {
    $conexao = obterConexao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["emailLogin"];
        $senha = $_POST["senhaLogin"];

        // Consulta preparada para evitar injeção de SQL
        $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashSenha);

        if ($stmt->fetch()) {
            if (password_verify($senha, $hashSenha)) {
                // Credenciais corretas, inicia a sessão
                $_SESSION["usuario"] = $id;
                header("Location: http://localhost/cadernopago/php/index.php");
            } else {
                // Senha incorreta
                $_SESSION["erro"] = "Senha incorreta. Por favor, tente novamente.";
                header("Location: http://localhost/cadernopago/login.php");
            }
        } else {
            // Usuário não encontrado
            // Senha incorreta
            $_SESSION["erro"] = "Senha incorreta. Por favor, tente novamente.";
            // Adiciona um parâmetro de erro na URL
            header("Location: http://localhost/cadernopago/login.php?erro=senha");

        }

        $stmt->close();
    }

    $conexao->close();
} catch (Exception $error) {
    // Em caso de erro, armazena a mensagem de erro na sessão
    $_SESSION["erro"] = "Erro ao conectar com o banco de dados.";
    header("Location: http://localhost/cadernopago/login.php");
}
?>
