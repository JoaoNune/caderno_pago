<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Clientes</title>
    <script>
        function formatarCPF(cpf) {
            let cpfFormatado = cpf.replace(/\D/g, '');
            cpfFormatado = cpfFormatado.replace(/(\d{3})(\d)/, '$1.$2'); 
            cpfFormatado = cpfFormatado.replace(/(\d{3})(\d)/, '$1.$2'); 
            cpfFormatado = cpfFormatado.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            return cpfFormatado;
        }

        function atualizarCampoCPF() {
            var campoCPF = document.getElementById('cpf');
            campoCPF.value = formatarCPF(campoCPF.value);
        }

        function formatarDivida(divida) {
            let dividaFormatada = divida.replace(/\D/g, '');
            dividaFormatada = dividaFormatada.replace(/(\d{1,})(\d{2})$/, '$1.$2');

            return dividaFormatada;
        }

        function atualizarCampoDivida() {
            var campoDivida = document.getElementById('divida');
            campoDivida.value = formatarDivida(campoDivida.value);
        }

        function formatarTelefone(telefone) {
            let telefoneFormatado = telefone.replace(/\D/g, ''); 
            telefoneFormatado = telefoneFormatado.replace(/(\d{2})(\d{4,5})(\d{4})$/, '($1) $2-$3');

            return telefoneFormatado;
        }

        function atualizarCampoTelefone() {
            var campoTelefone = document.getElementById('telefone');
            campoTelefone.value = formatarTelefone(campoTelefone.value);
        }
    </script>
</head>
<body>
    <section>
        <h2>Adicionar Novo Cliente</h2>
        <form action="processar-cliente.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="divida">Dívida Atual:</label>
            <input type="text" name="divida" id="divida" oninput="atualizarCampoDivida()" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" oninput="atualizarCampoCPF()" maxlength="14">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" oninput="atualizarCampoTelefone()" maxlength="15">

            <input type="submit" value="Adicionar Cliente">
        </form>

        <?php
        require_once 'conexao.php';
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'sucesso') {
                echo "<p>Cliente adicionado com sucesso!</p>";
            } elseif ($_GET['status'] == 'erro') {
                echo "<p>Erro ao adicionar o cliente.</p>";
            }
        }
        $conexao = obterConexao();
        $query = "SELECT * FROM clientes";
        $result = $conexao->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Lista de Clientes</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>Dívida</th><th>CPF</th><th>Endereço</th><th>Telefone</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["divida"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cpf"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["endereco"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum cliente cadastrado.";
        }
        $conexao->close();
        ?>
    </section>
</body>
</html>
