<?php
// Exibir erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
$host = 'localhost';    // Endereço do servidor de banco de dados
$dbname = 'pedidos_orcamento'; // Nome do banco de dados
$user = 'root';         // Usuário do banco de dados
$pass = 'Titho@1810';             // Senha do banco de dados (no XAMPP, geralmente é vazio)

$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Falha na conexão: " . $conn->connect_error]));
}

// Verificar se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura e sanitiza os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $morada = $conn->real_escape_string($_POST['morada']);
    $telemovel = $conn->real_escape_string($_POST['telemovel']);
    $email = $conn->real_escape_string($_POST['email']);
    $comentario = $conn->real_escape_string($_POST['comentario']);

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO contactos (nome, morada, telemovel, email, comentario) 
            VALUES ('$nome', '$morada', '$telemovel', '$email', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        // Se a inserção for bem-sucedida, envia a resposta de sucesso
        echo json_encode(["status" => "success", "message" => "Mensagem enviada com sucesso!"]);
    } else {
        // Se ocorrer algum erro ao inserir no banco, envia a resposta de erro
        echo json_encode(["status" => "error", "message" => "Erro ao enviar a mensagem: " . $conn->error]);
    }
} else {
    // Caso o método de requisição não seja POST, enviar uma mensagem de erro
    echo json_encode(["status" => "error", "message" => "Método de requisição inválido."]);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
