<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION["usuario"])) {
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
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

        table {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 120px);
        }

        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #4682B4;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4169E1;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pesquisar Cliente</h2>
        <form action="pesquisar-cliente.php" method="GET">
            <input type="text" name="nomePesquisa" placeholder="Digite o nome do cliente" required>
            <input type="submit" value="Pesquisar">
        </form>

        <?php
        try {
            $conexao = obterConexao();

            if (isset($_GET['nomePesquisa']) && !empty($_GET['nomePesquisa'])) {
                $nomePesquisa = $_GET['nomePesquisa'];
    
                $stmt = $conexao->prepare("SELECT * FROM clientes WHERE nome LIKE ?");
                $nomePesquisa = "%" . $nomePesquisa . "%";
                $stmt->bind_param("s", $nomePesquisa);
    
                $stmt->execute();
                $resultado = $stmt->get_result();
    
                if ($resultado->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Nome</th><th>Dívida</th><th>CPF</th><th>Endereço</th><th>Telefone</th></tr>";
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['nome']) . "</td>
                                <td>" . htmlspecialchars($row['divida']) . "</td>
                                <td>" . htmlspecialchars($row['cpf']) . "</td>
                                <td>" . htmlspecialchars($row['endereco']) . "</td>
                                <td>" . htmlspecialchars($row['telefone']) . "</td>
                                <td>
                                    <a href='remover-cliente.php?id=" . $row['id'] . "' onclick='return confirm(\"Tem certeza que deseja remover este cliente?\");'><i class='fas fa-trash'></i></a>
                                    <a href='editar-cliente.php?id=" . $row['id'] . " ' onclick=return confirm(\"Quer editar?\");'><i class='fas fa-pencil-alt'</i></a>
                                </td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>Nenhum cliente encontrado.</p>";
                }
    
                $stmt->close();
            }

            $conexao->close();
            exit();
        } catch (Exception $error) {
            echo "Erro ao conectar com o BD. $error";
            exit();
        }
        
        ?>
    </div>
</body>
</html>
