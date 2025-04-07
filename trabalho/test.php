<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Imagens</title>
</head>
<body>
    <h1>Imagens Armazenadas</h1>

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

// Consultar imagens no banco de dados
$query = "SELECT nome, tipo, dados FROM imagensTest";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nomeImagem = $row['nome'];
        $tipoImagem = $row['tipo'];
        $dadosImagem = $row['dados'];

        // Exibir a imagem
        echo "<img src='data:$tipoImagem;base64," . base64_encode($dadosImagem) . "' alt='$nomeImagem'><br>";
    }
} else {
    echo "Nenhuma imagem encontrada.";
}

$conn->close();
?>

</body>
</html>
