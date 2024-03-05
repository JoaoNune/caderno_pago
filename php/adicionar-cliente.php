<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Adicionar Clientes</title>
    <link rel="stylesheet" href="../css/style.css">
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
    <div class="container page-cliente">
        <header>
            <h1>Título</h1>
            <div>
                <a href="">Novo Cliente</a>
            </div>
        </header>

        <aside class="form-container">
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
        </aside>
        <main class="list-container">
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
                echo "<ul>";
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<span>";
                    echo "<strong><a href='detalhes-cliente.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["nome"]) . "</a></strong>";
                    echo "<em>CPF: " . htmlspecialchars($row["cpf"]) . "</em>";
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
</body>
</html>
