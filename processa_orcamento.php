<?php
header('Content-Type: application/json'); // Define o cabeçalho para JSON

// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "Titho@1810";
$dbname = "pedidos_orcamento"; // Nome do banco de dados

// Estabelece a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Falha na conexão com o banco de dados.']);
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura e valida os dados do formulário
    $nome = $conn->real_escape_string(trim($_POST['nome']));
    $morada = $conn->real_escape_string(trim($_POST['morada']));
    $telemovel = $conn->real_escape_string(trim($_POST['telemovel']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $tipoPagina = $conn->real_escape_string(trim($_POST['tipoPagina']));
    $prazoMeses = $conn->real_escape_string(trim($_POST['prazoMeses']));
    $servicos = isset($_POST['servicos']) ? $conn->real_escape_string(implode(", ", $_POST['servicos'])) : '';
    $valorEstimado = $conn->real_escape_string(trim($_POST['valorEstimado']));

    // Validações adicionais
    if (empty($nome) || empty($morada) || empty($telemovel) || empty($email) || empty($tipoPagina) || empty($prazoMeses)) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, preencha todos os campos obrigatórios.']);
        exit();
    }

    // SQL para inserir os dados no banco
    $sql = "INSERT INTO orcamentos (nome, morada, telemovel, email, tipoPagina, prazoMeses, servicos, valorEstimado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara e executa a consulta
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "ssssssss", 
            $nome, $morada, $telemovel, $email, $tipoPagina, $prazoMeses, $servicos, $valorEstimado
        );

        if ($stmt->execute()) {
            // Resposta JSON indicando sucesso
            echo json_encode(['status' => 'success', 'message' => 'Orçamento enviado com sucesso! Entraremos em contato!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao enviar orçamento: ' . $stmt->error]);
        }

        $stmt->close(); // Fecha a consulta preparada
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao preparar a consulta: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
