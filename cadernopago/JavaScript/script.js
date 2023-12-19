const numDocumento = document.querySelector("#documento");
const tipoDocumento = document.querySelector("#tipoDocumento");

document.getElementById("formulario").addEventListener("submit", function(event) {
    if (!validarSenha()) {
        event.preventDefault(); 
    }
});

function validarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmarSenha = document.getElementById("confirmarSenha").value;

    if (senha !== confirmarSenha) {
        document.getElementById("confirmarSenha").setCustomValidity("As senhas não coincidem. Por favor, digite novamente.");
        return false; 
    } else {
        document.getElementById("confirmarSenha").setCustomValidity("");
        return true; 
    }
}

function validarDocumento(doc) {
    const padrao = /(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/
    return padrao.test(doc)
}

numDocumento.addEventListener("keyup", (event) => {
    let valido = validarDocumento(event.target.value);

    if (valido) {
        numDocumento.classList.remove("invalido");
        numDocumento.classList.add("valido");
        tipoDocumento.value = numDocumento.value.length === 14 ? "CPF":"CNPJ";
    } else {
        numDocumento.classList.remove("valido");
        numDocumento.classList.add("invalido");
        tipoDocumento.value = "Digite um documento válido.";
    }

})

function formatarDocumento(doc) {
    let documento = doc.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (documento.length <= 11) {
        documento = documento.replace(/(\d{3})(\d)/, '$1.$2'); 
        documento = documento.replace(/(\d{3})(\d)/, '$1.$2'); 
        documento = documento.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 
    } else {
        documento = documento.replace(/^(\d{2})(\d)/, '$1.$2'); 
        documento = documento.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3'); 
        documento = documento.replace(/\.(\d{3})(\d)/, '.$1/$2');
        documento = documento.replace(/(\d{4})(\d)/, '$1-$2'); 
    }
    return documento;
}

numDocumento.addEventListener("input", (event) => {
    let valorAtual = event.target.value;
    let novoValor = formatarDocumento(valorAtual);
    event.target.value = novoValor;
});
