<?php
function obterConexao() {

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassowrd = 'aluno';
    $dbName = 'cadernopago';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassowrd, $dbName);

    if($conexao->connect_error) {
        die("Falha" .$conexao->connect_error);
    }

    return $conexao;
}

?>
