<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Criar conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obter o primeiro e último dia do mês atual
$primeiro_dia_do_mes = date('Y-m-01');
$ultimo_dia_do_mes = date('Y-m-t');

// Consulta SQL para obter as informações do carrinho usando o ID enviado pelo JavaScript
$sql = "SELECT comprasRealizadas.id, comprasRealizadas.pagamento, comprasRealizadas.enviado as status_compra, ClientesCadastrados.nome, ClientesCadastrados.id as id_cliente, ClientesCadastrados.email as email_cadastrado, ClientesCadastrados.cpf as cpf, comprasRealizadas.quantidade, comprasRealizadas.dataCompra as data_da_compra, produtosCadastrado.preco, produtosCadastrado.nome as produto_nome
        FROM comprasRealizadas
        INNER JOIN ClientesCadastrados ON comprasRealizadas.cliente_id = ClientesCadastrados.id
        INNER JOIN produtosCadastrado ON comprasRealizadas.produto_id = produtosCadastrado.id
        WHERE comprasRealizadas.dataCompra BETWEEN '$primeiro_dia_do_mes' AND '$ultimo_dia_do_mes'
        ORDER BY comprasRealizadas.dataCompra DESC";

$result = mysqli_query($conn, $sql);

if ($result) {
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Adicionar cada linha como um elemento ao array
        $data[] = $row;
    }

    // Retornar os dados como JSON
    echo json_encode($data);
} else {
    $error_message = "Error: " . mysqli_error($conn);
    error_log($error_message);
    echo $error_message;
}

// Fechar conexão
mysqli_close($conn);
?>
