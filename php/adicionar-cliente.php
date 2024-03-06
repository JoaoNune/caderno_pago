<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Adicionar Clientes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container page-cliente">
        <header>
            <h1>
                <img src="../img/pessoa.png" alt="">
                <span>Clientes</span>
            </h1>
            <div>
               <button id="addNovoCliente">
                    <img src="../img/adicao.png" alt="">
                    <span>Novo Cliente</span>
               </button>
               <button id="voltarInicio" onclick="window.location.href='index.php'">
                    <img src="../img/voltar.png" alt="">
                    <span>Voltar para Início</span>
                </button>
            </div>
        </header>

        <aside class="form-container">
            <form action="processar-cliente.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>

                <label for="divida">Dívida Atual:</label>
                <input type="text" name="divida" id="divida" oninput="atualizarCampoDivida()" required>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" oninput="atualizarCampoCPF()" maxlength="14" required>

                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" required>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" oninput="atualizarCampoTelefone()" maxlength="15" required>

                <input type="submit" value="Adicionar Cliente" id="salvarCliente">
            </form>
        </aside>
        <main class="list-container">
            <?php
            require_once 'conexao.php';
            if (isset($_GET['status'])) {
                echo '<div class="mensagem-erro">';
                if ($_GET['status'] == 'sucesso') {
                    echo '<p class="sucesso">Cliente adicionado com sucesso!</p>';
                } elseif ($_GET['status'] == 'erro') {
                    echo '<p class="erro">Erro ao adicionar o cliente.</p>';
                }
                echo '</div>';
            }
            $conexao = obterConexao();
            $query = "SELECT * FROM clientes";
            $result = $conexao->query($query);

              if ($result->num_rows > 0) {
                echo "<ul>";
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<span>";
                    echo "<strong><a href='detalhes-cliente.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["nome"]) . "</a></strong>";
                    echo "<em>CPF: " . htmlspecialchars($row["cpf"]) . "</em>";
                    echo "<em>Dívida: " . htmlspecialchars($row["divida"]) . "</em>";
                    echo "</span>";
                    echo "<i><a href='editar-cliente.php?id=" . $row['id'] . " ' onclick=return confirm(\"Quer editar?\");'><i class='fas fa-pencil'></i></a></i>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhum cliente cadastrado.</p>";
            }
            $conexao->close();
            ?>
        </main>
    </div>

    <script src="../JavaScript/addCliente.js"></script>
    <script src="../JavaScript/mascaras.js"></script>
</body>
</html>
