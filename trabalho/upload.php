<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root"; // Substitua com seu nome de usuário do MySQL
$password = ""; // Substitua com sua senha do MySQL
$dbname = "imagens";

// Criar uma conexão
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar o envio da imagem
if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $nomeImagem = $_FILES['imagem']['name'];
    $tipoImagem = $_FILES['imagem']['type'];
    $dadosImagem = file_get_contents($_FILES['imagem']['tmp_name']);

    // Inserir dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO imagensTest (nome, tipo, dados) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nomeImagem, $tipoImagem, $dadosImagem);

    if ($stmt->execute()) {
        $resposta = array("mensagem" => "Imagem enviada com sucesso!");
    } else {
        $resposta = array("mensagem" => "Erro ao enviar imagem.");
    }

    $stmt->close();
} else {
    $resposta = array("mensagem" => "Erro no envio da imagem.");
}

$conn->close();

header("Content-Type: application/json");
echo json_encode($resposta);
?>
