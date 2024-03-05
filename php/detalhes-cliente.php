<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Cliente</title>
</head>
<body>
    <?php
    require_once 'conexao.php';

    if(isset($_GET['id'])) {
        $cliente_id = $_GET['id'];
        $conexao = obterConexao();
        $query = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
            ?>
            <h2>Detalhes do Cliente</h2>
            <p>Nome: <?php echo htmlspecialchars($cliente["nome"]); ?></p>
            <p>CPF/CNPJ: <?php echo htmlspecialchars($cliente["cpf"]); ?></p>
            <p>Telefone: <?php echo htmlspecialchars($cliente["telefone"]); ?></p>
            <p>Débito: <?php echo htmlspecialchars($cliente["divida"]); ?></p>
            <a href="editar-cliente.php?id=<?php echo $cliente_id; ?>">Editar Dados</a>
            <h3>Compras</h3>
            <!-- Aqui você pode adicionar a funcionalidade de compras -->
            <h3>Pagamentos</h3>
            <!-- Aqui você pode adicionar a funcionalidade de pagamentos -->
            <?php
        } else {
            echo "Cliente não encontrado.";
        }
        $stmt->close();
        $conexao->close();
    } else {
        echo "ID do cliente não fornecido.";
    }
    ?>
</body>
</html>
