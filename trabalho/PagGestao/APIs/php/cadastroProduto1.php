<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua com seu nome de usuário do MySQL
$password = ""; // Substitua com sua senha do MySQL
$dbname = "Clientes";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$nomeProduto = $_POST['nomeProduto'];
$precoProduto = $_POST['precoProduto'];
$quantidadeProduto = $_POST['quantidade'];

// Inserir dados no banco de dados
$sql = "INSERT INTO  produtosCadastrado (nome, preco, quantidadeEstoque) VALUES ('$nomeProduto', $precoProduto, $quantidadeProduto)";

if ($conn->query($sql) === TRUE) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro no cadastro do produto: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
