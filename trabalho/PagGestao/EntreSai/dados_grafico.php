<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Query para obter dados da tabela comprasRealizadas
$sql = "SELECT  comprasRealizadas.enviado as status_compra, 
        comprasRealizadas.quantidade, comprasRealizadas.dataCompra as data_da_compra, produtosCadastrado.quantidadeEstoque, produtosCadastrado.preco, produtosCadastrado.custo
        FROM comprasRealizadas
        INNER JOIN ClientesCadastrados ON comprasRealizadas.cliente_id = ClientesCadastrados.id
        INNER JOIN produtosCadastrado ON comprasRealizadas.produto_id = produtosCadastrado.id
        WHERE comprasRealizadas.enviado = 'Aprovado'
        ORDER BY comprasRealizadas.dataCompra DESC";

$result = $conn->query($sql);

// Array para armazenar os dados do gráfico
$dados = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Adiciona os dados ao array
        $dados[] = array(
            'data' => $row['data_da_compra'],
            'ganhos' => $row['quantidade'] * $row['preco'],
            'perdas' => $row['custo'] * $row['quantidadeEstoque']
        );
    }
}

// Fecha a conexão
$conn->close();

// Retorna os dados como JSON
echo json_encode($dados);
?>
