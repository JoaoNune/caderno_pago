<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
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
        <div class="logo">
            <img src="img/logo.png" alt="">
        </div>
        <div class="cadastro-form">
            <form action="php/cadastro.php" method="post" id="formulario" >
                <label for="nome">
                    <span>Nome:</span>
                    <input type="text" name="nome" id="nome" required><br>
                </label>

                <label for="email">
                    <span>E-mail:</span>
                    <input type="email" name="emailLogin" id="emailLogin" required placeholder="exemplo@email.com">
                </label>

                <label for="senha">
                    <span>Senha:</span>
                    <input type="password" name="senhaLogin" id="senhaLogin" required placeholder="Informe sua senha">
                </label>

                <label for="confirmarSenha">
                    <span>Confirmar senha:</span>
                    <input type="password" name="confirmarSenha" id="confirmarSenha" required>
                </label>

                <label for="tipoDocumento">
                    <span>CPF ou CNPJ:</span>
                    <input type="text" name="documento" id="documento" maxlength="18">
                </label>
                <select name="tipoDocumento" id="tipoDdocumento">
                    <option value="cpf">CPF</option>
                    <option value="cnpj">CNPJ</option>
                </select>

                <label for="telefone">
                    <span>Telefone:</span>
                    <input type="text" name="telefone" id="telefone" oninput="atualizarCampoTelefone()" maxlength="15" required>
                </label>
                
                <button type="submit">Cadastrar</button>
            </form>
            <div class="login-message">
                <p>Já é cadastrado?<a href="index.php"> Faça login</a></p>
            </div>
        </div>
    </div>
</body>

<script src="JavaScript/script.js"></script>
</html>
