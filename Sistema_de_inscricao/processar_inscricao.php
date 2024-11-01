<?php
// Inclui o arquivo de conexão com o banco de dados.
include('conexao.php'); 

// Verifica se a requisição é do tipo POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o departamento foi selecionado.
    if (!isset($_POST['departamento'])) {
        die("Departamento não selecionado.");
    }

    // Escapa os dados de entrada para evitar SQL Injection.
    $nome = $mysqli_inscricoes->real_escape_string($_POST['nome']);
    $departamento = $mysqli_inscricoes->real_escape_string($_POST['departamento']);
    $treinamento = $mysqli_inscricoes->real_escape_string($_POST['treinamento']);
    
    // Cria um array para armazenar a disponibilidade.
    $disponibilidade = [];
    
    // Verifica quais checkboxes de disponibilidade foram marcados e os adiciona ao array.
    if (isset($_POST['manha'])) {
        $disponibilidade[] = 'Manhã: ' . implode(', ', $_POST['manha']);
    }
    if (isset($_POST['tarde'])) {
        $disponibilidade[] = 'Tarde: ' . implode(', ', $_POST['tarde']);
    }
    if (isset($_POST['noite'])) {
        $disponibilidade[] = 'Noite: ' . implode(', ', $_POST['noite']);
    }
    
    // Converte o array de disponibilidade em uma string.
    $disponibilidade_str = implode('; ', $disponibilidade);

    // Prepara a consulta SQL para inserir os dados na tabela de inscrições.
    $query = "INSERT INTO inscricoes (nome, departamento, treinamento, disponibilidade) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli_inscricoes->prepare($query);
    
    // Verifica se a preparação da consulta foi bem-sucedida.
    if ($stmt) {
        // Faz o bind das variáveis aos parâmetros da consulta.
        $stmt->bind_param("ssss", $nome, $departamento, $treinamento, $disponibilidade_str);
        
        // Executa a consulta e verifica se foi bem-sucedida.
        if ($stmt->execute()) {
            echo "Inscrição realizada com sucesso!"; 
        } else {
            echo "Erro ao realizar a inscrição: " . $stmt->error;
        }
        
        // Fecha a declaração.
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $mysqli_inscricoes->error;
    }
}

// Fecha a conexão com o banco de dados.
$mysqli_inscricoes->close();
?>
