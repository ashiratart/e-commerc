<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Conecta ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o ID do cliente foi fornecido
if (isset($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];

    // Limpa o carrinho para o cliente específico
    $sql = "DELETE FROM carrinho WHERE carrinho.carrinhoCliente = $idCliente";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Carrinho do cliente ID $idCliente foi limpo com sucesso!";
    } else {
        echo "Erro ao limpar o carrinho.";
    }
} else {
    echo "ID do cliente não especificado.";
}

// Fecha a conexão
mysqli_close($conn);
?>
