<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter dados do POST
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$dataNascimento = $_POST['datanascimento'];

// Inserir dados no banco de dados
$sql = "INSERT INTO ClientesCadastrados (nome, email, datanascimento, cpf, senha ) VALUES ('$nome', '$email','$dataNascimento', '$cpf', '$senha' )";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
