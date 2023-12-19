document.getElementById("formulario").addEventListener("submit", function(event) {
    if (!validarSenha()) {
        event.preventDefault(); // Impede o envio do formulário se a validação falhar
    }
});

function validarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmarSenha = document.getElementById("confirmarSenha").value;

    if (senha !== confirmarSenha) {
        document.getElementById("confirmarSenha").setCustomValidity("As senhas não coincidem. Por favor, digite novamente.");
        return false; // Impede o envio do formulário
    } else {
        document.getElementById("confirmarSenha").setCustomValidity(""); // Limpa a mensagem de validação
        return true; // Permite o envio do formulário
    }
}
