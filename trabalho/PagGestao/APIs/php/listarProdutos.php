<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua com seu nome de usuário do MySQL
$password = ""; // Substitua com sua senha do MySQL
$dbname = "Clientes";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Consultar produtos cadastrados
$sql = "SELECT * FROM produtosCadastrado";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Gerar tabela HTML com os produtos
    echo '<table>';
    echo '<thead><th>N°</th><th>Produtos</th><th>Preço</th><th>Quantidade</th><th>Foto Carregada</th></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['preco'] . '</td>';
        echo '<td>' . $row['quantidadeEstoque'] . '</td>';
        echo '<td>' . $row['img'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Nenhum produto cadastrado.';
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
