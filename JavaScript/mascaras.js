function formatarDivida(divida) {
    let dividaFormatada = divida.replace(/\D/g, '');
    dividaFormatada = dividaFormatada.replace(/(\d{1,})(\d{2})$/, '$1.$2');

    return dividaFormatada;
}

function atualizarCampoDivida() {
    var campoDivida = document.getElementById('divida');
    campoDivida.value = formatarDivida(campoDivida.value);
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

