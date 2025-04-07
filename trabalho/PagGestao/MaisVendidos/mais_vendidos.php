<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os 5 produtos mais vendidos
$sql = "SELECT produtosCadastrado.nome AS produto, 
               SUM(comprasRealizadas.quantidade) AS total_vendido
        FROM comprasRealizadas
        INNER JOIN produtosCadastrado ON comprasRealizadas.produto_id = produtosCadastrado.id
        WHERE comprasRealizadas.enviado = 'Aprovado'
        GROUP BY produtosCadastrado.nome
        ORDER BY total_vendido DESC
        LIMIT 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Construir a lista de produtos mais vendidos
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . $row['produto'] . ' - Total Vendido: ' . $row['total_vendido'] . '</li>';
    }
    echo '</ul>';
} else {
    echo "Nenhum produto encontrado.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
