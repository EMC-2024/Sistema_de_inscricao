<?php
// Configurações de conexão ao banco de dados.
$usuario = 'root'; // Nome de usuário do banco de dados.
$senha = ''; // Senha do banco de dados.
$host = 'localhost'; // Endereço do servidor do banco de dados.

// Nome dos bancos de dados.
$database_departamento = 'departamento';
$database_inscricoes = 'inscricoes';
$database_treinamento = 'treinamento';

// Conexão ao banco de dados 'departamento'.
$mysqli_departamento = new mysqli($host, $usuario, $senha, $database_departamento);
if ($mysqli_departamento->error) {
    die("Falha ao conectar ao banco de dados 'departamento': " . $mysqli_departamento->error);
}

// Conexão ao banco de dados 'inscricoes'.
$mysqli_inscricoes = new mysqli($host, $usuario, $senha, $database_inscricoes);
if ($mysqli_inscricoes->error) {
    die("Falha ao conectar ao banco de dados 'inscricoes': " . $mysqli_inscricoes->error);
}

// Conexão ao banco de dados 'treinamento'.
$mysqli_treinamento = new mysqli($host, $usuario, $senha, $database_treinamento);
if ($mysqli_treinamento->error) {
    die("Falha ao conectar ao banco de dados 'treinamento': " . $mysqli_treinamento->error);
}
?>
