<?php
// PagClientes/php/carregarProdutos.php

// Conectar ao banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter os produtos
$sql = "SELECT id, nome, preco, img, quantidadeEstoque FROM produtosCadastrado";
$result = $conn->query($sql);

// Verificar se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Inicializar um array para armazenar os produtos
    $produtos = array();

    // Iterar sobre os resultados e adicionar ao array
    while ($row = $result->fetch_assoc()) {
        $produtos[] = array(
            'id' => $row['id'],
            'nome' => $row['nome'],
            'preco' => $row['preco'],
            'img' => $row['img'],
            'quantidadeEstoque' => $row['quantidadeEstoque']
        );
    }

    // Retornar os produtos em formato JSON
    echo json_encode($produtos);
} else {
    // Se não houver produtos, retornar um array vazio
    echo json_encode(array());
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
