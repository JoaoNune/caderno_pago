<?php
require_once 'conexao.php';

try{
    $conexao = obterConexao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $divida = $_POST["divida"];
        $cpf = $_POST["cpf"];
        $endereco = $_POST["endereco"];
        $telefone = $_POST["telefone"];

        $stmt = $conexao->stmt_init();

        $stmt->prepare("INSERT INTO clientes (nome, divida, cpf, endereco, telefone) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $nome, $divida, $cpf, $endereco, $telefone);

        if ($stmt->execute()) {
            echo "Cliente adicionado com sucesso.";
        } else {
            echo "Não foi possível adicionar o cliente.";
        }

        $stmt->close();
    }
    $conexao->close();
} catch (Exception $error) {
    echo "Erro ao conectar com o BD. $error";
}
?>
