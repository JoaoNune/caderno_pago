<?php
session_start();
require_once 'conexao.php';

try {
    $conexao = obterConexao();

    if (!isset($_SESSION["usuario"])) {
        header("Location: ./login.php");
        exit();
    }

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Verifique se o formulário de edição foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtenha os novos dados do formulário
            $novoNome = $_POST['novoNome'];
            $novaDivida = $_POST['novaDivida'];
            $novoCpf = $_POST['novoCpf'];
            $novoEndereco = $_POST['novoEndereco'];
            $novoTelefone = $_POST['novoTelefone'];

            // Prepare e execute a instrução UPDATE
            $stmt = $conexao->prepare("UPDATE clientes SET nome=?, divida=?, cpf=?, endereco=?, telefone=? WHERE id=?");
            $stmt->bind_param("sssssi", $novoNome, $novaDivida, $novoCpf, $novoEndereco, $novoTelefone, $id);

            if ($stmt->execute()) {
                echo "<script>alert('Cliente editado com sucesso!'); window.location.href='pesquisar-cliente.php';</script>";
            } else {
                echo "<script>alert('Erro ao editar cliente!'); window.location.href='pesquisar-cliente.php';</script>";
            }

            $stmt->close();
        } else {
            // Se o formulário não foi enviado, exiba o formulário de edição
            $stmt = $conexao->prepare("SELECT * FROM clientes WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $cliente = $resultado->fetch_assoc();

            $stmt->close();

            // Exiba o formulário de edição
            echo "<h2>Editar Cliente</h2>";
            echo "<form method='post'>";
            echo "<label for='novoNome'>Novo Nome:</label>";
            echo "<input type='text' name='novoNome' value='" . htmlspecialchars($cliente['nome']) . "' required><br>";

            echo "<label for='novaDivida'>Nova Dívida:</label>";
            echo "<input type='text' name='novaDivida' value='" . htmlspecialchars($cliente['divida']) . "' required><br>";

            echo "<label for='novoCpf'>Novo CPF:</label>";
            echo "<input type='text' name='novoCpf' value='" . htmlspecialchars($cliente['cpf']) . "' maxlength='14' required><br>";

            echo "<label for='novoEndereco'>Novo Endereço:</label>";
            echo "<input type='text' name='novoEndereco' value='" . htmlspecialchars($cliente['endereco']) . "'><br>";

            echo "<label for='novoTelefone'>Novo Telefone:</label>";
            echo "<input type='text' name='novoTelefone' value='" . htmlspecialchars($cliente['telefone']) . "' maxlength='15'><br>";

            echo "<button type='submit'>Salvar Edições</button>";
            echo "</form>";
        }

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
