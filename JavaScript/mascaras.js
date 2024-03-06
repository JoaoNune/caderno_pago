// mascaras.js

document.addEventListener("DOMContentLoaded", function () {
    var campoDivida = document.getElementById("divida");

    campoDivida.addEventListener("input", atualizarCampoDivida);

    var form = document.querySelector("form");
    form.addEventListener("submit", function () {
        campoDivida.value = parseFloat(campoDivida.value.replace(/\D/g, "")).toFixed(2);
    });
});

function formatarDinheiroExibicao(valor) {
    var numero = parseFloat(valor) / 100;
    return numero.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
    });
}

function atualizarCampoDivida() {
    var campoDivida = document.getElementById('divida');
    var valorDigitado = campoDivida.value.replace(/\D/g, "");

    if (valorDigitado.length > 0) {
        var valorFormatado = formatarDinheiroExibicao(valorDigitado);
        campoDivida.value = valorFormatado;
    }
}

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


function formatarTelefone(telefone) {
    let telefoneFormatado = telefone.replace(/\D/g, '');
    telefoneFormatado = telefoneFormatado.replace(/(\d{2})(\d{4,5})(\d{4})$/, '($1) $2-$3');

    return telefoneFormatado;
}

function atualizarCampoTelefone() {
    var campoTelefone = document.getElementById('telefone');
    campoTelefone.value = formatarTelefone(campoTelefone.value);
}

