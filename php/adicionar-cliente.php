<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px; 
        }

        .form-container, .list-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container h2, .list-container h2 {
            width: 100%; 
            text-align: center; 
            margin-bottom: 20px; 
        }

        form {
            width: 100%;
            max-width: 500px; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box; 
        }

        input[type="text"] {
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #4682B4;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #4169E1;
        }

        input[type="text"]:focus {
            border-color: #4682B4;
            outline: none;
            box-shadow: 0 0 5px rgba(70, 130, 180, 0.5);
        }

        .success-message, .error-message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #4CAF50;
        }

        .error-message {
            background-color: #f44336;
        }


        h2 {
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4682B4;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .success-message, .error-message {
            color: #fff;
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .success-message {
            background-color: #4CAF50;
        }

        .error-message {
            background-color: #f44336;
        }
    </style>
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
    <div class="container">
        <div class="form-container">
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
        </div>
        <div class="list-container">
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
        </div>
    </div>
</body>
</html>
