<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "post") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $telefone = $_POST["telefone"];
    $tipoDocumento = $_POST["tipoDocumento"];
    $documento = $_POST["documento"];
}



    $sql = "INSERT INTO usuarios (tipoDocumento, documento, nome, email, senha, telefone) VALUES ('$tipoDocumento', '$documento', '$nome', '$email', '$senha', '$telefone')";
    $resultado = $sql;
    if ($resultado) {
        echo "Cadastro realizado com sucesso!";
    } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
?>