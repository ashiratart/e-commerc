<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

// Criar conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// verificar conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// obter dados do POST
$idProd = $_POST['id'];
$acao = $_POST['acao'];

// realizar ação com base nos dados recebidos
if ($acao == 'SIM') {
    // Execute a ação desejada
    $sql = "UPDATE comprasRealizadas SET enviado ='Aprovado' WHERE id=$idProd";
} elseif ($acao == 'Cancela') {
    // Execute a ação desejada
    $sql = "UPDATE comprasRealizadas SET enviado ='Cancelado' WHERE id=$idProd";
} else {
    // Ação desconhecida, você pode lidar com isso conforme necessário
}

// Executar a consulta SQL
if (mysqli_query($conn, $sql)) {
    echo json_encode(array('success' => true, 'message' => 'Ação realizada com sucesso.'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Erro ao executar ação: ' . mysqli_error($conn)));
}

// Fechar a conexão
mysqli_close($conn);

?>
