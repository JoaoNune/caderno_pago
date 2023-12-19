
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipoDocumento ENUM('cpf', 'cnpj') NOT NULL,
    documento VARCHAR(20) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);
