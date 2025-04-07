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

// Verifica se a ação e outros parâmetros necessários foram fornecidos
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'remover':
            // Lida com a remoção do produto
            $idCliente = $_POST['idCliente'];
            $idProduto = $_POST['idProduto'];

            $sql = "DELETE FROM carrinho WHERE carrinho.carrinhoCliente = $idCliente AND carrinho.id = $idProduto";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Produto removido do carrinho com sucesso!";
            } else {
                echo "Erro ao remover o produto do carrinho.";
            }
            break;

        case 'alterar':
            // Lida com a atualização da quantidade
            $idCliente = $_POST['idCliente'];
            $idProduto = $_POST['idProduto'];
            $novaQuantidade = $_POST['novaQuantidade'];

            $sql = "UPDATE carrinho SET quantidade = $novaQuantidade WHERE carrinho.carrinhoCliente = $idCliente AND carrinho.id = $idProduto";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Quantidade do produto alterada com sucesso!";
            } else {
                echo "Erro ao alterar a quantidade do produto.";
            }
            break;

        default:
            echo "Ação desconhecida.";
            break;
    }
} else {
    echo "Ação não especificada.";
}

// Fecha a conexão
mysqli_close($conn);
?>
