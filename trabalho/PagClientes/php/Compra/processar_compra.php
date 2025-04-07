<?php
// Conexão com o banco de dados (substitua pelos seus próprios dados)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados da requisição AJAX
$idCliente = $_POST['idCliente'];
$idsItens = $_POST['idsItens'];
$totalCompra = $_POST['totalCompra'];
$formasPagamentoSelecionadas = $_POST['formasPagamentoSelecionadas'];
$quantidades = $_POST['quantidades'];
$dataCompra = date('Y-m-d H:i:s'); // Data e hora atual

// Extrair valor numérico da string e remover o símbolo "R$"
$valorTotal = floatval(str_replace('R$', '', $totalCompra));

// Dividir os ids dos itens em um array
$arrayIdsItens = explode(',', $idsItens);

// Inserir dados na tabela de compras
$sql = "INSERT INTO comprasRealizadas (cliente_id, produto_id, valorTotal, pagamento, quantidade, dataCompra) VALUES ";

foreach ($arrayIdsItens as $index => $idItem) {
    $quantidade = intval($quantidades[$index]);
    $formaPagamento = $formasPagamentoSelecionadas[$index]; // Obtenha a forma de pagamento correta

    $sql .= "('$idCliente', '$idItem', '$valorTotal', '$formaPagamento', '$quantidade', '$dataCompra'),";
}

// Remover a última vírgula da query
$sql = rtrim($sql, ',');

if ($conn->query($sql) === TRUE) {
    echo "Compra realizada com sucesso!";
} else {
    echo "Erro ao processar a compra: " . $conn->error;
}

// Fechar conexão
$conn->close();
?>
