CREATE DATABASE cadernopago;

use cadernopago;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipoDocumento ENUM('cpf', 'cnpj') NOT NULL,
    documento VARCHAR(20) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    divida DECIMAL(10, 2) NOT NULL,
    cpf VARCHAR(14),
    endereco VARCHAR(255),
    telefone VARCHAR(15)
);

