<?php
session_start();

$servername = "localhost";
$username = "root"; // Substitua com seu nome de usuário do MySQL
$password = ""; // Substitua com sua senha do MySQL
$dbname = "Clientes";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Recupera as credenciais enviadas pelo JavaScript
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta simples, sem prepared statements
$sql = "SELECT * FROM ClientesCadastrados WHERE email='$usuario'";
$result = $conexao->query($sql);

// Verifica se há resultados e compara a senha
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $senhaArmazenada = $row['senha']; // Substitua 'senha' pelo nome correto da coluna no seu banco de dados

    if ($senha == $senhaArmazenada) {
        // Senha correta, o usuário está autenticado
        echo json_encode(['autenticado' => true, 'id' => $row['id'], 'nome' => $row['nome']]);
    } else {
        // Senha incorreta
        echo json_encode(['autenticado' => false]);
    }
} else {
    // Usuário não encontrado
    echo json_encode(['autenticado' => false]);
}

$conexao->close();
?>
