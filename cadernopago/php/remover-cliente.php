<?php
session_start();
require_once 'conexao.php';

try{
    $conexao = obterConexao();

    if (!isset($_SESSION["usuario"])) {
        header("Location: ./login.php");
        exit();
    }

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conexao->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Cliente removido com sucesso!'); window.location.href='pesquisar-cliente.php';</script>";
        } else {
            echo "<script>alert('Erro ao remover cliente!'); window.location.href='pesquisar-cliente.php';</script>";
        }

        $stmt->close();
        $conexao->close();
    } else {
        header("Location: pesquisar-cliente.php");
        exit();
    }
} catch (Exception $error) {
    echo "Erro ao conectar com o BD. $error";
    exit();
}
?>
