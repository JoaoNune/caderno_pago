const addCliente = document.querySelector("#addNovoCliente");
const salvarCliente = document.querySelector("#salvarCliente");

const formCliente = document.querySelector(".page-cliente aside");
const listCliente = document.querySelector(".page-cliente main");


addCliente.addEventListener ("click", ev => {
    formCliente.style.display = "block";
    listCliente.style.display = "none";
    addCliente.style.display = "none";
})

salvarCliente.addEventListener ("click", ev => {
    formCliente.style.display = "none";
    listCliente.style.display = "block";
    addCliente.style.display = "flex";
})

