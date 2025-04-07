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

// Verifica se o ID foi enviado pelo JavaScript
$id = isset($_POST['id']) ? $_POST['id'] : null;

if ($id) {
    // Consulta SQL para obter as informações do carrinho usando o ID enviado pelo JavaScript
    $sql = "SELECT carrinho.id, produtosCadastrado.preco, carrinho.quantidade, produtosCadastrado.id as produto_id_nome, produtosCadastrado.nome as produto_nome
            FROM carrinho
            INNER JOIN ClientesCadastrados ON carrinho.carrinhoCliente = ClientesCadastrados.id
            INNER JOIN produtosCadastrado ON carrinho.compras = produtosCadastrado.id
            WHERE carrinho.carrinhoCliente = $id";

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
} else {
    $error_message = "ID não foi recebido.";
    error_log($error_message);
    echo $error_message;
}

// Fechar conexão
mysqli_close($conn);
?>
