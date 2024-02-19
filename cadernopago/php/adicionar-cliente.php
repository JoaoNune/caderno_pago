<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Clientes</title>
</head>
<body>
<section>
        <h2>Adicionar Novo Cliente</h2>
        <p>Como vendedor, quero adicionar novos clientes à minha lista, para que eu possa ter controle de acesso aos meus clientes.</p>

        <form action="processar_cliente.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="divida">Dívida Atual:</label>
            <input type="text" name="divida" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone">

            <input type="submit" value="Adicionar Cliente">
        </form>
    </section>
</body>
</html>