<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Criar conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Dados a serem inseridos
$valor1 = $_POST['idUsuario'];
$valor2 = $_POST['idProduto'];
$quantidade = $_POST['quantidade'];


// Iniciar transação
mysqli_begin_transaction($conn);

try {
    // Consulta para inserir no carrinho
    $sqlCarrinho = "INSERT INTO `carrinho` (`id`, `carrinhoCliente`, `compras`, `quantidade`) VALUES (NULL, '$valor1', '$valor2', '$quantidade')";

    // Inserir no carrinho
    if (mysqli_query($conn, $sqlCarrinho)) {
        // Commit se tudo estiver OK
        mysqli_commit($conn);
        echo "Dados inseridos com sucesso!";
    } else {
        throw new Exception("Erro na inserção no carrinho: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    // Rollback em caso de erro
    mysqli_rollback($conn);
    echo "Erro na transação: " . $e->getMessage();
}

// Fechar conexão
mysqli_close($conn);
?>
