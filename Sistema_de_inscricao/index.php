<?php
//Inclui o arquivo de conexão com o banco de dados.
include("conexao.php");

//Consulta para obter os departamentos.
$queryDepartamentos = "SELECT id, nome_departamento FROM departamento";
$resultDepartamentos = $mysqli_departamento->query($queryDepartamentos);

//Consulta para obter os treinamentos.
$queryTreinamentos = "SELECT id, nome FROM treinamento";
$resultTreinamentos = $mysqli_treinamento->query($queryTreinamentos);

//Verifica se a consulta de departamentos foi bem-sucedida.
if ($resultDepartamentos === false) {
    die("Erro na consulta de departamentos: " . $mysqli_departamento->error);
}

//Verifica se a consulta de treinamentos foi bem-sucedida.
if ($resultTreinamentos === false) {
    die("Erro na consulta de treinamentos: " . $mysqli_treinamento->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Inscrição</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilo para os checkboxes, aumentando seu tamanho e alterando o cursor */
        input[type="checkbox"] {
            transform: scale(1.7);
            margin-right: 15px;
            margin-left: 7px;
            cursor: pointer; 
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <hr>
        <div class="text-center mb-4">
            <h2 style="color: #17562f;">
                <img src="brasao_vert.png" width="50px">    
                Universidade Tuiuti do Paraná
                <img src="brasao_vert.png" width="50px">
            </h2>
            <hr>
        </div>

        <!-- Formulário de inscrição -->
        <form method="POST" action="processar_inscricao.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            
            <hr>
            
            <!-- Dropdown para selecionar o departamento -->
            <div class="dropdown mb-3">
                <label class="form-label">Nome do departamento:</label>
                <p></p>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonDepartamento" data-bs-toggle="dropdown" aria-expanded="false">
                    Selecione um Departamento
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDepartamento">
                    <?php if ($resultDepartamentos->num_rows > 0): ?>
                        <?php while ($row = $resultDepartamentos->fetch_assoc()): ?>
                            <li><a class="dropdown-item" href="#" data-id="<?= $row['id']; ?>"><?= $row['nome_departamento']; ?></a></li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="#">Nenhum departamento encontrado</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <hr>

            <!-- Campo oculto para armazenar o ID do departamento selecionado -->
            <input type="hidden" name="departamento" id="departamento" required>

            <!-- Dropdown para selecionar o treinamento -->
            <div class="dropdown mb-3">
                <label class="form-label">Nome do treinamento:</label>
                <p></p>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonTreinamento" data-bs-toggle="dropdown" aria-expanded="false">
                    Selecione um Treinamento
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonTreinamento">
                    <?php if ($resultTreinamentos->num_rows > 0): ?>
                        <?php while ($row = $resultTreinamentos->fetch_assoc()): ?>
                            <li><a class="dropdown-item" href="#" data-id="<?= $row['id']; ?>"><?= $row['nome']; ?></a></li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="#">Nenhum treinamento encontrado</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <input type="hidden" name="treinamento" id="treinamento" required>

            <script>
                // Função para configurar o comportamento dos dropdowns.
                function setupDropdown(dropdownButtonId, hiddenInputId) {
                    document.querySelectorAll(`#${dropdownButtonId} + .dropdown-menu .dropdown-item`).forEach(item => {
                        item.addEventListener('click', function() {
                            const selectedId = this.getAttribute('data-id');
                            const selectedName = this.textContent;
                            document.getElementById(dropdownButtonId).textContent = selectedName; // Atualiza o botão do dropdown.
                            document.getElementById(hiddenInputId).value = selectedId; // Atualiza o campo oculto.
                        });
                    });
                }

                // Configura os dropdowns para departamento e treinamento.
                setupDropdown('dropdownMenuButtonDepartamento', 'departamento');
                setupDropdown('dropdownMenuButtonTreinamento', 'treinamento');
            </script>

            <hr>
            <div class="mb-4">
                <label class="form-label">Disponibilidade:</label>
                <strong>Manhã:</strong>
                <div>
                    <label>Segunda<input type="checkbox" name="manha[]" value="seg"></label>
                    <label>Terça<input type="checkbox" name="manha[]" value="ter"></label>
                    <label>Quarta<input type="checkbox" name="manha[]" value="qua"></label>
                    <label>Quinta<input type="checkbox" name="manha[]" value="qui"></label>
                    <label>Sexta<input type="checkbox" name="manha[]" value="sex"></label>
                </div>
                <hr>

                <strong>Tarde:</strong>
                <div>
                    <label>Segunda<input type="checkbox" name="tarde[]" value="seg"></label>
                    <label>Terça<input type="checkbox" name="tarde[]" value="ter"></label>
                    <label>Quarta<input type="checkbox" name="tarde[]" value="qua"></label>
                    <label>Quinta<input type="checkbox" name="tarde[]" value="qui"></label>
                    <label>Sexta<input type="checkbox" name="tarde[]" value="sex"></label>
                </div>
                <hr>

                <strong>Noite:</strong>
                <div>
                    <label>Segunda<input type="checkbox" name="noite[]" value="seg"></label>
                    <label>Terça<input type="checkbox" name="noite[]" value="ter"></label>
                    <label>Quarta<input type="checkbox" name="noite[]" value="qua"></label>
                    <label>Quinta<input type="checkbox" name="noite[]" value="qui"></label>
                    <label>Sexta<input type="checkbox" name="noite[]" value="sex"></label>
                </div>
            </div>

            <!-- Botão para enviar o formulário -->
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <!-- Inclui o JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
