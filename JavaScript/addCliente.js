const addCliente = document.querySelector("#addNovoCliente");
const salvarCliente = document.querySelector("#salvarCliente");

const formCliente = document.querySelector(".page-cliente aside");
const listCliente = document.querySelector(".page-cliente main");


addCliente.addEventListener("click", function(ev) {
    formCliente.classList.add("mostrar");
    formCliente.classList.remove("ocultar");
    listCliente.classList.add("ocultar");
});

salvarCliente.addEventListener("click", function(ev) {
    formCliente.classList.add("ocultar");
    listCliente.classList.remove("ocultar");
});

