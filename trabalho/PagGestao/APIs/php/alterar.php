<?php
// Conexão com o banco de dados (substitua as informações conforme necessário)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para alterar um produto no banco de dados
function alterarProduto($numero, $campo, $novoValor) {
    global $conn;

    $sql = "UPDATE produtosCadastrado SET $campo = ? WHERE numero = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $novoValor, $numero);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Erro na preparação da declaração SQL: " . $conn->error;
    }
}

// Função para deletar um produto no banco de dados
function deletarProduto($numero) {
    global $conn;

    $sql = "DELETE FROM produtosCadastrado WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $numero);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Erro na preparação da declaração SQL: " . $conn->error;
    }
}

// Verifica se uma solicitação POST foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do POST
    $productNumber = $_POST["productNumber"];
    $operation = $_POST["operation"];
    $fieldToUpdate = $_POST["fieldToUpdate"];
    $newValue = $_POST["newValue"];

    // Executa a operação apropriada
    if ($operation === "update") {
        alterarProduto($productNumber, $fieldToUpdate, $newValue);
        echo "Produto atualizado com sucesso!";
    } elseif ($operation === "delete") {
        deletarProduto($productNumber);
        echo "Produto deletado com sucesso!";
    }
} else {
    echo "Acesso inválido!";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
