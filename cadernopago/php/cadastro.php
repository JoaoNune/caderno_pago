<?php
require_once 'conexao.php';

define (PASSWORD_DEFAULT, "aluno");

try{
    $conexao = obterConexao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $telefone = $_POST["telefone"];
        $tipoDocumento = $_POST["tipoDocumento"];
        $documento = $_POST["documento"];

        $stmt = $conexao->stmt_init();

        $stmt->prepare("INSERT INTO usuarios (nome, email, senha, telefone, tipoDocumento, documento) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt -> bind_param("ssssss", $nome, $email, $senha, $telefone, $tipoDocumento, $documento);

        if($stmt->execute()) {
            echo "Dados salvos com sucesso.";
        } else {
            echo "Não foi possível salvar os dados.";
        }

        $stmt->close();
        
        
    }
    $conexao-> close();
}
catch (Exception $error) {
    echo "Erro ao conectar com o BD. $error";
}
?>
